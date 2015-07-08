module.exports = function(username){
    return (username.length > 10)?  username.substring(0, username.lastIndexOf(' ')) : username;
};
