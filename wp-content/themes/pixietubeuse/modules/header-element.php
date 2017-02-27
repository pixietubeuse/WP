<?php
$entetePods = pods('entete');
if($entetePods->exists()){
    $enteteBackgroundColor = $entetePods->display('couleur_d_arriere_plan');
}
?>
<header style="background-color: <?php print($enteteBackgroundColor); ?>;">
    <div class="content">
        <a href="<?php print(get_bloginfo('url')); ?>" title="<?php print(get_bloginfo('title')); ?>" class="header-link-home">
            <img id="header-custom-image" src="<?php echo( get_header_image() ); ?>" alt="<?php print(get_bloginfo('title')); ?>" />
        </a>
    </div>
</header>