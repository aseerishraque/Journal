<?php


namespace App;


class Utilities
{
    public function dd($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die();
    }

    public function setPrecision($number, $precision)
    {
        $number = number_format((float) $number, $precision, '.', '');
        return $number;
    }

}