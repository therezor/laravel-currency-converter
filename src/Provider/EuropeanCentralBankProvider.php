<?php

namespace TheRezor\CurrencyWidget\Provider;

use TheRezor\CurrencyWidget\Models\Rates as Rates;

class EuropeanCentralBankProvider implements ProviderInterface
{

    const URL = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

    public function getRates() {
        $file = file_get_contents(self::URL);
        $xml =  new \SimpleXMLElement($file) ;

        Rates::setRate('EUR', 1);

        foreach($xml->Cube->Cube->Cube as $item){
            $currency = (string)$item->attributes()->currency;
            $rate = (float)$item->attributes()->rate;
            if(isset($currency) && isset($rate)) {
                Rates::setRate($currency, $rate);
            }
        }
    }
}