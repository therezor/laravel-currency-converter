<?php

namespace TheRezor\CurrencyWidget\Controllers;

use Illuminate\Support\Facades\Input;
use Request;
use Validator;
use Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use TheRezor\CurrencyWidget\CurrencyCalculator;
use TheRezor\CurrencyWidget\Provider\EuropeanCentralBankProvider;

class CurrencyWidgetAjax extends Controller
{
    public function calculateRates() {
        if (!Request::ajax())
            abort(400, 'Bad Request.');

        $inputData = Input::get('formData');
        $formFields = array();
        parse_str($inputData, $formFields);


        // Validating input data
        $currencyConfig = config('currency-widget.currency');
        $availableCurrency = implode(",", array_keys($currencyConfig));
        $rules = array(
            'amount' => 'Required|Min:0.01|Numeric',
            'from'     => 'Required|in:'.$availableCurrency,
            'to'       => 'Required|in:'.$availableCurrency
        );

        $validation = Validator::make($formFields, $rules);

        if($validation->fails()) {
            return Response::json(array(
                'success' => false,
                'errors'    =>  $validation->messages()->toArray()
            ));
        }

        // Calculating rates and amount
        $provider = new EuropeanCentralBankProvider();
        $calculator = new CurrencyCalculator($provider);
        $calculator->calculate($formFields['amount'], $formFields['from'], $formFields['to']);

        // Generating response
        $resultFrom = array(
            'amount' =>  $formFields['amount'],
            'currency' =>  $formFields['from'],
            'rate' => $calculator->getRateFrom()
        );

        $resultTo = array(
            'amount' =>  $calculator->getAmount(),
            'currency' =>  $formFields['to'],
            'rate' => $calculator->getRateTo()
        );

        $data = array('from' => $resultFrom, 'to' => $resultTo);

        return Response::json(array(
            'success' => true,
            'data'    =>  $data
        ));
    }
}
