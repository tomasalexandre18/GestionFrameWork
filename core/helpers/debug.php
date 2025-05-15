<?php

class DEBUG {
    public static function printr($value): void
    {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    }
}