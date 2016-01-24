<?php

namespace TheRezor\CurrencyWidget;

use Arrilot\Widgets\AbstractWidget;

class CurrencyConverter extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Currency list
     *
     * @var array
     */
    protected $currencyList = [];

    public function __construct()
    {
        parent::__construct();

        $this->currencyList = config('currency-widget.currency');
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {

        return view("widgets.currency_converter", [
            'currency' => $this->currencyList,
            'config' => $this->config,
        ]);
    }
}