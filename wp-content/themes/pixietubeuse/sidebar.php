<div id="pixie-sidebar">
    <?php
    // get footer picture logo (signature picture)
    $bienvenuePod = pods('bienvenue');
    if($bienvenuePod->exists()){
        $titreBienvenue = $bienvenuePod->display('bienvenue_titre');
        $imageBienvenue = $bienvenuePod->display('bienvenue_image');
        $texteBienvenue = $bienvenuePod->display('bienvenue_texte');
    }
    $signaturePod = pods('signature');
    if($signaturePod->exists()){
        $urlBienvenueSignaturePicture = $signaturePod->display('image');
    }
    ?>
    <div id="bienvenue">
        <h2><?php print($titreBienvenue); ?></h2>
        <img class="bienvenue-image" src="<?php print($imageBienvenue); ?>" alt="Pixietubeuse" />
        <div><?php print($texteBienvenue); ?></div>
        <img class="bienvenue-signature" src="<?php print($urlBienvenueSignaturePicture); ?>" alt="Pixietubeuse">
    </div>

    <div class="items">
        <!-- YouTube bouton start -->
        <script src="https://apis.google.com/js/platform.js"></script>
        <script>
            function onYtEvent(payload) {
                if (payload.eventType == 'subscribe') {
                    // Add code to handle subscribe event.
                } else if (payload.eventType == 'unsubscribe') {
                    // Add code to handle unsubscribe event.
                }
                if (window.console) { // for debugging only
                    window.console.log('YT event: ', payload);
                }
            }
        </script>
        <div class="g-ytsubscribe" data-channelid="UCHlYqC9HCDm6I5L5gEq8FbQ" data-layout="full" data-count="default" data-onytevent="onYtEvent"></div>
        <!-- YouTube bouton end -->

        <div class="more-informations">
            <?php
            $userInfos = get_userdata(1);
            $templateUri = get_template_directory_uri() . '/images/';
            ?>
            <div class="contact-information">
                <a href="mailto:<?php print($userInfos->user_email); ?>" target="_blank">
                    <img src="<?php print($templateUri . 'btn_contact.svg'); ?>" alt="Contact" />
                    <div>Contact</div>
                </a>
            </div>
            <div class="presentation-information">
                <a href="">
                    <img src="<?php print($templateUri . 'btn_presentation.svg'); ?>" alt="Présentation" />
                    <span>Présentation</span>
                </a>
            </div>
        </div>

        <?php if (is_active_sidebar("sidebar-left")) { ?>
            <ul>
                <?php dynamic_sidebar("sidebar-left"); ?>
            </ul>
        <?php } ?>
        <?php wp_meta(); ?>
    </div>
</div>