<?php
$entetePods = pods('entete');
if($entetePods->exists()){
    $enteteBackgroundColor = $entetePods->display('couleur_d_arriere_plan');
}
?>
<header style="background-color: <?php print($enteteBackgroundColor); ?>;">
    <div class="content">
        <img id="header-custom-image" src="<?php echo( get_header_image() ); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
    </div>
</header>