(function ($) {
    "use strict";

    $(document).ready(function($){

        // stikcy js
        $("#sticker").sticky({
            topSpacing: 0
        });

        //mean menu
        $('.main-menu').meanmenu({
            meanMenuContainer: '.mobile-menu',
            meanScreenWidth: "992"
        });

    });

    jQuery(window).on("load",function(){
        jQuery(".loader").fadeOut(1000);
    });

}(jQuery));