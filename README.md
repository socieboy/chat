# Laravel Chat

Laravel Chat is a package to make on your own app a chat with multi users and private conversations.

This package use redis and socket.io to better performance.


## Installation

## Required

Install redis on your server.

## Download and Installation
Download laravel chat package to your project
```
composer require "socieboy/chat": "dev-master"
```
Then execute the command
```
Composer update
```

# Migrations
Now execute the command.
```
php artisan chat:tables
```
Then run
```
php artisan migrate
```

# Styles and Scripts
Set up on your master view page the fallow code.
On the meta tags area between the \<head>\</head> tags.

```
<meta name="token" id="token" value="{{ csrf_token() }}">
```
Also you have to add the style scripts.
```
<link rel="stylesheet" href="{{ url('css/chat.css') }}"/>
```
Same thing with the JS files required, make sure to place them in end before to close the \<body>\<\body> tag.
```
<script src="{{ asset('js/socket.io.js') }}"></script>
<script src="{{ url('js/chat.js') }}"></script>
```



