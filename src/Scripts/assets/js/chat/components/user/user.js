module.exports = {

    template: require('./user.template.html'),

    props: ['user'],

    data: function(){
        return {
            user: this.user
        }
    }

};