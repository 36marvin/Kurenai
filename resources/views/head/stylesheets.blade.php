@if(isset($preferred_stylesheet))
<link rel="stylesheet" href="/static/styles/{{ $preferred_stylesheet['uri'] }}.css">
@else
<link rel="stylesheet" href="/static/styles/powerful_retro.css">
@endif