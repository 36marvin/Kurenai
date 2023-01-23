<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    @include('head.stylesheets')
</head>
<body class="global__background-color body-flexbox-footer">
    <div class="create-board__container">
        @if(config('kurenai.userCreationRules.isOpen'))
        <div class="create-board__intro global__container_color-intro">New user</div>
        <form action="postmethods/newuser" method="post" class="create-board__form-element width-fit-content global-util__container-body-general">
        <table class="create-board__form-table">
            <tr>
                <td><label for="userName">username</label></td>
                <td><input autocomplete="off" type="text" name="userName" required id="boardName"></td>
            </tr>
            <tr>
                <td><label for="userPassword">password <span class="global__info-symbol" title="Must include letters & numbers, no less than 7 characters">ⓘ</span></label></td>
                <td><input pattern="/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{7,}$/g" autocomplete="off" type="userPassword" name="userPassword" required id="userPassword"></td>
            </tr>
        </table>
        <input type="submit" value="create user" class="create-boards__submit-btn">
        </form>
        @else
        <div class="create-board__intro global__container_color-intro">Oh no!</div>
        <div class="create-board__form-element width-fit-content global-util__container-body-general">User creation is closed. Come back later.</div>
        @endif
    </div>
@include('global.footer')
</body>
</html>