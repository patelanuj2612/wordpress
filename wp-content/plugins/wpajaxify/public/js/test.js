(function ($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    $.ajax({
        type: 'post',
        url: testObject.ajaxurl,
        data: {
            action: testObject.action,
            _ajax_nonce: testObject._ajax_nonce,
        },
        beforeSend: function (d) {
            console.log('Before send', d);
        }
    })
    .done(function (response, textStatus, jqXHR) {
        console.log('AJAX done', textStatus, jqXHR, jqXHR.getAllResponseHeaders());
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        console.log('AJAX failed', jqXHR.getAllResponseHeaders(), textStatus, errorThrown);
    })
    .then(function (jqXHR, textStatus, errorThrown) {
        console.log('AJAX after finished', jqXHR, textStatus, errorThrown);
    });
})(jQuery);
