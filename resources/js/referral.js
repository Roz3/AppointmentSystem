import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

const echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

echo.channel('appointment-system')
    .listen('ReferralApproved', (event) => {
        console.log(event.referral);
        // handle the event data
    });
