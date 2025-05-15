<?php
class kernel {
    static private array $url;
    static private object $controller;

    /**
     * @throws ReflectionException
     */
    public static function run(): void
    {
        self::loadHelper("debug");
        self::$url = Routeur::getPath();
        self::loadController();
    }


    /**
     * @throws ReflectionException
     */
    private static function loadController(): void
    {
        if (!file_exists(CONTROLLERS . DS . self::$url["controller"] . "Controller.php")) {
            http_response_code(404);
            echo "Error 404: Page not found";
            die;
        }

        include_once CONTROLLERS . DS . self::$url["controller"] . "Controller.php";

        $controllerName = self::$url["controller"] . "Controller";
        if (!class_exists($controllerName)) {
            http_response_code(404);
            echo "Error 404: Page not found";
            die;
        }

        self::$controller = new $controllerName();
        if (!method_exists(self::$controller, self::$url["action"])) {
            http_response_code(404);
            echo "Error 404: Page not found";
            die;
        }
        // remove empty args
        self::$url["args"] = array_values(array_filter(self::$url["args"], function ($arg) {
            return !empty($arg);
        }));

        $f = new ReflectionMethod(self::$controller, self::$url["action"]);
        if ($f->getNumberOfRequiredParameters() != count(self::$url["args"]) && $f->getNumberOfParameters() > count(self::$url["args"])) {
            http_response_code(404);
            echo "Error 404: Arguments out of range";
            die;
        }

        self::$controller->{self::$url["action"]}(...self::$url["args"]);
    }

    public static function loadHelper($helper): void
    {
        if (file_exists(HELPERS . DS . $helper . ".php")) {
            include_once HELPERS . DS . $helper . ".php";
        } else {
            http_response_code(404);
            echo "Error 404: Helper not found";
            die;
        }
    }


}