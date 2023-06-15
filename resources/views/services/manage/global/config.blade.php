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
@include('global.navbar')
    <div class="create-board__container">
        <div class="create-board__intro global__container_color-intro">General forum config</div>
        <form action="/forms/globalManage/setGeneralConfig/" method="post" class="create-board__form-element width-fit-content global-util__container-body-general">
        @csrf
        <table class="create-board__form-table">
            <tr>
                <td><label for="userName">Forum name</label></td>
                <td><input autocomplete="off" value="{{ $configManager->getConfig()->forumName }}" type="text" name="forumName" required id="forumName"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Forum description</label></td>
                <td><input autocomplete="off" type="userPassword" value="{{ $configManager->getConfig()->forumDescription }}" name="forumDescription" required id="forumDescription"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Is open</label></td>
                <td><input autocomplete="off" type="checkbox" {{ $configManager->getConfig()->isOpen ? 'checked' : '' }} name="forumIsOpen" id="forumIsOpen"></td>
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
        <input type="submit" value="save" class="create-boards__submit-btn">
        </form>
    </div>

    <div class="create-board__container">
        <div class="create-board__intro global__container_color-intro">Global post configuration</div>
        <form action="/forms/globalManage/setPostConfig/" method="post" class="create-board__form-element width-fit-content global-util__container-body-general">
        @csrf
        <table class="create-board__form-table">
            <tr>
                <td><label for="userName">Minimum user age for thread creation</label></td>
                <td><input autocomplete="off" placeholder="e.g. +5 hours, +7 days, +1 month" type="text" value="{{ $configManager->getConfig()->postConfig->allowThreadCreationForNewUsers }}" name="minUserAgeForThreadCreation" required id="minUserAgeForThreadCreation"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Rate limit for replies</label></td>
                <td><input autocomplete="off" value="{{ $configManager->getConfig()->postConfig->rateLimit->replies }}" type="text" name="rateLimitForReplyCreation" required id="rateLimitForReplyCreation"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Rate limit for threads</label></td>
                <td><input autocomplete="off" type="text" value="{{ $configManager->getConfig()->postConfig->rateLimit->threads }}" name="rateLimitForThreadCreation" required id="rateLimitForThreadCreation"></td>
            </tr>
            <tr style="height: 1em;">{{-- TODO: fix this ugly thing --}}
                <td></td>
                <td></td>
            </tr> 
            <tr>
                <td>Accepted file formats:</td>
                <td></td>
            </tr>
            @foreach($configManager->getConfig()->postConfig->allowedMedia as $key => $media)
            <tr>
                <td><label for="{{ $key }}">{{ $key }}</label></td>
                <td><input autocomplete="off" type="checkbox" value="true" {{ $media ? 'checked' : '' }} name="{{ $key }}" id="{{ $key }}"></td>
            </tr>
            @endforeach
        </table>
        <input type="submit" value="save" class="create-boards__submit-btn">
        </form>
    </div>

    <div class="create-board__container">
        <div class="create-board__intro global__container_color-intro">Global board configuration</div>
        <form action="/forms/globalManage/setBoardConfig/" method="post" class="create-board__form-element width-fit-content global-util__container-body-general">
        @csrf
        <table class="create-board__form-table">
            <tr>
                <td><label for="userName">Maximum number of replies to thread at board index</label></td>
                <td><input autocomplete="off" value="{{ $configManager->getConfig()->boardConfig->boardIndexMaxRepliesPerThread }}" type="number" value="{{ config('kurenai.siteName') }}" name="boardIndexMaxRepliesPerThread" required id="siteName"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Allow users to create boards</label></td>
                <td><input autocomplete="off" type="checkbox" {{ $configManager->getConfig()->boardConfig->allowBoardCreation->isEnabled ? 'checked' : '' }} name="allowUsersToCreateBoards" id="allowUsersToCreateBoards"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Minimum age for users to create board</label></td>
                <td><input autocomplete="off" patternOff="/\+(?:\d+)\s(?:hours|day|week|month|year)/g" type="text" value="{{ $configManager->getConfig()->boardConfig->allowBoardCreation->newUsersHaveToWait }}" name="minUserAgeForCreatingBoard" required id="minUserAgeForCreatingBoard"></td>
            </tr>
            <tr>
                <td><label for="userPassword">Rate limit for board creation</label></td>
                <td><input autocomplete="off" type="text" value="{{ $configManager->getConfig()->boardConfig->allowBoardCreation->rateLimit }}" name="rateLimitBoardCreation" required id="rateLimitBoardCreation"></td>
            </tr>
        </table>
        <input type="submit" value="save" class="create-boards__submit-btn">
        </form>
    </div>

    <div class="create-board__container">
        <div class="create-board__intro global__container_color-intro">Infrastructure info:</div>
        <div class="create-board__form-element width-fit-content global-util__container-body-general">
            An instance of Kurenai running on Laravel {{Illuminate\Foundation\Application::VERSION}} and PHP {{ PHP_VERSION }}.
        </div>
    </div>

@include('global.footer')