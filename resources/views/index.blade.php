<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $index['siteName'] }}</title>
    <link rel="stylesheet" href="/static/css/style.css">
</head>
<body>

<div class="flex-wrapper">

<div class="box-vp box1"> 
<div class="box1-wrapper">
  <div class="wrapper-intro">
    <div class="site-title"><span class="retro">LARA</span><span class="board">BOARD<span></div>
    <div class="site-description">{{ $index['siteDescription'] }}</div>
  </div>
  <hr class="board-separator">
  <div class="boards">boards</div>
  <ul class="board-list">
    @foreach($publicBoards as $publicBoard)
        <li><a href="/{{ $publicBoard['uri'] }}">{{ $publicBoard['name'] }}</a></li> 
    @endforeach
  </ul> 
</div>
<div class="random-quote">"{{ $randomQuote['text'] }}"" — {{ $randomQuote['author'] }}</div>
</div>

<div class="box-vp box2">
<div class="box2-wrapper">
  <div class="hot-section">
    
    <div class="news-section">
      <div class="news-wrapper">
        <div class="news-intro">Breaking news</div>
        <table class="news-table"> 
          <tbody class="table-body-index">
            @foreach($news as $news)
            <tr> 
              <td class="news-title"><a href="{{ $news['link'] }}">{{ $news['text'] }}</a><td>
              <td class="news-date">{{ $news['time'] }}<td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="hottest-threads">
      <div class="hottest-threads-wrapper">
        <div class="hottest-threads-text">Hottest Threads</div>
        <table class="hot-threads-table">
          @foreach ($hottestThreads as $hotThread)
          <tr>
            <td class="hot-thread-index">{{ $hotThread['title'] }}</td>
          </tr>
          @endforeach
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

<!-- FAQ, RULES, ETC. -->
<div class="box-vp box3"> 

  <div class="youtube-section">
    <iframe src="{{ $index['youtube-featured-uri'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
  <div class="links-section">
    <div class="faq box3-item">
        <div class="box3-title">RULES</div>
        <div class="box3-description">Read them, you piece of shit.</div>
    </div>
    <div class="hottest-thread box3-item">
      <div class="box3-title">FAQ</div>
      <div class="box3-description">Questions you've never asked.</div>
    </div>
    <div class="rules box3-item"></div>
  </div>
</div>


</div>
</body>
</html>