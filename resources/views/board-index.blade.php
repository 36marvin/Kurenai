<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

<div class="thread-index-container">

<div class="thread-container">
  <div class="thread-bullets">•</div>
  <div class="thread-hiperlink">Sou uma thread!</div>
  <div class="thread-user">- Marvin</div>
  <div class="thread-date">2 days ago</div>
  <div class="thread-reply-count">[2]</div>
  <div class="thread-reply-count">🔒 ♻️</div>
</div>


<div class="thread-reply-container">
  <div class="thread-bullets">•</div> <!-- FFS, maybe this should be an <i>??? -->
  <div class="thread-hiperlink reply-hiperlink">Que legal, OP. Parabéns por fazer essa thread.</div>
  <div class="thread-user">- Lucas</div>
</div>

</div>

<footer class="the-footer">· A texboard running on Retroboard ·</footer>

</div>
</body>
</html>