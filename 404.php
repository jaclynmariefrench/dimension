<?php
error_log('404.php template loaded');
get_header(); // Include the header
?>

<div id="main">
    <article id="post-not-found">
        <h2 class="major">Page Not Found</h2>
        <div class="content">
            <p>Sorry, the page you are looking for does not exist. It might have been moved or deleted.</p>
            <p>You can go back to the <a href="<?php echo home_url(); ?>">homepage</a></p>
        </div>
    </article>
</div>

<?php
get_footer(); // Include the footer
?>
