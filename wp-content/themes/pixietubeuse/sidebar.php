<div id="pixie-sidebar">
    <?php
    // get footer picture logo (signature picture)
    $bienvenuePod = pods('bienvenue');
    if($bienvenuePod->exists()){
        $titreBienvenue = $bienvenuePod->display('bienvenue_titre');
        $imageBienvenue = $bienvenuePod->display('bienvenue_image');
        $texteBienvenue = $bienvenuePod->display('bienvenue_texte');
        $userEmailBienvenue = $bienvenuePod->field('bienvenue_contact');
        $presentationPageBienvenue = $bienvenuePod->field('bienvenue_presentation_page');
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
        <div class="btn-youtube">
            <div class="g-ytsubscribe" data-channelid="UCHlYqC9HCDm6I5L5gEq8FbQ" data-layout="full" data-count="default"></div>
        </div>
        <!-- YouTube bouton end -->

        <div class="more-informations">
            <?php
            $userInfos = get_userdata(1);
            $templateUri = get_template_directory_uri() . '/images/';
            ?>
            <div class="contact-information">
                <a href="mailto:<?php print($userEmailBienvenue['user_email']); ?>" target="_blank">
                    <img src="<?php print($templateUri . 'btn_contact.svg'); ?>" alt="Contact" />
                    <div>Contact</div>
                </a>
            </div>
            <div class="presentation-information">
                <a href="<?php print(get_permalink($presentationPageBienvenue['ID'])); ?>" title="<?php print($presentationPageBienvenue['post_title']); ?>">
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