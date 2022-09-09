<div class="post-wrapper-flex">
  <div class="poster-id">
    <div class="poster-id-wrapper">
      <div class="poster-name">{{ $post['userName'] }}</div>
      <div class="poster-badge-mod">$user['badge']</div>
    </div>
  </div>
  <div class="post-content">
    <div class="post-upper-data"> 
      <div class="post-title">{{ $post['title'] }}</div><div class="post-id">$post['id']</div>
    </div>
    <div class="post-data">
      <span class="post-date">{{ $post['date'] }}</span>
    </div>
    <div class="post-body">
      {{ $post['body'] }}
    </div>
    <div class="post-under-data">
        @foreach($quotingposts as $quote) <!-- posts that are quoting this post -->
          <a class="post-quotes" href="/$post['board']/$post['thread'].html#$quote['id'] ">{{ $quote['id'] }}</a> <!-- Only the ids. Also, this <a> is going to glitch. Fix later. -->
        @endforeach
    </div>
  </div>
</div>