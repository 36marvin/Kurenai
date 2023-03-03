<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    @include('head.stylesheets')
</head>
<body class="global__background-color body-flexbox-footer body-background-theme">
    <div class="create-board__container">
        @if(config('kurenai.userCreationRules.isOpen'))
        <div class="create-board__intro global__container_color-intro">Sign up</div>
        <form action="/forms/signup/" method="post" class="create-board__form-element width-fit-content global-util__container-body-general">
            <div class="user-auth-containter">
                <label class="user-auth-label">username</label>
                <input type="text" name="name" required autocomplete="off" class="user-auth-input">
            </div>
            <div class="user-auth-containter">
                <label class="user-auth-label">password</label>
                <input type="password" name="password" required autocomplete="off" class="user-auth-input">
            </div>
            <div class="user-auth-containter">
                <label class="user-auth-label">email (optional)</label>
                <input type="email" name="email" class="user-auth-input">
            </div>
            @csrf
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