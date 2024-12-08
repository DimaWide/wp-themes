jQuery(document).ready(function($) {
    $('#request_new_token').on('click', function() {
        var postId = $('#post_ID').val(); // Get the post ID

        $.ajax({
            url: TokenStatusData.ajax_url, // AJAX URL
            type: 'POST',
            data: {
                action: 'request_token_update',
                post_id: postId,
                security: TokenStatusData.nonce, // Pass the nonce for security
            },
            success: function(response) {
                if (response.success) {
                    alert('Token Status: ' + response.data);
                    location.reload(); // Reload the page to show the updated token status
                } else {
                    alert('Error: ' + response.data);
                }
            },
            error: function() {
                alert('An error occurred.');
            }
        });
    });
});
