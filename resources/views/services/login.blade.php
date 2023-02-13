<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    @include('head.stylesheets')
</head>
<body class="global__background-color body-flexbox-footer body-background-theme">
    <div class="create-board__container">
        <div class="create-board__intro global__container_color-intro">Log in</div>
        <form action="postmethods/login" method="post" class="create-board__form-element width-fit-content global-util__container-body-general">
            <div class="user-auth-containter">
                <label class="user-auth-label">username</label>
                <input type="text" class="user-auth-input">
            </div>
            <div class="user-auth-containter">
                <label class="user-auth-label">password</label>
                <input type="password" class="user-auth-input">
            </div>
            @csrf
        <input type="submit" value="log in" class="create-boards__submit-btn">
        </form>
    </div>
@include('global.footer')
</body>
</html>