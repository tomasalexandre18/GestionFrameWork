<?php


class Controller {

    public string $controllerName;
    protected string $template = "default";
    protected array $vars = [];
    public function __construct()
    {
        if (method_exists($this, '__init')) {
            $this->__init();
        }

        $this->controllerName = strtolower(str_replace("Controller", "", get_class($this)));
        $this->loadModel($this->controllerName);
    }

    /**
     * @param string|null $view
     * The name of the view file to render. If null, it will use the name of the method that called this function.
     * @return void
     */
    protected function render(string|null $view = null): void
    {
        if ($view==null) {
            $view = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];
        }


        ob_start();
        extract($this->vars);
        if (file_exists(VIEWS . DS . $this->controllerName . DS . $view . ".php")) {
            require_once VIEWS . DS . $this->controllerName . DS . $view . ".php";
        } else {
            http_response_code(404);
            echo "Error 404: Page not found";
        }
        $contentLayout = ob_get_clean();

        kernel::loadHelper("template");

        if (file_exists(TEMPLATES . DS . $this->template . ".php")) {
            require_once TEMPLATES . DS . $this->template . ".php";
        } else {
            http_response_code(404);
            echo "Error 404: default template not found";
        }
    }

    protected function set(array $vars): void
    {
        $this->vars = array_merge($this->vars, $vars);
    }

    protected function loadModel(string $model): void
    {
        if (file_exists(MODELS . DS . $model . "Model.php")) {
            require_once MODELS . DS . $model . "Model.php";
            $this->$model = new $model();
        } else {
            http_response_code(404);
            echo "Error 404: Model not found";
        }
    }

    protected function redirect(string $string): void
    {
        header("Location: $string");
    }
}