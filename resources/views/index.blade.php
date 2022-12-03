<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $index['siteName'] ?? 'Retroboard' }}</title>
    @if(isset($preferred_stylesheet))
    <link rel="stylesheet" href="/static/styles/{{ $preferred_stylesheet['uri'] }}.css">
    @else
    <link rel="stylesheet" href="/static/styles/powerful_retro.css">
    @endif
</head>
<body>
<div class="mascot"></div>
<div class="flex-wrapper">
<div class="box-vp box1"> 
{{-- <div class="box1-wrapper"> --}}
<table class="global-navbar">
<tr>
  <td class="global-navbar__intro global-navbar__td global-navbar__sitename">
    <div class="site-title"><span class="lara">LARA</span><span class="board">BOARD<span></div>
  </td>
  <td class="useful-pages global-navbar__td">
  <div class="global-user-ops__wrapper">
    <div class="global-user-ops">LOGIN</div>
    <div class="global-user-ops">SIGN UP</div>
  </div>
  </td>
</tr>
</table>

<img src="a.jpg" class="global-banner">  {{-- what if this was a featured image from the booru? --}} 
<div class="index-boards">Main boards</div>
<div class="index-boardlist">
    @if(isset($index['boards']))
    @foreach($index['boards'] as $board)
    <a href="/boards/{{ $board['uri'] }}" class="index-board-hyperlink">$board['name']</a>
    @endforeach
    @endif {{-- todo: if no boards, display: "no boards yet" --}}
</div>  
<hr class="board-separator">
<div class="index-thread-intro">Threads</div>
<ul class="index-thread-ul"> {{-- this is where "hot" threads are supposed to be --}}
    @if(isset($index['threads']))
    @foreach($index['threads'] as $thread)
    <li><a href="/boards/{{ $thread['board'] }}/{{ $thread['id'] }}">{{ $thread['title'] }}.</a></li>
    @endforeach
    @endif {{-- todo: no featured threads, display: "nothing to see here yet" --}}
</ul> 

<table class="index-booru__table"> 
<tr><th class="index-booru-table__header">Booru</th></tr>
<tr><td class="index-booru-table__body">
  @if(isset($booru['featured_images']))
  @foreach($booru['featured_images'] as $image)
  <img class="index-booru-table__img" src="/images/{{ $image['uri'] }}">
  @endforeach
  @endif
</td></tr>
</table>
@if(isset($random_quote))
<div class="random-quote">{{ array_rand($random_quote) }}</div>
@endif
</div>

<div class="box-vp box2">
<div class="box2-wrapper">
  <div class="hot-section">
    <div class="index-news-section">
      <div class="index-news-section__wrapper">
        <div class="index-news-section__intro">Latest news</div>
        <table class="news-table"> 
          <tbody class="deadclass">
          <tr> 
            @if(isset($news))
            @foreach($news as $news)
            <td class="news-title"><a href="/news/{{ $news['uri'] }}">{{ $news['title']}}</a><td>
            <td class="news-date" data-news-date="$news['date_unix_time']" {{-- for javascripts relative time conversion --}}>{{ $news['date_human_readable'] }}<td>
            @endforeach
            @endif
          </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="hottest-threads">
      <div class="hottest-threads-wrapper">
        <div class="hottest-threads-text">Hottest Threads</div>
        <table class="hot-threads-table">
          <tr>
            <td class="hot-thread-index">I created this thread and now it's full of replies</td> {{-- we dont need this anymore --}}
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="featured-image-section"> 
      <div class="featured-image-text">Image of the now</div>
      <img class="featured-img" src="/images/admin/imageofnow.jpg" alt="/images/admin/imageofnow.default.jpg">
  </div>
</div>
</div>

{{-- this section will be most likely partially or totally deleted --}}
<div class="box-vp box3"> 

  <div class="index-youtube">
    <iframe src="https://www.youtube.com/embed/{{$youtube_vid['id'] ?? 'blpe_sGnnP4' }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
  <div class="links-section">
    <div class="faq box3-item">
        <div class="box3-title">RULES</div>
        <div class="box3-description">You're supposed to read them.</div>
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