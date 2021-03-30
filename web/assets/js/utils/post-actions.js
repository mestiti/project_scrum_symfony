// Handle events for the generated posts.
$(function(){

    $('.post-signaler').on('click', function()
    {
        g_post_id_signal = $(this).attr('data-post-id');

    })

    // News stuff here

    $('.news-edit').on('click', function()
    {
        var newsId = $(this).attr('data-news-id');

        var newsCore = $('#news-core-' + newsId);
        var newsMedia = $('#news-media-' + newsId);
        var newsEditTextArea = $('#news-edit-textarea-' + newsId);
        var newsCancel = $('#news-edit-cancel-' + newsId);
        var newsDelete = $('#news-delete-' + newsId);
        var newsEditTexts = $('#news-edit-' + newsId);

        newsCancel.on('click', function()
        {
            newsEditTexts.find('span.edit-text').show();
            newsEditTexts.find('span.confirm-text').hide();

            newsCore.show();
            newsCancel.hide();
            newsDelete.hide();
            newsEditTextArea.hide();
        });

        newsDelete.on('click', function()
        {
            var newsElement = $('#post_id_' + newsId);

            deletePostById(newsId);

            newsElement.remove();
        });

        if($(newsCore).is(":hidden")) // Must show, and user is confirming, make ajax call here to edit announce.
        {
            newsEditTexts.find('span.edit-text').show();
            newsEditTexts.find('span.confirm-text').hide();

            newsCore.show();
            newsCancel.hide();
            newsDelete.hide();
            newsEditTextArea.hide();

            const oldContent = newsCore.get(0).textContent;
            const newContent = newsEditTextArea.find('textarea').val();

            if(oldContent === newContent || newContent === "")
                return;

            newsCore.get(0).textContent = newContent;

            // Save to announce change DB using AJAX request.
            //updateAnnounceById(announceId, announceTitle, newContent, announceMedia, announceMinPrice, announceMaxPrice);
            updatePostById(newsId, newContent, 'https://media.com');

            // Fake editing state.
            const editedText = $('#edited-text-' + newsId);
            editedText.removeAttr("hidden");
        }
        else // Edit mode
        {
            newsEditTexts.find('span.edit-text').hide();
            newsEditTexts.find('span.confirm-text').show();

            newsCore.hide();
            newsCancel.show();
            newsDelete.show();
            newsEditTextArea.show();
            newsEditTextArea.find('textarea').val(newsCore.text());
        }
    })
});
    $('.accept-aa-btn').on('click', function()
    {
        var announceId = $(this).attr('data-announce-id');
        var providerId = $(this).attr('data-provider-id');

        $(this).hide();

        AcceptAAOfProviderById(announceId, providerId);
    });

    $('.announce-apply-btn').on('click', function()
    {
        var announceId = $(this).attr('data-announce-id');

        var announceApplyBtn = $('#announce-apply-' + announceId);
        var announceCancelApplyBtn = $('#announce-cancel-apply-' + announceId);

        // toggle buttons visibility (apply /cancel-apply)
        // apply using ajax
        announceApplyBtn.parent().hide();
        announceCancelApplyBtn.parent().show();

        SetApplyStateToAnnounceById(announceId, "PENDING");
    });

    $('.announce-cancel-apply-btn').on('click', function()
    {
        var announceId = $(this).attr('data-announce-id');

        var announceApplyBtn = $('#announce-apply-' + announceId);
        var announceCancelApplyBtn = $('#announce-cancel-apply-' + announceId);

        // toggle buttons visibility (apply /cancel-apply)
        // apply using ajax
        announceCancelApplyBtn.parent().hide();
        announceApplyBtn.parent().show();

        SetApplyStateToAnnounceById(announceId, "CANCELED");
    });
    $('.announce-edit').on('click', function()
    {
        var announceId = $(this).attr('data-announce-id');

        var announceTitle = $('#announce-title-' + announceId);
        var announceCore = $('#announce-core-' + announceId);
        var announceMedia = $('#announce-media-' + announceId);
        var announceMinPrice = $('#announce-minprice-' + announceId);
        var announceMaxPrice = $('#announce-maxprice-' + announceId);
        var announceEditTextArea = $('#announce-edit-textarea-' + announceId);
        var announceCancel = $('#announce-edit-cancel-' + announceId);
        var announceDelete = $('#announce-delete-' + announceId);
        var announceEditTexts = $('#announce-edit-' + announceId);

        announceCancel.on('click', function()
        {
            announceEditTexts.find('span.edit-text').show();
            announceEditTexts.find('span.confirm-text').hide();

            announceCore.show();
            announceCancel.hide();
            announceDelete.hide();
            announceEditTextArea.hide();
        });

        announceDelete.on('click', function()
        {
            var announceElement = $('#post_id_' + announceId);

            deletePostById(announceId);

            announceElement.remove();
        });

        if($(announceCore).is(":hidden")) // Must show, and user is confirming, make ajax call here to edit announce.
        {
            announceEditTexts.find('span.edit-text').show();
            announceEditTexts.find('span.confirm-text').hide();

            announceCore.show();
            announceCancel.hide();
            announceDelete.hide();
            announceEditTextArea.hide();

            const oldContent = announceCore.get(0).textContent;
            const newContent = announceEditTextArea.find('textarea').val();

            if(oldContent === newContent || newContent === "")
                return;

            announceCore.get(0).textContent = newContent;

            // Save to announce change DB using AJAX request.
            //updateAnnounceById(announceId, announceTitle, newContent, announceMedia, announceMinPrice, announceMaxPrice);
            updateAnnounceById(announceId, 'Looking for jardinier', newContent, 'https://media.com', 59, 78);

            // Fake editing state.
            const editedText = $('#edited-text-' + announceId);
            editedText.removeAttr("hidden");
        }
        else // Edit mode
        {
            announceEditTexts.find('span.edit-text').hide();
            announceEditTexts.find('span.confirm-text').show();

            announceCore.hide();
            announceCancel.show();
            announceDelete.show();
            announceEditTextArea.show();
            announceEditTextArea.find('textarea').val(announceCore.text());
        }
    });
