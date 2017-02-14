<?php
get_header();
get_template_part("modules/header-element");
get_template_part("modules/navigation");
?>
<div id="pixie-front-page">
    <div class="content">
        <?php get_sidebar(); ?>
        <div class="posts-list">
            <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    ?>
                    <div class="post-preview">
                        <div class="post-preview-image">
                        <?php
                        the_post_thumbnail();
                        ?>
                        </div>
                        <div class="post-preview-resume">
                            <h2>
                                <?php the_title(); ?>
                            </h2>
                            <div class="post-preview-date-parution">Publié le : <?php the_date(); ?></div>
                            <?php
                            the_content();
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
