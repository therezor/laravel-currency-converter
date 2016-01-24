<?php

namespace TheRezor\CurrencyWidget\Models;


class Rates
{

    private static $rates = [];

    /**
     * @param string $currency
     * @return float|false
     */
    public static function getRate($currency)
    {
        if(isset(static::$rates[$currency]))
            return static::$rates[$currency];

        return 0;
    }

    /**
     * @param string $currency
     * @param float $rate
     */
    public static function setRate($currency, $rate)
    {
        static::$rates[$currency] = $rate;
    }

}