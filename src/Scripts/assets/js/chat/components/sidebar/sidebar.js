module.exports = {

    template: require('./sidebar.template.html'),

    data: function() {
        return {
            search: '',

            isVisible: false,

            conversations: []
        };
    },

    ready: function(){
        this.io = require('socket.io-client');
        this.socket = io('http://localhost:6001')

        this.authId = document.querySelector('#auth').getAttribute('value');

        this.loadUsers();
        this.listenWhenNewUsersWasLogin();
        this.listenWhenUserWasLoggedOut();
        this.listenToOpenConversation();

    },

    components: {
        user:           require('../user/user'),
        conversation:   require('../conversations/conversation'),
        toggle:         require('../toggle/toggle')
    },

    methods: {

        // Fetch online users
        loadUsers: function(){
            this.$http.get('api/chat/users/online', function(users){
                this.$set('users', users);
            }.bind(this));
        },

        // Start a new conversation on box.
        startConversation: function(user){
            var exists = this.conversations.some(function (conv) {
                return conv.id == user.id
            })

            if(! exists) this.conversations.push(user);
        },

        // Close the conversation box.
        closeConversation: function(conversation){
            this.conversations.$remove(conversation);
        },

        // Listen when some user has been logged to the system.
        listenWhenNewUsersWasLogin: function(){
            this.socket.on("chat:Socieboy\\Chat\\Events\\NewUserWasLogin", function(data){
                this.users.push(data.user);
            }.bind(this));
        },

        // When some user has logged off.
        listenWhenUserWasLoggedOut: function(){
            this.socket.on("chat:Socieboy\\Chat\\Events\\UserWasLoggedOut", function(data){
                this.users.forEach(function(user){
                    if(user.id == data.user.id) this.users.$remove(user);
                }.bind(this));
            }.bind(this));
        },

        listenToOpenConversation:function(){
            this.socket.on("user-" + this.authId + ":Socieboy\\Chat\\Events\\UserMessage", function(data){

                var isOpen = this.conversations.some(function (conv) {
                    return conv.id == data.user.id
                })

                if( ! isOpen ) this.startConversation(data.user);

            }.bind(this));
        },

        // Change the status of the sidebar
        changeVisibleStatus: function(status){
            this.isVisible = status;
        }

    }

};