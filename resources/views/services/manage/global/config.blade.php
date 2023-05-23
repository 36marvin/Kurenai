<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configure the forum</title>
    @include('head.stylesheets')
</head>
<body class="global__background-color body-flexbox-footer body-background-theme">
    <div class="create-board__container">
        <div class="create-board__intro global__container_color-intro">General forum config</div>
        <form action="/forms/globalManage/setGeneralConfig/" method="post" class="create-board__form-element width-fit-content global-util__container-body-general">
        @csrf
        <table class="create-board__form-table">
            <tr>
                <td><label for="userName">Forum name</label></td>
                <td><input autocomplete="off" value="{{ config('kurenai.forumName') }}" type="text" value="{{ config('kurenai.siteName') }}" name="forumName" required id="forumName"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Forum description</label></td>
                <td><input autocomplete="off" type="userPassword" value="{{ config('kurenai.forumDescription') }}" name="forumDescription" required id="forumDescription"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Is open</label></td>
                <td><input autocomplete="off" type="checkbox" {{ config('kurenai.isOpen') ? 'checked' : '' }} name="forumIsOpen" required id="forumIsOpen"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Default theme</label></td>
                <td>
                    <select name="defaultTheme" id="defaultTheme">
                        @foreach(config('kurenai.themes') as $theme)
                        <option value="{{ $theme }}">{{ $theme }}</option>  
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" value="set general configuration" class="create-boards__submit-btn">
        </form>
    </div>

    <div class="create-board__container">
        <div class="create-board__intro global__container_color-intro">Global post configuration</div>
        <form action="/forms/globalManage/setPostConfig/" method="post" class="create-board__form-element width-fit-content global-util__container-body-general">
        @csrf
        <table class="create-board__form-table">
            <tr>
                <td><label for="userName">Minimum user age for thread creation</label></td>
                <td><input autocomplete="off" placeholder="e.g. +5 hours, +7 days, +1 month" type="text" value="{{ config('kurenai.postConfig.allowThreadCreationForNewUsers') }}" name="minUserAgeForThreadCreation" required id="minUserAgeForThreadCreation"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Rate limit for replies</label></td>
                <td><input autocomplete="off" value="{{ config('kurenai.postConfig.rateLimit.replies') }}" type="text" name="rateLimitForReplyCreation" required id="rateLimitForReplyCreation"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Rate limit for threads</label></td>
                <td><input autocomplete="off" type="text" value="{{ config('kurenai.postConfig.rateLimit.threads') }}" name="rateLimitForThreadCreation" required id="rateLimitForThreadCreation"></td>
            </tr>
            <tr style="height: 1em;">{{-- TODO: fix this ugly thing --}}
                <td></td>
                <td></td>
            </tr> 
            <tr>
                <td>Accepted file formats: (not working XD)</td>
                <td></td>
            </tr>
            @foreach(config('kurenai.postConfig.allowedMedia') as $key => $media)
            <tr>
                <td><label for="{{ $key }}">{{ $key }}</label></td>
                <td><input autocomplete="off" type="checkbox" value="true" {{ $media ? 'checked' : '' }} name="{{ $key }}" id="{{ $key }}"></td>
            </tr>
            @endforeach
        </table>
        <input type="submit" value="set global post configuration" class="create-boards__submit-btn">
        </form>
    </div>

    <div class="create-board__container">
        <div class="create-board__intro global__container_color-intro">Global board configuration</div>
        <form action="postmethods/global/manage/setboardconfig" method="post" class="create-board__form-element width-fit-content global-util__container-body-general">
        @csrf
        <table class="create-board__form-table">
            <tr>
                <td><label for="userName">Maximum number of replies to thread at board index</label></td>
                <td><input autocomplete="off" value="{{ config('kurenai.boardConfig.boardIndexMaxRepliesPerThread') }}" type="number" value="{{ config('kurenai.siteName') }}" name="boardIndexMaxRepliesPerThread" required id="siteName"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Allow users to create boards</label></td>
                <td><input autocomplete="off" type="checkbox" {{ config('kurenai.boardConfig.allowBoardCreation.isEnabled') ? 'checked' : '' }} name="allowUsersToCreateBoards" id="allowUsersToCreateBoards"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Minimum age for users to create board</label></td>
                <td><input autocomplete="off" pattern="/\+(?:\d+)\s(?:hours|day|week|month|year)/g" type="text" value="{{ config('kurenai.boardConfig.allowBoardCreation.newUsersHaveToWait') }}" name="minUserAgeForCreatingBoard" required id="minUserAgeForCreatingBoard"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Rate limit for board creation</label></td>
                <td><input autocomplete="off" type="text" value="{{ config('kurenai.boardConfig.allowBoardCreation.rateLimit') }}" name="rateLimitBoardCreation" required id="rateLimitBoardCreation"></td>
            </tr>
        </table>
        <input type="submit" value="set global board configuration" class="create-boards__submit-btn">
        </form>
    </div>

    <div class="create-board__container">
        <div class="create-board__intro global__container_color-intro">Infrastructure info:</div>
        <div class="create-board__form-element width-fit-content global-util__container-body-general">
            An instance of Kurenai running on Laravel version {{Illuminate\Foundation\Application::VERSION}} and PHP version {{ PHP_VERSION }}.
        </div>
    </div>

@include('global.footer')