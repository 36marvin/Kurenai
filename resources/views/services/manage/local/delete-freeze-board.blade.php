<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danger Zone</title>
    @include('head.stylesheets')
</head>
<body class="body-flexbox-footer global__background-color">
    <div class="board-managament__index-container">
        <div class="board-managament__index-container__intro">Delete Board /{{ $boardConfig['board_uri'] }}/</div>
        <div class="board-managament__index-container__body global-util__container-body-general">
        <div>Delete this entire board forever (irreversible).</div>
            <form action="/forms/deleteboard/{{ $boardConfig['board_uri'] }}" method="post">
                <input type="submit" value="Delete this board" class="create-boards__submit-btn">
            </form>
        </div>
    </div>
    @if($boardConfig['is_frozen'] == false)
    <div class="board-managament__index-container">
        <div class="board-managament__index-container__intro">Freeze Board /{{ $boardConfig['board_uri'] }}/</div>
        <div class="board-managament__index-container__body global-util__container-body-general">
        <div>If you freeze this board, only its local staffers (along with any global staffers) will be able to post on it. Normal users will not be able to post or delete their posts.</div>
            <form action="forms/deleteboard" method="post">
                <input type="submit" value="Freeze this board" class="create-boards__submit-btn">
            </form>
        </div>
    </div>
    @else
    <div class="board-managament__index-container">
        <div class="board-managament__index-container__intro">Unfreeze Board /{{ $boardConfig['board_uri'] }}/</div>
        <div class="board-managament__index-container__body global-util__container-body-general">
        <div>If you unfreeze this board, every user on this website will be able to post on it.</div>
            <form action="postmethods/unfreezeBoard" method="post">
                <input type="submit" value="Unfreeze this board" class="create-boards__submit-btn">
            </form>
        </div>
    </div>
    @endif
    @if($boardConfig['is_secret'] == false)
    <div class="board-managament__index-container">
        <div class="board-managament__index-container__intro">Make Board /{{ $boardConfig['board_uri'] }}/ Secret</div>
        <div class="board-managament__index-container__body global-util__container-body-general">
        <div>If you make this board secret, only users who have the link will be able to access it. The board will only be visible on the website's board list (any of them) for global staffers, but not for everyone else.</div>
            <form action="postmethods/deleteboard" method="post">
                <input type="submit" value="Freeze this board" class="create-boards__submit-btn">
            </form>
        </div>
    </div>
    @else
    <div class="board-managament__index-container">
        <div class="board-managament__index-container__intro">Make Board /{{ $boardConfig['board_uri'] }}/ Not Secret</div>
        <div class="board-managament__index-container__body global-util__container-body-general">
        <div>If you make this board not secret, it will be publicly visible for anyone to see on the website's board lists.</div>
            <form action="postmethods/deleteboard" method="post">
                <input type="submit" value="Freeze this board" class="create-boards__submit-btn">
            </form>
        </div>
    </div>
    @endif
@include('global.footer')
</body>
</html>