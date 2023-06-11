<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $op->post->title }}</title>
    @include('head.stylesheets')
</head>
<body class="body-flexbox-footer body-background-theme">
@include('global.navbar')
<div class="thread-index">
{{--
    Original post.
--}}

<div class="post-wrapper-flex thread-post" id="{{ $op->post->inBoardPseudoId }}">
  <div class="poster-id">
    <div class="poster-id-wrapper">
      <img src="/static/img/profile_pics/default.jpg {{-- add ternary operador: propic for user id exist ? use it : use default propic --}}" class="profile-picture">
      <div class="poster-name">{{ $op->user->name }}</div>
      <div class="poster-badge-mod">mod {{-- $op->user->name --}}</div>
    </div>
  </div>
  <div class="post-content">
    <div class="post-upper-data"> 
      <div class="post-title">{{ $op->post->title }}</div>
      <span class="post-date">{{ $op->post->createdAt }}</span>
      <a href="#{{ $op->post->inBoardPseudoId }}" class="post-id">#{{ $op->post->inBoardPseudoId }}</a>
    </div>
    <div class="post-body">
    {{ $op->post->body }}  
    </div>
    <div class="quote-data" style="display:none;">
      <!-- <hr class="post-hr"> -->
<?php /*      <div class="post-under-data">
        @foreach($quotes as $quote)
        <span class="post-quotes">{{-- $quote->pseudoId --}}</span>
        @endforeach
*/ ?>
      </div>
    </div>
  </div>

{{--
    Reply.
--}}
@if(isset($replies))
@foreach($replies->all() as $reply)
<div class="post-wrapper-flex thread-post">
  <div class="poster-id">
    <div class="poster-id-wrapper">
      <img src="/static/img/profile_pics/default.jpg" class="profile-picture">
      <div class="poster-name">{{ $reply->author --}}</div>
      <div class="poster-badge-mod">{{-- $reply->user->badge --}}</div>
    </div>
  </div>
  <div class="post-content">
    <div class="post-upper-data"> 
      @if($reply->title)
      <div class="post-title">{{ $reply->title }}</div>
      @endif
      <span class="post-date">{{ $reply->createdAt }}</span>
      <a href="#{{$reply->inBoardPseudoId }}" class="post-id">#{{ $reply->inBoardPseudoId }}</a>
    </div>
    <?php /* 
    <div class="post-data">
         <span class="post-date">{{-- $reply->post->date --}}</span> RIP
         </div> 
    --}} 
    */ ?>
    <div class="post-body">
    {{ $reply->body }}  
    </div>
    <div class="quote-data" style="display:none;">
      <!-- <hr class="post-hr"> -->
      <div class="post-under-data">
        <?php /*
        @foreach($quotes as $quote)
        <span class="post-quotes">{{-- $quote->pseudoId --}}</span>
        @endforeach
        */ ?>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif

{{-- 
    Reply maker.
--}}
@if(Auth::check())
<div class="create-board__container replymaker-container">
    <!-- <div class="create-board__intro global__container_color-intro">reply maker</div> -->
    <form action="/forms/makereply" method="post" class="replyMaker">
        @csrf
        <input type="hidden" value="{{ $op->post->id }}" name="threadId" required>
        <div class="replymaker__upper-data"> {{-- flex row these two --}}
          <input type="text" name="replyTitle" class="makeReplyTitle text-input-default" placeholder="Title" autocomplete="off">
          <input type="submit" value="reply" class="replymaker__btn">
        </div>
        <textarea name="replyBody" cols="30" rows="10" class="replyBody text-input-default" placeholder="Speak your mind" required></textarea>
    </form>
</div>
@endif
</div>

{{--
    Thread pages.  
--}}
<!-- to develop -->

</div>
@include('global.footer')
</body>