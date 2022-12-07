@if(isset($warnings))
@foreach($warnings as $warning)
<div class="global-news">{{ $warning }}</div>
@endforeach
@endif
