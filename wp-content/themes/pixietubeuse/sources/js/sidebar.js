jQuery(document).ready(function($) {
    //------------------------------------------------------------------------------------------------------------------
    // sidebar
    //------------------------------------------------------------------------------------------------------------------
    $('.more-informations .contact-information').on('mouseenter', function(){
        $(this).find('img').attr('src', 'http://pixietubeuse.com/wp-content/themes/pixietubeuse/images/btn_contact_hover.svg');
    });
    $('.more-informations .contact-information').on('mouseleave', function(){
        $(this).find('img').attr('src', 'http://pixietubeuse.com/wp-content/themes/pixietubeuse/images/btn_contact.svg');
    });
    $('.more-informations .presentation-information').on('mouseenter', function(){
        $(this).find('img').attr('src', 'http://pixietubeuse.com/wp-content/themes/pixietubeuse/images/btn_presentation_hover.svg');
    });
    $('.more-informations .presentation-information').on('mouseleave', function(){
        $(this).find('img').attr('src', 'http://pixietubeuse.com/wp-content/themes/pixietubeuse/images/btn_presentation.svg');
    });
    //------------------------------------------------------------------------------------------------------------------
});