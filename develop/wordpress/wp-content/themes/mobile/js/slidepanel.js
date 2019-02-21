(function($) {
    $('#slide-menu-button').toggle(
        function() {
            $('#slide-menu-button-open').animate({ left: 0 }, 'slow', function() {
                $('#slide-menu-button').html('<img src="' + params.template_uri + '/images/baseline_close_black_48dp_2x.png" alt="Close Menu" />');
            });
        },
        function() {
            $('#slide-menu-button-close').animate({ left: -250 }, 'slow', function() {
                $('#slide-menu-button').html('<img src="' + params.template_uri + '/images/baseline_menu_black_48dp_2x.png.png" alt="Open Menu" />');
            });
        }
    );
})(jQuery);