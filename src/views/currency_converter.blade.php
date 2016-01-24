 <script type="text/javascript" src="{{ URL::asset('widget/js/currency.widget.js') }}"></script>
 <link rel="stylesheet" href="{{ URL::asset('widget/css/currency-widget.css') }}">

 <section class="currency-widget">
     <form class="currency-widget-form" action="{{ route("currency-widget-ajax") }}" method="POST">
         <div class="currency-widget-form__error"></div>
         <input name="amount" class="currency-widget-form__amount" type="text" value="1" placeholder="Amount" maxlength="50" tabindex="1">

         <select name="from" class="currency-widget-form__from">
             @foreach($currency as $code => $name)
                 <option value="{{ $code }}">
                     {{ $code }} - {{ $name }}
                 </option>
             @endforeach
         </select>

         <a class="currency-widget-form__swap" href="#">↔</a>

         <select name="to" class="currency-widget-form__to">
             @foreach($currency as $code => $name)
                 <option value="{{ $code }}">
                     {{ $code }} - {{ $name }}
                 </option>
             @endforeach
         </select>
         <button class="currency-widget-form__submit" type="submit" disabled="disabled">Convert</button>

     </form>
         <table class="currency-widget-result currency-widget-result--hide">
             <tr class="currency-widget-result__row">
                 <td class="currency-widget-result__from-amount">
                 </td>
                 <td class="currency-widget-result__cell">
                     =
                 </td>
                 <td class="currency-widget-result__to-amount">
                 </td>
             </tr>
             <tr class="currency-widget-result__row">
                 <td class="currency-widget-result__from-rate">
                 </td>
                 <td class="currency-widget-result__cell">

                 </td>
                 <td class="currency-widget-result__to-rate">
                 </td>
             </tr>
         </table>
 </section>


