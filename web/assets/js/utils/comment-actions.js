/**
 * Created by SaadAchraf on 3/26/2019.
 */


// Handle events for the generated comments.
$(function(){
    $('.comment-edit').on('click', function()
    {
        var commentId = $(this).attr('data-comment-id');
        var commentCore = $('#comment-core-' + commentId);
        var commentEditTextArea = $('#comment-edit-textarea-' + commentId);
        var commentCancel = $('#comment-edit-cancel-' + commentId);
        var commentDelete = $('#comment-delete-' + commentId);
        var commentEditTexts = $('#comment-edit-' + commentId);

        commentCancel.on('click', function()
        {
            commentEditTexts.find('span.edit-text').show();
            commentEditTexts.find('span.confirm-text').hide();

            commentCore.show();
            commentCancel.hide();
            commentDelete.hide();
            commentEditTextArea.hide();
        });

        commentDelete.on('click', function()
        {
            var commentElement = $('#comment-element-' + commentId);

            deleteCommentById(commentId);

            commentElement.remove();
        });

        if($(commentCore).is(":hidden")) // Must show, and user is confirming, make ajax call here to edit comment.
        {
            commentEditTexts.find('span.edit-text').show();
            commentEditTexts.find('span.confirm-text').hide();

            commentCore.show();
            commentCancel.hide();
            commentDelete.hide();
            commentEditTextArea.hide();

            const oldContent = commentCore.get(0).textContent;
            const newContent = commentEditTextArea.find('textarea').val();

            if(oldContent === newContent || newContent === "")
                return;

            commentCore.get(0).textContent = newContent;

            // Save to comment change DB using AJAX request.
            updateCommentById(commentId, newContent);

            // Fake editing state.
            const editedText = $('#edited-text-' + commentId);
            editedText.removeAttr("hidden");
        }
        else // Edit mode
        {
            commentEditTexts.find('span.edit-text').hide();
            commentEditTexts.find('span.confirm-text').show();

            commentCore.hide();
            commentCancel.show();
            commentDelete.show();
            commentEditTextArea.show();
            commentEditTextArea.find('textarea').val(commentCore.text());
        }
    })
});

function createCommentByData(formData)
{
    $.ajax({
        url: path_to_comment_create,
        type: 'POST',
        dataType: 'json',
        data: formData,
        success:function(data){
            // handling the response data from the controller
            if(data.status == 'success'){
                console.log('Creating comment success, result state: ' + data);
            }
            if(data.status == 'error'){
                console.log('Error during comment creation, result state: ' + data);
            }
        }
    });
}

function updateCommentById(commentId, content)
{
    $.ajax({
        url: path_to_comment_update,
        type: "POST",
        dataType: "json",
        data: {
            "id": commentId,
            "content": content
        },
        async: true,
        success: function (data)
        {
            console.log('Updating comment success, result state: ' + data);

        },
        error: function (data)
        {
            console.log('Error during comment update, result state: ' + data);
        }
    })
}

function deleteCommentById(commentId, content)
{
    $.ajax({
        url:  path_to_comment_delete,
        type: "POST",
        dataType: "json",
        data: {
            "id": commentId,
        },
        async: true,
        success: function (data)
        {
            console.log('Deleting comment success, result state: ' + data);

        },
        error: function (data)
        {
            console.log('Error during comment deletion, result state: ' + data);
        }
    })

}