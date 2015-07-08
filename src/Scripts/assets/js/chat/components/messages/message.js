module.exports = {

    template: require('./message.template.html'),

    props: ['conversation', 'message'],

    data: function() {

        return {
            conversation: this.conversation,

            message: this.message
        };
    },

    ready: function(){
        this.authId = document.querySelector('#auth').getAttribute('value') // I need to make this work globally
    }
};