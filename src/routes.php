<?php

Route::post('widget-ajax', ['uses' => 'TheRezor\CurrencyWidget\Controllers\CurrencyWidgetAjax@calculateRates', 'as' => 'currency-widget-ajax']);

