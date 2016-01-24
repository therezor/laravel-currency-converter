<?php

namespace TheRezor\CurrencyWidget\Provider;


interface ProviderInterface
{
    /**
     * Grab rates from api and set them to Rates model
     */
    public function getRates();
}