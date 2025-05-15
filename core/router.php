<?php
class Routeur {
    static private string $url;
    static private array $urlParsed;
    static private array $finaleUrl ;
    static public function getPath() {
        self::$url = $_SERVER['PATH_INFO'];
        if (!empty(self::$url)) {
            self::parseUrl();
            self::$finaleUrl["controller"] = self::$urlParsed[0];
            self::$finaleUrl["action"] = self::$urlParsed[1];
            self::$finaleUrl["args"] = array_splice(self::$urlParsed, 2);
            return self::$finaleUrl;
        }
        die("Error");
    }

    private static  function parseUrl(): void
    {
        $explode = explode('/', self::$url);
        self::$urlParsed = array_splice($explode, 1);
    }
}