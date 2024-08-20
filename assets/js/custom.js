jQuery(document).ready(function($) {
    $('.modal-link').on('click', function(e) {
        e.preventDefault();
        var postSlug = $(this).data('article-id');
        console.log('Collected article-id:', postSlug);

        // Use the ajaxurl directly for the request
        var ajaxUrl = ajaxurl + '?action=load_modal_article&slug=' + encodeURIComponent(postSlug);
        console.log('Constructed AJAX URL:', ajaxUrl);

        $.ajax({
            url: ajaxUrl,
            type: 'GET',
            success: function(response) {
                console.log('AJAX Success Response:', response);
                $('#modal-content').html(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' - ' + error);
                console.error('AJAX Error Details:', xhr.responseText);
            }
        });
    });
});


