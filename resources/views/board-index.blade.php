<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $boardConfig['name'] }}</title>
</head>
<body style="margin:0;">
<div class="global-wrapper"> <!-- remember to apply body css pointer to here -->

<div class="board-header">
  <div class="board-name">/{{ $boardConfig['uri'] }}/ - {{ $boardConfig['name'] }}</div>
  <div class="board-description">{{ $boardConfig['description'] }}</div>
</div>

@if (Auth::check())
    <form class="thread-submit-form" method="post">
      <table class="make-thread-table">
        <tr>
          <td class="table-top"><input name="post-title" placeholder="Title"></input><button class="post-button">Post</button></td>
        </tr>
        <tr>
          <td><textarea name="post-body" class="form-body" placeholder="What's going on?"></textarea></td>
        </tr>
      </table> 
    </form>
@endif

foreach($threads as $thread)
<div class="thread-index-container">

<div class="thread-container">
  <div class="thread-bullets">•</div>
  <div class="thread-hiperlink">$thread['title']</div>
  <div class="thread-user">- $thread['userName']</div>
  <div data-unix-date="{{ $thread['unixDate'] }}" class="thread-date">{{ $thread['formatedDate'] }}</div>
  <div class="thread-reply-count">[$thread['replyCount']]</div>
  <div class="thread-reply-count">$thread['tags']</div>  {{-- locked, infinite, etc --}}
</div>
  foreach($thread['replies'] as $reply)
    <div class="thread-reply-container">
      <div class="thread-hiperlink reply-hiperlink">$reply['title']</div>
      <div class="thread-user">- $reply['userName']</div>
  </div>
  endforeach
endforeach

</div>

@include('global.footer')

</div>
</body>
</html>