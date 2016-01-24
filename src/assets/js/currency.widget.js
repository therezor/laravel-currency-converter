/**
 * Currency widget scripts
 */

// Checking if jquery is included and include if not
if(!window.jQuery)
{
    var script = document.createElement('script');
    script.type = "text/javascript";
    script.src = "http://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js";
    document.getElementsByTagName('head')[0].appendChild(script);
}
// Only do anything if jQuery isn't defined
if (typeof jQuery == 'undefined') {
    if (typeof $ == 'function') {
        // warning, global var
        var thisPageUsingOtherJSLibrary = true;
    }
    function getScript(url, success) {
        var script = document.createElement('script');
        script.src = url;
        var head = document.getElementsByTagName('head')[0],
            done = false;
        // Attach handlers for all browsers
        script.onload = script.onreadystatechange = function() {
            if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
                done = true;
                console.log('done=true; callback function provided as param');
                success();
                script.onload = script.onreadystatechange = null;
                head.removeChild(script);
            };
        };
        head.appendChild(script);
    };
    getScript('http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', function() {
        if (typeof jQuery=='undefined') {
            //console.log('Super failsafe - still somehow failed...');
        } else {
            //console.log('jQuery loaded! Make sure to use .noConflict just in case');
            if (thisPageUsingOtherJSLibrary) {
                //console.log('Run your jQuery Code');
                runjQueryScript();
            } else {
                //console.log('Use .noConflict(), then run your jQuery Code');
                runjQueryScript();
            }
        }
    });
} else { // jQuery was already loaded
    //console.log('Run your jQuery Code');
    runjQueryScript();
};

function runjQueryScript(){
    // Enable submit if js was loaded
    $( '.currency-widget-form__submit' ).prop( 'disabled', false );

    $( '.currency-widget-form' ).submit(function( event ) {
        event.preventDefault();

        var _$form = $( this ),
            _data = _$form.serialize(),
            _url = _$form.attr( 'action'),
            _$error = $( this ).find( '.currency-widget-form__error' );

        var _ajax = $.post( _url, { formData: _data } );
        _$error.html('');

        _ajax.done(function( result ) {
            if(result.success) {
                var _data = result.data,
                    _$result = _$form.parent().find('.currency-widget-result');
                _$result.removeClass( 'currency-widget-result--hide' );
                _$form.parent().find( '.currency-widget-result__from-amount' ).html(_data.from.amount + ' ' + _data.from.currency);
                _$form.parent().find( '.currency-widget-result__from-rate' ).html('1' + ' ' + _data.from.currency + ' = ' + _data.to.rate + ' ' + _data.to.currency);

                _$form.parent().find( '.currency-widget-result__to-amount' ).html(_data.to.amount + ' ' + _data.to.currency);
                _$form.parent().find( '.currency-widget-result__to-rate' ).html('1' + ' ' + _data.to.currency + ' = ' + _data.from.rate + ' ' + _data.from.currency);
            }
            else if(!result.success) {
                $.each(result.errors, function (index, value) {
                    _$error.html(value + '<br>');
                });
            }
        });
    });


    $('.currency-widget-form__swap').click(function (event) {
        event.preventDefault();

        var _buffer,
            _$from = $(this).parent().find('.currency-widget-form__from'),
            _$to = $(this).parent().find('.currency-widget-form__to');

        _buffer = _$from.val();
        _$from.val(_$to.val());
        _$to.val(_buffer);
    });
};