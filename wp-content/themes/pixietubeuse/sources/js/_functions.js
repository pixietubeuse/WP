//------------------------------------------------------------------------------------------------------------------
// Mobile navigation
//------------------------------------------------------------------------------------------------------------------

// Position navigation with screen size to put it out of the screen view
function hideNavigationMobileOnDocumentReady(element, screenWidth){
    element.css({
        'right': '-' + screenWidth + 'px'
    });
}

// Close navigation with screen size to put the navigation out of the screen view
function closeNavigationMobile(element, screenWidth){
    element.animate({
        'right': '-=' + screenWidth
    }, 400);
}

// Show the navigation with screen size to put the navigation in the screen view
function openNavigationMobile(element, screenWidth){
    element.animate({
        'right': '+=' + screenWidth
    }, 400);
}