// public/js/app.js
function updateNotifications() {
    $.get('/notifications', function(data) {
        var count = data.count;
        var notifications = data.notifications;

        // Update the notification icon with the number of unread notifications
        $('#notifications-count').text(count);

        // Display a list of notifications
        $('#notifications-menu .list-group').empty();
        notifications.forEach(function(notification) {
            var message = notification.data.message;
            var link = notification.data.link;
            var item = $('<a href="' + link + '" class="list-group-item">' + message + '</a>');
            $('#notifications-menu .list-group').append(item);
        });
    });
}

// Call the updateNotifications() function periodically
setInterval(updateNotifications, 5000);
