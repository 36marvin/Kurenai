<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $errorMessage['header'] }}</title>
    @include('head.stylesheets')
</head>
<body class="body-flexbox-footer body-background-theme">
    <div class="board-managament__index-container">
        <div class="board-managament__index-container__intro">{{ $errorMessage['header']}}</div>
        <div class="board-managament__index-container__body global-util__container-body-general">
            @if($errorMessage['header'] === '404 NOT FOUND')
            <img src="/static/img/404/default.gif" alt="Error: even the 404-not-found image was not found" class="error-page__img">
            @endif
            <div>{{$errorMessage['description']}}</div>
        </div>
    </div>
@include('global.footer')
</body>