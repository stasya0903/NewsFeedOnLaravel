window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

/*import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
Pusher.logToConsole = true;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: false
});*/

import Echo from "laravel-echo";

window.Pusher = require('pusher-js');
Pusher.logToConsole = true;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '21309cdba558c65591e5',
    cluster: 'eu',
    forceTLS: true
});
/*window.Echo.channel("workers-progress").listen(".job-number-updated", e => {
    console.log('finally');
    /!*const result = await fetch(args.api);
    const data = await result.json();
    /!*this.$store.commit("ADD_TODO", e.task);
    this.newTodo.title = "";*!/!*!/
});*/
/*let channel = Echo.channel('workers-progress');
channel.listen('.job-number-updated', function(data) {
    alert(JSON.stringify(data));
});*/
