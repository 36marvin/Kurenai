<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $index['siteName'] ?? 'Retroboard' }}</title>
    <link rel="stylesheet" href="/static/css/style.css">
</head>
<body>

<div class="flex-wrapper">

<div class="box-vp box1"> 
<div class="box1-wrapper">
  <div class="wrapper-intro">
    <div class="site-description">{{ $index['siteDescription'] ?? 'Be welcome!' }}</div>
  </div>
  <hr class="board-separator">
  <div class="boards">boards</div>
  <ul class="board-list">
    @if($publicBoards)    
      @foreach($publicBoards as $publicBoard)
          <li><a href="/{{ $publicBoard['uri'] }}">{{ $publicBoard['name'] }}</a></li> 
      @endforeach
    @endif
  </ul> 
</div>
<div class="random-quote">"{{ $randomQuote['text'] ?? 'He who has a why can bear almost any how' }}</div>
</div>

<div class="box-vp box2">
<div class="box2-wrapper">
  <div class="hot-section">
    
    <div class="news-section">
      <div class="news-wrapper">
        <div class="news-intro">Breaking news</div>
        <table class="news-table"> 
          <tbody class="table-body-index">
            @if($news)
              @foreach($news as $news)
              <tr> 
                <td class="news-title"><a href="{{ $news['link'] }}">{{ $news['text'] }}</a><td>
                <td class="news-date">{{ $news['time'] }}<td>
              </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="hottest-threads">
      <div class="hottest-threads-wrapper">
        <div class="hottest-threads-text">Hottest Threads</div>
        <table class="hot-threads-table">
          @if($hottestThreads)
            @foreach ($hottestThreads as $hotThread)
            <tr>
              <td class="hot-thread-index">{{ $hotThread['title'] }}</td>
            </tr>
            @endforeach
          @endif
        </table>
      </div>
    </div>
  </div>
  <div class="featured-image-section"> 
      <div class="featured-image-text">Featured image</div>
      <img class="featured-img" src="/static/images/featured/featured.jpg">
  </div>
</div>
</div>


</div> 
</body>
</html>