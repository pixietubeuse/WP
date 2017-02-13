<?php
get_header();
get_template_part("modules/header-element");
get_template_part("modules/navigation");
?>
<div id="pixie-front-page">
    <div class="content">
        <?php get_sidebar(); ?>
        <div class="posts-list">
            <div>front-page</div>
            <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    the_post_thumbnail();
                    the_title();
                    the_content();
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
