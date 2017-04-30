jQuery(function($) {
    $(document).ready(function(){
        //------------------------------------------------------------------------------------------------------------------
        // Sidebar
        //------------------------------------------------------------------------------------------------------------------
        $('.more-informations .contact-information').on('mouseenter', function(){
            $(this).find('img').attr('src', 'http://pixietubeuse.com/wp-content/themes/pixietubeuse/images/btn_contact_hover.png');
        });
        $('.more-informations .contact-information').on('mouseleave', function(){
            $(this).find('img').attr('src', 'http://pixietubeuse.com/wp-content/themes/pixietubeuse/images/btn_contact.png');
        });
        $('.more-informations .presentation-information').on('mouseenter', function(){
            $(this).find('img').attr('src', 'http://pixietubeuse.com/wp-content/themes/pixietubeuse/images/btn_presentation_hover.png');
        });
        $('.more-informations .presentation-information').on('mouseleave', function(){
            $(this).find('img').attr('src', 'http://pixietubeuse.com/wp-content/themes/pixietubeuse/images/btn_presentation.png');
        });
        //------------------------------------------------------------------------------------------------------------------
    });
});