<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Maker</title>
    @include('head.stylesheets')
</head>
<body class="global__background-color body-flexbox-footer">
    <div class="create-board__container">
        @if(config('kurenai.boardConfig.allowBoardCreation.isEnabled'))
        <div class="create-board__intro global__container_color-intro">Board maker</div>
        <form action="postmethods/createboard" method="post" class="create-board__form-element width-fit-content global-util__container-body-general">
        <table class="create-board__form-table">
            <tr>
                <td><label for="boardName">Board name</label></td>
                <td><input autocomplete="off" type="text" name="boardName" required id="boardName"></td>
            </tr>
            <tr>
                <td><label for="uri">Board uri <span class="global__info-symbol" title="The 'id' through which users will access your board (e.g. vip for /vip/). Cannot be changed in the future.">ⓘ</span></label></td>
                <td><input autocomplete="off" type="text" name="boardUri" required id="boardUri"></td>
            </tr>
            <tr>
                <td><label for="isSecret">Is secret <span class="global__info-symbol" title="The board will only be visible for the website's GLOBAL staffers on the board list. Anyone else cannot see it there, but they can still visit the board if they have the link.">ⓘ</span></label></td>
                <td><input type="checkbox" name="isSecret" id="isSecret"></td>
            </tr>
            <tr>
                <td><label for="boardDescription">Board description</label></td>
                <td><input autocomplete="off" type="text" name="boardDescription" required id="boardDescription"></td>
            </tr>
        </table>
        <input type="submit" value="create board" class="create-boards__submit-btn">
        </form>
        @else
        <div class="create-board__intro global__container_color-intro">Oh no!</div>
        <div class="create-board__form-element width-fit-content global-util__container-body-general">Board creation is currently closed.</div>
        @endif
    </div>
@include('global.footer')
</body>
</html>