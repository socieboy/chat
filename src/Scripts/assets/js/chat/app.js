var Vue = require('vue');

Vue.use( require('vue-resource') );

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

new Vue({

    el: '#socieboy',

    data: {
        viewChat: 'sidebar'
    },

    ready: function(){
        this.authId = document.querySelector('#auth').getAttribute('value');
    },

    components: {
        'sidebar': require('./components/sidebar/sidebar')
    },

    filters: {
        firstName: require('./filters/firstName'),
        avatar: require('./filters/avatar')
    }
})