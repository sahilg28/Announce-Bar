(function($) {
    'use strict';

    $(function() {
        // Position for admin bar
        var $announceBar = $('#announce-bar');
        
        if ($('body').hasClass('admin-bar') && $announceBar.length) {
            $announceBar.css('top', $('#wpadminbar').outerHeight() + 'px');
            
            $(window).on('resize', function() {
                $announceBar.css('top', $('#wpadminbar').outerHeight() + 'px');
            });
        }
    });
    
})(jQuery); 