function createPostByData(formData)
{
    $.ajax({
        url: path_to_post_create,
        type: 'POST',
        dataType: 'json',
        data: formData,
        success:function(data){
            // handling the response data from the controller
            if(data.status == 'success'){
                console.log('Creating post success, result state: ' + data);
            }
            if(data.status == 'error'){
                console.log('Error during post creation, result state: ' + data);
            }
            if(data.status == 'timeout'){
                console.log('Request timed out (creating post).')
            }}

    });
}

function updatePostById(postId, content, media)
{
    $.ajax({
        url: path_to_post_update,
        type: "POST",
        dataType: "json",
        data: {
            "id": postId,
            "content": content,
            "media": media,
        },
        async: true,
        success: function (data)
        {
            console.log('Updating post success, result state: ' + data);

        },
        error: function (data)
        {
            console.log('Error during post update, result state: ' + data);
        }
    })
}

function updateAnnounceById(announceId, title, content, media, minPrice, maxPrice)
{
    $.ajax({
        url: path_to_post_update,
        type: "POST",
        dataType: "json",
        data: {
            "id": announceId,
            "title": title,
            "content": content,
            "media": media,
            "minPrice": minPrice,
            "maxPrice": maxPrice,
        },
        async: true,
        success: function (data)
        {
            console.log('Updating announce success, result state: ' + data);

        },
        error: function (data)
        {
            console.log('Error during announce update, result state: ' + data);
        }
    })
}
function deletePostById(postId)
{
    $.ajax({
        url:  path_to_post_delete,
        type: "POST",
        dataType: "json",
        data: {
            "id": postId,
        },
        async: true,
        success: function (data)
        {
            console.log('Deleting announce success, result state: ' + data);

        },
        error: function (data)
        {
            console.log('Error during announce deletion, result state: ' + data);
        }
    })
}

// ************* Announce Appliance Related *****************

function SetApplyStateToAnnounceById(announceId, stateStr)
{
    $.ajax({
        url:  path_to_announce_apply,
        type: "POST",
        dataType: "json",
        data: {
            "id": announceId,
            "status": stateStr
        },
        async: true,
        success: function (data)
        {
            console.log('Applying to announce success, result state: ' + data);

        },
        error: function (data)
        {
            console.log('Error during applying to announce, result state: ' + data);
        }
    })
}

function AcceptAAOfProviderById(announceId, providerId)
{
    $.ajax({
        url:  path_to_announce_apply,
        type: "POST",
        dataType: "json",
        data: {
            "id": announceId,
            "status": 'ACCEPTED',
            "providerId": providerId
        },
        async: true,
        success: function (data)
        {
            console.log('Applying to announce success, result state: ' + data);

        },
        error: function (data)
        {
            console.log('Error during applying to announce, result state: ' + data);
        }
    })
}

function SignalPostByData(formData)
{
    $.ajax({
        url:  path_to_post_signal,
        type: "POST",
        dataType: "json",
        data: formData,
        async: true,
        success: function (data)
        {
            console.log('Signal to post success, result state: ' + data);

        },
        error: function (data)
        {
            console.log('Error during signal to post, result state: ' + data);
            console.log(data);
        }
    })
}