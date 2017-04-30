jQuery(function($) {
    $(document).ready(function(){
        //------------------------------------------------------------------------------------------------------------------
        // Navigation
        //------------------------------------------------------------------------------------------------------------------
        var navigationItem = $('nav.desktop-navigation .menu-item');
        var navigationSubMenu = 'ul.sub-menu';
        navigationItem.on('mouseenter', function(){
            $(this).find(navigationSubMenu).stop( true, true ).slideDown('slow');
        });
        navigationItem.on('mouseleave', function(){
            $(this).find(navigationSubMenu).stop( true, true ).slideUp('slow');
        });

        // Position the sub navigation
        //var menuPosition = $('nav .content').position();
        var navigationWidth = $('nav').width();
        var navigationContentWidth = $('nav .content').width();
        var menuPosition = (navigationWidth - navigationContentWidth) / 2;
        $('nav .sub-menu').css({
            'left': menuPosition + 32 + 'px'
        });

        //------------------------------------------------------------------------------------------------------------------
        // Mobile navigation
        //------------------------------------------------------------------------------------------------------------------
        var windowWidth = $(window).width();
        var mobileNavigation = $('nav.mobile-navigation .content');
        var btnCloseMobileNavigation = $('nav.mobile-navigation .mobile-navigation-btn-close');
        var btnOpenMobileNavigation = $('nav.mobile-navigation .burger-navigation');

        // Hide navigation on document ready
        hideNavigationMobileOnDocumentReady(mobileNavigation, windowWidth);
        hideNavigationMobileOnDocumentReady(btnCloseMobileNavigation, windowWidth);

        // Open the mobile navigation on click on button burger
        btnOpenMobileNavigation.on('click', function(){
            mobileNavigation.show();
            btnCloseMobileNavigation.show();
            openNavigationMobile(btnCloseMobileNavigation, windowWidth);
            openNavigationMobile(mobileNavigation, windowWidth);
        });

        // Close the mobile navigation on click on button close navigation
        btnCloseMobileNavigation.on('click', function(){
            closeNavigationMobile($(this), windowWidth);
            closeNavigationMobile(mobileNavigation, windowWidth);
        });
        //------------------------------------------------------------------------------------------------------------------
    });
});