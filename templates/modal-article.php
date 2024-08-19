<?php
/*
Template Name: Modal Article
*/
get_header();
?>

<!-- Main -->
<div id="main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
    ?>
        <article id="<?php echo sanitize_title(get_the_title()); ?>">
            <h2 class="major"><?php the_title(); ?></h2>
            <span class="image main">
                <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail('full');
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/assets/images/pic01.jpg" alt="" />';
                }
                ?>
            </span>
            <div class="content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php
        endwhile;
    endif;
    ?>
</div>

<?php get_footer(); ?>