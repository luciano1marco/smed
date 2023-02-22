(function($, doc) {

    $.each(readyQ, function(index, handler) {
        $(handler);
    });

    $.each(bindReadyQ, function(index, handler) {
        $(doc).bind("ready", handler);
    });

})(jQuery, document);