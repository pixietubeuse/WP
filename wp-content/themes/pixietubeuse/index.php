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
                <div class="pagination">
                    <?php
                    $parametersPagination = [
                        'end_size'          => 3,
                        'mid_size'          => 0,
                        'prev_text'         => '<div class="pagination-prev"></div>',
                        'next_text'         => '<div class="pagination-next"></div>',
                    ];
                    print(paginate_links($parametersPagination));
                    ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
<?php
get_footer();
