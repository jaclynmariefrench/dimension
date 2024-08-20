<?php
// Retrieve the post from query variables
$post = get_query_var('custom_post');

if ($post && $post instanceof WP_Post) {
    error_log('Template found post content. Post Title: ' . get_the_title($post));
    ?>
    <article id="<?php echo sanitize_title(get_the_title($post)); ?>">
        <h2 class="major"><?php echo get_the_title($post); ?></h2>
        <div class="content">
            <?php echo apply_filters('the_content', $post->post_content); ?>
        </div>
        <div class="close">Close</div> 
    </article>
    <?php
} else {
    error_log('Template unable to find post content. Post object: ' . print_r($post, true));
    echo 'No content found';
}
?>







