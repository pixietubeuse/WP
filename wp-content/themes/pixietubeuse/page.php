<?php
get_header();
get_template_part("modules/header-element");
get_template_part("modules/navigation");
?>
<div id="pixie-page">
    <div class="content">
        <div class="page-detail">
            <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    ?>
                    <h2><?php the_title(); ?></h2>
                    <?php if(has_post_thumbnail()) { ?>
                        <div class="page-image"><?php the_post_thumbnail(); ?></div>
                    <?php }
                    $contentExist = the_content();
                    if($contentExist != null) { ?>
                        <div class="page-content"><?php the_content(); ?></div>
                    <?php } ?>
                <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
comments_template();
get_footer();
