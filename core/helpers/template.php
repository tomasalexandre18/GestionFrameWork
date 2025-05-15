<?php

class TEMPLATE
{
    public static function getCssLink(array $link): string
    {
        $out = "";
        foreach ($link as $l) {
            $out .= "<link rel='stylesheet' href='" . DS . "css" . DS . $l . ".css'>";
        }
        return $out;
    }

    public static function getJsLink(array $link): string
    {
        $out = "";
        foreach ($link as $l) {
            // regex module in name of the file
            $is_module = str_contains($l, 'module');
            $out .= "<script src='" . DS . "js" . DS . $l . ".js'" . ($is_module ? "type='module'" : "") . "></script>";
        }
        return $out;
    }
}