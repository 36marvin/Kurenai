<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Management</title>
    @include('head.stylesheets')
</head>
<body class="body-flexbox-footer global__background-color">
    <div class="board-managament__index-container">
        <div class="board-managament__index-container__intro">Board Management For /{{ $boardConfig['board_uri'] }}/</div>
        <ul class="board-managament__index-container__body global-util__container-body-general">
            <li class="board-management__li"><a class="board-management__a" href="/board/{{ $boardConfig['board_uri'] }}/manage/dangerzone">Danger zone (delete, freeze, etc.)</a></li>
            <li class="board-management__li"><a class="board-management__a" href="#">Configure board</a></li>
            <li class="board-management__li"><a class="board-management__a" href="#">Manage board's staff</a></li>
            <li class="board-management__li"><a class="board-management__a" href="#">Manage bans</a></li>
        </ul>
    </div>
@include('global.footer')
</body>
</html>