/**
 * Created by SaadAchraf on 3/23/2019.
 */
const notifEl = document.querySelector('.notification');

var currNotifsCount = 0;

if(notifEl) {
    document.querySelector('.notification').addEventListener('click',
        refreshNotifications(),
        true);
}

function refreshNotifications() {
    setNotificationsCount(0);
    setMyNotificationsToSeen();
}

function setNotificationsCount(newCount = 4) {
    var notifEl = document.querySelector('.notification');

    if(notifEl) {
        if (newCount !== 0) {
            notifEl.setAttribute('notification-data-count', newCount);
            notifEl.classList.add('notification-notify');
            notifEl.classList.add('notification-show-count');
        }

        if(newCount === 0)
        {
            notifEl.classList.remove('notification-notify');
            notifEl.classList.remove('notification-show-count');
            notifEl.classList.remove('notification-show-count');
        }

    }

    currNotifsCount = newCount;
}

function incrementNotificationCount()
{
    setNotificationsCount(currNotifsCount + 1);
}

function setMyNotificationsToSeen()
{
    if(typeof path_to_set_seen_notifs === 'undefined')
        return;

    $.ajax({
        url: path_to_set_seen_notifs,
        type: "POST",
        dataType: "json",
        async: true,
        success: function (data)
        {
            setNotificationsCount(0);
            console.log('Setting notifications to seen successful.');
        }
    })
}