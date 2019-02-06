(function($) {
    $('#toggle').toggle(
        function() {
            $('#popout').animate({ left: 0 }, 'slow', function() {
                $('#toggle').html('<img src="http://www.example.com/wp-content/themes/your-theme/images/menu.png" alt="close" />');
            });
        },
        function() {
            $('#popout').animate({ left: -250 }, 'slow', function() {
                $('#toggle').html('<img src="http://www.example.com/wp-content/themes/your-theme/images/menu.png" alt="close" />');
            });
        }
    );
})(jQuery);