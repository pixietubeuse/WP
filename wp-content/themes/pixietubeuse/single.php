<?php
get_header();
get_template_part("modules/header-element");
get_template_part("modules/navigation");
?>
<div id="pixie-single">
    <div class="content">
        <div class="article-detail">
            <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    ?>
                    <h2><?php the_title(); ?></h2>
                    <div class="article-date-parution">Publié le : <?php the_date(); ?></div>
                    <?php if(has_post_thumbnail()) { ?>
                        <div class="article-image"><?php the_post_thumbnail(); ?></div>
                    <?php }
                    $contentExist = the_content();
                    if($contentExist != null){
                    ?>
                        <div class="article-texte"><?php the_content(); ?></div>
                    <?php } ?>
                <?php
                }
            }
            ?>
        </div>
        <div class="article-partage">
            <div class="center-partage">
                <div class="texte-partage">Partager cet article :</div>
                <div class="reseaux-partage">Réseaux sociaux</div>
            </div>
        </div>
    </div>
    <?php comments_template(); ?>
</div>
<?php
get_footer();
