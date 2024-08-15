<?php get_header(); ?>

<div id="main-content">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            // Display post content
            the_title('<h2>', '</h2>');
            the_content();
        endwhile;
    else :
        echo '<p>No content found</p>';
    endif;
    ?>
</div>

<?php get_footer(); ?>
