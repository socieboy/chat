module.exports = {

    template: require('./conversation.template.html'),

    props: ['conversation', 'close-conversation'],

    data: function() {
        return {
            collapseBox: false,

            messages: [],

            newMessage: {
                id: '',
                message: '',
                to_user_id: '',
                from_user_id: ''
            }

        };
    },

    ready: function(){
        this.io = require('socket.io-client'); // I need to make this work globally
        this.socket = io('http://localhost:6001') // I need to make this work globally

        this.authId = document.querySelector('#auth').getAttribute('value') // I need to make this work globally

        this.newMessage.to_user_id = this.conversation.id;
        this.newMessage.from_user_id = this.authId;

        this.listenForMessages()
        this.loadMessages();
    },

    components: {
        message: require('../messages/message')
    },

    methods: {

        loadMessages: function(){
            this.$http.post('api/chat/messages', {'to_user_id': this.conversation.id, 'from_user_id': this.authId }, function(data){
                data.forEach(function(message){
                    this.pushMessage(message);
                }.bind(this));
            }.bind(this));
            this.scrollDown();
        },

        pushMessage: function(message)
        {
            this.messages.push({
                'id': message.id,
                'message': message.message,
                'from_user_id': message.from_user_id,
                'to_user_id': message.to_user_id
            });
        },

        resizeTextArea: function(){
            this.$$.textArea.style.height = '1px';
            this.$$.textArea.style.height = (this.$$.textArea.scrollHeight + 6) + 'px';
        },

        closeConversation: function(conversation) {
            this.closeConversation(conversation);
            //this.socket.removeAllListeners("conversation-" + this.authId + ":Socieboy\\Chat\\Events\\ReadMessage");
        },

        collapseConversation: function(){
            this.collapseBox = ! this.collapseBox;
        },

        sendMessage: function() {
            this.$http.post('api/chat/messages/store', this.newMessage);
            this.pushMessage(this.newMessage);
            this.newMessage.message = '';
            this.scrollDown();
        },

        listenForMessages:function(){
            this.socket.on("conversation-" + this.authId + ":Socieboy\\Chat\\Events\\ReadMessage", function(data){
                this.pushMessage(data.message);
                this.scrollDown();
            }.bind(this));
        },

        scrollDown:function(){
            $('.c-container .body').animate({ scrollTop: $('.c-container .body')[0].scrollHeight }, 2000);
        }
    }
};