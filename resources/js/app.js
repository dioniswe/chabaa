/** execute local file bootstrap.js which bootstraps many required libraries **/
require('./bootstrap');

import Echo from 'laravel-echo';
import Vue from 'vue';
import Vuex from 'vuex';
import FileManager from 'laravel-file-manager'
import videojs from 'video.js'
import 'videojs-hlsjs-progress-control'
window.videojs = videojs;

//Vue.use(videojs);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
//Vue.component('videojs', require('./components/VideoJS.vue').default);
Vue.use(Vuex);

const store = new Vuex.Store({});
Vue.use(FileManager, {store});

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});


// lang.js
import Lang from 'lang.js';

const default_locale = window.default_locale;
const fallback_locale = window.fallback_locale;
const messages =  window.messages;

Vue.prototype.trans = new Lang({
    messages,
    locale: default_locale,
    fallback: fallback_locale
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page.
 */
const app = new Vue({
    el: '#app',

    data: {
        messages: []
    },
    store: store,
    echo: window.Echo,
    methods: {
        addMessage(message) {
            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        },
        getMessages() {
            axios.get('/get-messages').then(response => {
                this.messages = response.data;
            });
        },
    },
});
