jQuery(document).ready(function($) {
    //------------------------------------------------------------------------------------------------------------------
    // menu de navigation
    //------------------------------------------------------------------------------------------------------------------
    $('nav.desktop-navigation .menu-item').on('mouseenter', function(){
        $(this).find('nav.desktop-navigation .sub-menu').stop( true, true ).slideDown('slow');
    });
    $('nav.desktop-navigation .menu-item').on('mouseleave', function(){
        $(this).find('nav.desktop-navigation .sub-menu').stop( true, true ).slideUp('slow');
    });

    //placement du sous-menu
    //var menuPosition = $('nav .content').position();
    var navigationWidth = $('nav').width();
    var navigationContentWidth = $('nav .content').width();
    var menuPosition = (navigationWidth - navigationContentWidth) / 2;
    $('nav .sub-menu').css({left: menuPosition + 32});
    //------------------------------------------------------------------------------------------------------------------
});