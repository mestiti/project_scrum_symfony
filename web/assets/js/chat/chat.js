/**
 * Created by SaadAchraf on 3/23/2019.
 */

/*
 description:
 This js is used to handle chat conversation, recent messages
 and chat related events.
 Overrides chat-subscriber subscription's events such us
 onmessage, to handle specific events for the importor template.

 importor:
 chat/Resources/views/index.

 globals:
 g_ws_chat_url: true // from: app/Resources/views/base.
 g_user_id: true // app/Resources/views/base.
 g_other_user: true // Current conversation other user.
 rcms: true // Reference to recent chat messages container.
 */

// Reference to conversation content div, used read from and load.
var _receiver = $('#ws-chat-conversation-content');

/*
 Draws sending messages view.
 */
function drawSentMessage(message, date, scrollOnAppend = true)
{
    if(_receiver !== null)
    _receiver.append('<div class="outgoing_msg"> '+
        '<div class="sent_msg">'+
        '<p>'+ message +
        '</p>'+
        '<span class="time_date">'+ date +'</span> </div>'+
        '</div>');

    if(scrollOnAppend)
        _receiver.animate({scrollTop: _receiver.prop("scrollHeight")}, 300);
}

/*
 Draws received messages view.
 */
function drawReceivedMessage(message, date, scrollOnAppend = true)
{
    _receiver.append('<div class="incoming_msg">'+
        '<div class="incoming_msg_img"> <img src=' + g_other_user_img_url + ' alt="sunil"> </div>'+
        '<div class="received_msg">'+
        '<div class="received_withd_msg">'+
        '<p>'+message+'</p>'+
        '<span class="time_date">'+ date +'</span></div>'+
        '</div>'+
        '</div>');

    if(scrollOnAppend)
        _receiver.animate({scrollTop: _receiver.prop("scrollHeight")}, 300);
}

/*
 Event called when receiving/sending message,
 used to update related conversation recent message tab.
 */
function updateCurrentRecentMessageTab(message)
{
    const d = new Date().toLocaleString();


    if(rcms === undefined || rcms === null)
        return;


    for(var i = 0; i < rcms.length; i++)
    {
        const other_user = rcms[i].getElementsByClassName("other_user")[0].textContent;

        if(other_user === g_other_user) {
            const chat_content_elem = rcms[i].getElementsByClassName("chat_content")[0];
            const chat_date_elem = rcms[i].getElementsByClassName("chat_date")[0];

            chat_content_elem.textContent = message;
            chat_date_elem.textContent = d;

            break;
        }
    }
}

/*
 Performs ajax request to fetch whole conversation,
 takes chat message id and returns related conversation.
 */
function refreshConversation(cmId) {
    $.ajax({
        url: path_to_conversation_data,
        type: "POST",
        dataType: "json",
        data: {
            "cmId": cmId
        },
        async: true,
        success: function (data)
        {
            console.log('Refreshing Conversation...');

            _receiver.html(''); // Reset conversation content.

            for (index = 0; index < data.length; ++index) {

                const item = data[index];
                const isMine = item["isMine"];

                if(isMine)
                    drawSentMessage(item["content"], item["date"], false);
                else
                    drawReceivedMessage(item["content"], item["date"], false);
            }

            _receiver.animate({scrollTop: _receiver.prop("scrollHeight")}, 300);

            console.log('Refreshing Conversation Succeeded!'
                + data.length
                + ' data length received.');
        }
    })
}

/*
 * Performs ajax request to update all relevant chat messages to SEEN status.
 * Takes other user's id of the current conversation.
*/
function setSeenMessagesByUserAndReceiverId(otherUserId)
{
    $.ajax({
        url: path_to_set_seen_messages,
        type: "POST",
        dataType: "json",
        data: {
            "otherUserId": otherUserId
        },
        async: true,
        success: function (data)
        {
            refreshMessages();
        }
    })

}

function onSendNewMessage()
{
    // Websocket connection to chat server.
    var ws = new WebSocket('ws://' + g_ws_chat_url);

    var _textInput = document.getElementById("ws-chat-content");
    var content = _textInput.value;

    if(content === undefined || content === "")
        return;

    ws.onopen = () => ws.send(JSON.stringify({
        action: 'message',
        user: g_user_id,
        toUser: g_other_user_id,
        message: content,
    }));

    window.location = path_to_chat_list_messages;
}

(function () {
    'use strict';

    // Websocket connection to chat server.
    var ws = new WebSocket('ws://' + g_ws_chat_url);

    // Content and sending button input
    var _textInput = document.getElementById('ws-chat-content-to-send');
    var _textSender = document.getElementById('ws-chat-send-content');
    var enterKeyCode = 13;

    if(_textInput === undefined || _textInput === null)
        return;

    if(_textSender === undefined || _textSender === null)
        return;

    var sendTextInputContent = function () {
        // Get text input content
        var content = _textInput.value;

        if(content === undefined || content === "")
            return;

        // Emulate sender message.
        drawSentMessage(content, new Date().toLocaleString());
        updateCurrentRecentMessageTab(content);

        // Reset input
        _textInput.value = '';

        // Send it to WS
        ws.send(JSON.stringify({
            action: 'message',
            user: g_user_id,
            toUser: g_other_user_id,
            message: content,
        }));

        // Call ajax to refresh recent messages;
    };

    if(_textSender !== null)
        _textSender.onclick = sendTextInputContent;

    _textInput.onkeyup = function(e) {
        // Check for Enter key
        if (e.keyCode === enterKeyCode) {
            sendTextInputContent();
        }
    };

    // Append message to view.
    var addMessageToView = function(message, senderUsername) {

        const d = new Date();
        drawReceivedMessage(message, d.toLocaleString());
    };

    var botMessageToGeneral = function (message) {
        return addMessageToChannel(JSON.stringify({
            action: 'message',
            toUser: user_id, //Send to whom ?????
            message: message
        }));
    };

    ws.onopen = function () {
        ws.send(JSON.stringify({
            action: 'subscribe',
            user: g_user_id
        }));
    };

    /*
     * When receiving message from chat server
     * Checks whether to set message or seen or not,
     * depending on current conversation other user.
     */
    ws.onmessage = function (event) {
        const msg = JSON.parse(event.data).message;
        const senderUsername = JSON.parse(event.data).user;

        updateCurrentRecentMessageTab(msg);

        // update messages notifications
        if(g_other_user == senderUsername)
        {
            setSeenMessagesByUserAndReceiverId(senderUsername);
            drawReceivedMessage(msg, new Date().toLocaleString());
        }
        else
            refreshMessages();
    };

    ws.onclose = function () {
        console.info('[CHAT WS] Connection closed.');
    };

    ws.onerror = function () {
        console.error('[CHAT WS] An error occured!');
    };

})();