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
        <div class="create-board__intro global__container_color-intro">Board maker</div>
        <form action="postmethods/createboard" method="post" class="create-board__form-element width-fit-content">
        <table class="create-board__form-table">
            <tr>
                <td><label for="boardName">Board name</label></td>
                <td><input autocomplete="off" type="text" name="boardName" id="boardName"></td>
            </tr>
            <tr>
                <td><label for="uri">Board uri <span class="astheristik">*</span></label></td>
                <td><input autocomplete="off" type="text" name="boardUri" id="boardUri"></td>
            </tr>
            <tr>
                <td><label for="isSecret">Is a secret board <span class="astheristik">**</span></label></td>
                <td><input type="checkbox" name="isSecret" id="isSecret"></td>
            </tr>
            <tr>
                <td><label for="boardDescription">Board description</label></td>
                <td><input autocomplete="off" type="text" name="boardDescription" id="boardDescription"></td>
            </tr>
        </table>
        <input type="submit" value="create board" class="create-boards__submit-btn">
        </form>
    </div>
    <div class="create-board__explanation-box width-fit-content">
            <span class="astheristik">*</span> The plain-text "id" 
            through which users will access your board (e.g. vip for /vip/).
            <br><br>
            <span class="astheristik">**</span> The board will only 
            be visible for the website's <b>global</b> staffers on
            the board list. Anyone else cannot see it there, but
            they can still visit the board if they have the link.
    </div>
@include('global.footer')
</body>
</html>