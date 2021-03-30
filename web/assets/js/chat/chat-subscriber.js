/**
 * Created by SaadAchraf on 3/23/2019.
 */

/*
 description:
    This js is used to subscribe to chat server using websocket,
    and for getting updated with new messages relevant to current logged in user.

 importor:
    app/Resources/views/base.

 globals:
    g_ws_chat_url: true // from: app/Resources/views/base.
    user_id: true // app/Resources/views/base.
 */

if(typeof g_user_id !== 'undefined')
    chatSubscribe();

function chatSubscribe() {

    // Websocket connection to chat server.
    const ws = new WebSocket('ws://' + g_ws_chat_url);

    'use strict'; // won't declare variables with const/let, only var.

    ws.onopen = function () {

        // Always try to subscribe with new connection resourceId (duplication is handled by server).
        ws.send(JSON.stringify({
            action: 'subscribe',
            user: g_user_id
        }));
    };

    ws.onmessage = function (event) {

        // Refresh when we get a new chat message (
        // only works when not in /chat route,
        // as it is overwritten by onmessage implementation in chat.js)

        refreshMessages();
        console.log('[CHAT WS] Got new message!, data description: \n' + event.data);
    };

    ws.onclose = function () {
        console.log('[CHAT WS] Connection closed.');
    };

    ws.onerror = function () {
        console.log('[CHAT WS] An error occured!');
    };

}