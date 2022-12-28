<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $index['siteName'] ?? 'Kurenai' }}</title>
    @include('head.stylesheets')
</head>
<body>
<div class="mascot"></div>
<div class="flex-wrapper">
<div class="box-vp box1"> 
{{-- <div class="box1-wrapper"> --}}
@include('global.warnings')
@include('global.navbar')
<img src="a.jpg" class="global-banner">  {{-- what if this was a featured image from the booru? --}} 
<div class="index-boards">Featured boards</div>
<div class="index-boardlist">
    @if(isset($index['boards']))
    @foreach($index['boards'] as $board)
    <a href="/boards/{{ $board['uri'] }}" class="index-board-hyperlink">$board['name']</a>
    @endforeach
    @else
    <a class="index-board-hyperlink">No boards featured</a>
    @endif
</div>  
<hr class="board-separator">
<div class="hot-threads-wrapper">
<div class="index-thread-intro">Hot threads</div>
<ul class="index-thread-ul"> {{-- this is where "hot" threads are supposed to be --}}
    @if(isset($index['threads']))
    @foreach($index['threads'] as $thread)
    <li><a href="/boards/{{ $thread['board'] }}/{{ $thread['id'] }}">{{ $thread['title'] }}.</a></li>
    @endforeach
    @else
    <li style="color: grey;">No threads yet. Only the silence.</li>
    @endif
</ul>
</div>

<table class="index-booru__table"> 
<tr><th class="index-booru-table__header">Booru</th></tr>
<tr><td class="index-booru-table__body"> 
{{-- 
  maybe dump the "featured img" thing and turn this into the list of all public boards 
--}}
  @if(isset($booru['featured_images']))
  @foreach($booru['featured_images'] as $image)
  <img class="index-booru-table__img" src="/images/{{ $image['uri'] }}">
  @endforeach
  @else
  <div style="margin: auto;">Poster images will appear here</div>
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
            @else
            <td class="news-title">No news yet.<td>
            <td class="news-date">(no date)<td>
            @endif
          </tr>
          </tbody>
        </table>
      </div>
  </div>
  <div class="featured-image-section"> 
      <div class="featured-image-text">Image of the now</div>
      <img class="featured-img" src="/images/admin/imageofnow.jpg" alt="ERROR: NO IMAGE AVAILABLE">
  </div>
</div>
</div>
@include('global.footer')
</body>
</html>
{{-- this section will be most likely partially or totally deleted 
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
--}}
