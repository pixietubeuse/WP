<?php
$postID = get_the_ID();
if($postID != null){
?>
    <a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php print(get_permalink($postID)); ?>&t=<?php print(get_the_title($postID)); ?>" title="Partager sur Facebook" target="_blank">
        <img src="<?php print(get_template_directory_uri() . '/images/btn_facebook.png'); ?>" alt="Partager sur Facebook" />
    </a>
    <a class="twitter" href="https://twitter.com/intent/tweet/?url=<?php print(get_permalink($postID)); ?>&text=<?php print(get_the_title($postID)); ?>" title="Partager sur Twitter" target="_blank">
        <img src="<?php print(get_template_directory_uri() . '/images/btn_twitter.png'); ?>" alt="Partager sur Twitter" />
    </a>
    <a class="pinterest" href="https://pinterest.com/pin/create/button/?url=<?php print(get_permalink($postID)); ?>&media=<?php print(get_the_post_thumbnail_url($postID)); ?>&description=<?php print(get_the_title($postID)); ?>" title="Partager sur Pinterest" target="_blank">
        <img src="<?php print(get_template_directory_uri() . '/images/btn_pinterest.png'); ?>" alt="Partager sur Pinterest" />
    </a>
<?php
}