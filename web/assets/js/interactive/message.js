/**
 * Created by SaadAchraf on 3/23/2019.
 */

/*
* globals:
*       messages_count: true;
*       path_to_messages_unseen: true;
*/

const msgEl = document.querySelector('.message');

if(msgEl != null)
    msgEl.style.cursor = 'pointer';

// Refresh when loading the page.
refreshMessages();

function refreshMessages() {

    if(typeof path_to_messages_unseen === 'undefined')
        return;

    $.ajax({
        url: path_to_messages_unseen,
        type: "POST",
        dataType: "json",
        async: true,
        success: function (data)
        {
            setMessagesCount(data.length);
            console.log('Refreshing Messages, '+ data.length + ' data length received.');
        }
    })

}

function goTo(path) {
    window.location.href = path;
}

function setMessagesCount(newCount = 0) {
    var msgEl = document.querySelector('.message');

    if(msgEl) {
        //var count = Number(msgEl.getAttribute('message-data-count')) || 0;
        //msgEl.setAttribute('message-data-count', newCount);
        if (newCount != 0) {
            msgEl.setAttribute('message-data-count', newCount);
            msgEl.classList.add('message-notify');
            msgEl.classList.add('message-show-count');
        }

        if(newCount == 0)
        {
            msgEl.classList.remove('message-notify');
            msgEl.classList.remove('message-show-count');
            msgEl.classList.remove('message-show-count');
        }
    }
}