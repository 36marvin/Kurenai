<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    @include('head.stylesheets')
</head>
<body class="global__background-color body-flexbox-footer">
    <div class="create-board__container">
        <div class="create-board__intro global__container_color-intro">Log in</div>
        <form action="postmethods/login" method="post" class="create-board__form-element width-fit-content global-util__container-body-general">
        <table class="create-board__form-table">
            <tr>
                <td><label for="userName">username</label></td>
                <td><input autocomplete="on" type="text" name="userName" required id="userName"></td>
            </tr>
            <tr>
                <td><label for="userPassword">password</label></td>
                <td><input autocomplete="off" type="password" name="userPassword" required id="userPassword"></td>
            </tr>
        </table>
        <input type="submit" value="log in" class="create-boards__submit-btn">
        </form>
    </div>
@include('global.footer')
</body>
</html>