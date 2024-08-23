$(document).ready(function() {


    // Show or hide comments when the comment icon is clicked
    $('.comment-icon-trigger').on('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior

        var postId = $(this).data('post-id');
        var commentsSection = $('#comments-section-' + postId);

        // Toggle comments section visibility
        if (commentsSection.is(':visible')) {
            commentsSection.hide(); // Hide comments if they are visible
            return; // Exit the function early
        }

        // If comments are not visible, show them
        var routeUrl = commentsRoute + '/' + postId; // Construct the URL


        $.ajax({
            url: routeUrl,
            method: 'GET',
            success: function(response) {
                var commentsHtml = '';
                if (response.comments.length > 0) {
                    response.comments.forEach(function(comment) {
                        commentsHtml += `
                            <div class="comment mb-3">
                                <div class="comment-header d-flex align-items-center mb-2">
                                    <img src="${postUserImageUrl}" alt="User Icon" class="user-icon">
                                    <span class="username ml-2 font-weight-bold">${comment.user.name}</span>
                                </div>
                                <div class="comment-body">
                                    <p>${comment.comment}</p>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    commentsHtml = '<p>No comments yet.</p>';
                }

                commentsHtml += `
                    <div class="add-comment mt-3">
                        <button class="btn btn-primary" id="show-comment-input-${postId}" data-post-id="${postId}">Add Comment</button>
                        <div class="comment-input-container" id="comment-input-container-${postId}" style="display: none;">
                            <textarea id="comment-input-${postId}" class="form-control mt-2" rows="3" placeholder="Write your comment here..."></textarea>
                            <button class="btn btn-primary mt-2" id="add-comment-btn-${postId}" data-post-id="${postId}">Submit Comment</button>
                        </div>
                    </div>
                `;

                // Insert the comments HTML into the correct comments section
                commentsSection.html(commentsHtml).show(); // Show the comments section


            },
            error: function(xhr, status, error) {
                console.error('Error fetching comments:', status, error);
            }
        });
    });

    // Show the comment input field when "Add Comment" button is clicked
    $(document).on('click', '[id^="show-comment-input-"]', function() {
        var postId = $(this).data('post-id');
        $('#comment-input-container-' + postId).show();
        $(this).hide(); // Hide the "Add Comment" button after clicking
    });

    // Handle "Submit Comment" button click
    $(document).on('click', '[id^="add-comment-btn-"]', function() {
        var postId = $(this).data('post-id');
        var commentText = $('#comment-input-' + postId).val();

        if (commentText.trim() === '') {
            alert('Please enter a comment.');
            return;
        }

        var paras = {
            comment: commentText,
            post_id: postId
        };

        $.ajax({
            url: commentsAdd,
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken // Ensure csrfToken is correctly defined
            },
            contentType: 'application/json',
            data: JSON.stringify(paras),
            success: function(response) {
                if (response.success) {
                    // Reload comments after adding a new comment
                    $('.comment-icon-trigger[data-post-id="' + postId + '"]').trigger('click');
                } else {
                    alert('Important Note: Failed to add comment');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error adding comment:', status, error);
                alert('Failed to add comment.');
            }
        });
    });
});
