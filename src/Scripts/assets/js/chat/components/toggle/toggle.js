module.exports = {

    template: require('./toggle.template.html'),

    props: ['change-visible-status'],

    data: function() {
        return {
            isVisible: false
        };
    },

    ready: function(){
        $( "#slidebar" ).toggle();
    },

    methods:{
        changeToggleStatus: function(){
            $( "#slidebar" ).toggle();
            this.isVisible = ! this.isVisible;
            this.changeVisibleStatus(this.isVisible);
        },

        closeConversation: function(conversation) {
            this.closeConversation(conversation);
        }
    }

};