<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board List</title>
    @include('head.stylesheets')
</head>
<body class="global__background-color body-flexbox-footer body-background-theme">
@include('global.navbar')
<div class="create-board__container boardlist-container">
        <div class="create-board__intro global__container_color-intro">Board list</div>
        <div class="create-board__form-element width-fit-content global-util__container-body-general">
        <table class="generic-table-one">
            <tr class="generic-table-one__tr">
                <th>Name</th>
                <th class="boardlist-description-th">Description</th>
                <th class="hover-info" title="Posts per day (in the last week).">ppd</th>
                <th class="hover-info" title="Posts per week (in the last three weeks).">ppw</th>
            {{--@if(Auth::isGlobalStaffer)
                <th class="extra-horizontal-padding-table">Is Secret</th>
                @endif
            --}}
            </tr>
            @foreach($boardListArray['data'] as $board)
            @if($board['is_secret'] /* && !isGlobalStaffer() */)
                @continue
            @endif
            <tr class="generic-table-one__tr">
                <td class="boardlist-name">
                    <a class="default-hyperlink wordbreak-breakall {{$board['is_frozen'] ? 'strikethrough' : ''}}" }} href="/board/{{ $board['board_uri'] }}">{{ $board['board_name'] }}</a>
                </td>
                <td class="boardlist-description">{{ $board['board_description'] }}</td>
                <td>n/a</td>
                <td>n/a</td>
            {{--@if(Auth::isGlobalStaffer)
                <td>@if($board['is_secret'])
                        yes
                    @else <!-- ternay operator is not working due to a Blade bug -->
                        no
                    @endif
                </td>
                @endif
            --}}
            </tr>
            @endforeach
            </table>
            <div class="boardlist__pages">
            <span>pages:</span>
            <ul class="boardlist__li">
            @for($i = 1; $i < $boardListArray['last_page']; $i = 0)
            <li><a href='?page={{$i}}'>{{$i}}</a></li>
            @endfor
            </ul>
            </div>
        </div>
        <div class="global-util__info-box create-board__form-element">
            <p>Total boards: {{ $boardListArray['total'] }} ({{ $boardCounts['nonSecretBoards']}} public, {{ $boardCounts['secretBoards'] }} secret).</p>
            <p>You will not be able to see secret boards unless you are a global staffer.</p>
        </div>
    </div>
</body>
</html>
{{-- 
Truth table for whether a board should appear or not.
Keep in mind that the "is secret" column will always show
if the client is a global staffer.

!secret staffer - display
!secret !staffer - display
secret staffer - display
secret !staffer - not display
--}}