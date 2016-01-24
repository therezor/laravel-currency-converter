<?php

namespace TheRezor\CurrencyWidget;

use TheRezor\CurrencyWidget\Provider\ProviderInterface;
use TheRezor\CurrencyWidget\Models\Rates;

class CurrencyCalculator
{

    private $amount;
    private $rateTo;
    private $rateFrom;

    /**
     * CurrencyCalculator constructor.
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider) {
        $provider->getRates();
    }

    /**
     * @param float $amountFrom
     * @param string $CurrencyFrom
     * @param string $CurrencyTo
     */
    public function calculate($amountFrom, $CurrencyFrom, $CurrencyTo) {
        $ratioFrom = Rates::getRate($CurrencyFrom);
        $ratioTo = Rates::getRate($CurrencyTo);

        //Set amount 1 if less than zero was set
        $amountFrom = ($amountFrom > 0) ? $amountFrom : 1;

        if($ratioFrom <= 0 && $ratioTo <= 0)
            throw new \OutOfRangeException('No information about current rates');

        $this->amount = round($amountFrom * ( $ratioTo / $ratioFrom ) , 4);
        $this->rateTo = round(( $ratioTo / $ratioFrom ), 4);
        $this->rateFrom = round(( $ratioFrom / $ratioTo ), 4);

    }

    /**
     * @return float
     */
    public function getAmount() {

        return $this->amount;
    }

    /**
     * @return float
     */
    public function getRateFrom() {

        return $this->rateFrom;
    }

    /**
     * @return float
     */
    public function getRateTo() {

        return $this->rateTo;
    }


}