<?php
get_header();
get_template_part("modules/header-element");
get_template_part("modules/navigation");
?>
    <div id="pixie-index">
        <div class="content">
            <?php
            get_sidebar();
            if ( have_posts() ) {
            ?>
            <div class="posts-list">
                <?php
                while ( have_posts() ) {
                    the_post();
                    ?>
                    <div class="post-preview">
                        <?php if(has_post_thumbnail()){ ?>
                            <div class="post-preview-image"><?php the_post_thumbnail(); ?></div>
                        <?php } ?>
                        <div class="post-preview-resume">
                            <h2><?php the_title(); ?></h2>
                            <div class="post-preview-date-parution">Publié le : <?php print(get_the_date()); ?></div>
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <?php } ?>
        </div>
    </div>
<?php
get_footer();
