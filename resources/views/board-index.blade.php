<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $boardConfig['name'] }}</title>
    @include('head.stylesheets')
</head>

<body style="margin: 0">
@include('global.warnings')
@include('global.navbar')
<div class="board-header">
  <div class="board-name">/{{ $boardConfig['uri'] }}/ - {{ $boardConfig['name'] }}</div>
  <div class="board-description">{{ $boardConfig['description'] }}</div>
</div>


<div class="last-wrapper-i-swear">
@if (Auth::check())
<div class="thread-motivational">Make a thread!</div>
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

<div class="threadlist-containter"> 
<div class="thread-index-container">

@if(isset($threads))
@foreach($threads as $thread)
<div class="thread-container">
  <div class="thread-bullets">•</div> 
  <div class="thread-hiperlink">{{ $thread['title'] }}</div> 
  <div data-unix-date="{{ $thread['created_at'] }}" class="thread-date">{{ $thread['created_at'] /* remember to convert this to human readable */ }}</div>
  <div class="thread-reply-count">({{ $thread['replyCount']}} )</div>
  <div class="thread-props-container"> {{-- these sgv are making the index A LOT bigger than it should be, probably might need to replace by images --}}
    @if($thread['isLocked'])
    <svg class="thread-props" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 330 330" style="enable-background:new 0 0 330 330;" xml:space="preserve"><g id="XMLID_518_"><path id="XMLID_519_"d="M65,330h200c8.284,0,15-6.716,15-15V145c0-8.284-6.716-15-15-15h-15V85c0-46.869-38.131-85-85-85	S80.001,38.131,80.001,85v45H65c-8.284,0-15,6.716-15,15v170C50,323.284,56.716,330,65,330z M110.001,85
c0-30.327,24.673-55,54.999-55c30.327,0,55,24.673,55,55v45H110.001V85z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
    @endif
    @if($thread['isPinned'])
    <svg class="thread-props" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" id="svg2" version="1.1" inkscape:version="0.91 r13725" sodipodi:docname="pin.svg" viewBox="-0.07 -0.17 448.37 448.35">   <title id="title3373">pin</title>   <defs id="defs4"></defs>   <sodipodi:namedview id="base" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0" inkscape:pageopacity="0.0" inkscape:pageshadow="2" inkscape:zoom="1.4142136" inkscape:cx="196.64053" inkscape:cy="200.30519" inkscape:document-units="px" inkscape:current-layer="layer1" showgrid="true" inkscape:snap-bbox="true" inkscape:bbox-nodes="true" units="px" inkscape:window-width="1169" inkscape:window-height="924" inkscape:window-x="364" inkscape:window-y="364" inkscape:window-maximized="0" inkscape:object-nodes="true">     <inkscape:grid type="xygrid" id="grid3336" spacingx="16" spacingy="16" empspacing="2"></inkscape:grid>   </sodipodi:namedview>   <metadata id="metadata7">     <rdf:rdf>       <cc:work rdf:about="">         <dc:format>image/svg+xml</dc:format>         <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"></dc:type>         <dc:title>pin</dc:title>       </cc:work>     </rdf:rdf>   </metadata>   <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(0,-604.36224)">     <flowroot xml:space="preserve" id="flowRoot3338" style="font-style:normal;font-weight:normal;font-size:40px;line-height:125%;font-family:sans-serif;letter-spacing:0px;word-spacing:0px;fill:#000000;fill-opacity:1;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" transform="translate(0,698.0315)"><flowregion id="flowRegion3340"><rect id="rect3342" width="360" height="360" x="0" y="-5.669281"></rect></flowregion><flowpara id="flowPara3344"></flowpara></flowroot>    <flowroot xml:space="preserve" id="flowRoot3371" style="font-style:normal;font-weight:normal;font-size:40px;line-height:125%;font-family:sans-serif;letter-spacing:0px;word-spacing:0px;fill:#000000;fill-opacity:1;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1"><flowregion id="flowRegion3373"><rect id="rect3375" width="85" height="85" x="5" y="5"></rect></flowregion><flowpara id="flowPara3377"></flowpara></flowroot>    <flowroot xml:space="preserve" id="flowRoot3404" style="font-style:normal;font-weight:normal;font-size:40px;line-height:125%;font-family:sans-serif;letter-spacing:0px;word-spacing:0px;fill:#000000;fill-opacity:1;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1"><flowregion id="flowRegion3406"><rect id="rect3408" width="65" height="50" x="15" y="20"></rect></flowregion><flowpara id="flowPara3410"></flowpara></flowroot>    <flowroot xml:space="preserve" id="flowRoot3437" style="font-style:normal;font-weight:normal;font-size:40px;line-height:125%;font-family:sans-serif;letter-spacing:0px;word-spacing:0px;fill:#000000;fill-opacity:1;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1"><flowregion id="flowRegion3439"><rect id="rect3441" width="80" height="75" x="5" y="5"></rect></flowregion><flowpara id="flowPara3443"></flowpara></flowroot>    <text sodipodi:linespacing="125%" id="text3481" y="1009.7125" x="51.231663" style="font-style:normal;font-variant:normal;font-weight:400;font-size:13.8125px;line-height:125%;font-family:Calibri;text-align:start;letter-spacing:0px;word-spacing:0px;text-anchor:start;fill:#000000;fill-opacity:1;stroke:none" xml:space="preserve"><tspan id="tspan3483" y="0" x="0" sodipodi:role="line"><tspan id="tspan3485" style="font-style:normal;font-variant:normal;font-weight:400;font-size:13.8125px;font-family:Calibri;fill:#000000" dy="0" dx="0"></tspan></tspan></text>     <text sodipodi:linespacing="125%" id="text3698" y="1080.1998" x="82.929802" style="font-style:normal;font-variant:normal;font-weight:400;font-size:13.8125px;line-height:125%;font-family:Calibri;text-align:start;letter-spacing:0px;word-spacing:0px;text-anchor:start;fill:#000000;fill-opacity:1;stroke:none" xml:space="preserve"><tspan id="tspan3700" y="0" x="0" sodipodi:role="line"><tspan id="tspan3702" style="font-style:normal;font-variant:normal;font-weight:400;font-size:13.8125px;font-family:Calibri;fill:#000000" dy="0" dx="0"></tspan></tspan></text>     <text sodipodi:linespacing="125%" id="text3917" y="1331.0359" x="414.3045" style="font-style:normal;font-variant:normal;font-weight:400;font-size:82.5056076px;line-height:125%;font-family:Calibri;text-align:start;letter-spacing:0px;word-spacing:0px;text-anchor:start;fill:#000000;fill-opacity:1;stroke:none" xml:space="preserve" transform="scale(1.0089379,0.99114132)"><tspan id="tspan3919" y="0" x="0" sodipodi:role="line"><tspan id="tspan3921" style="font-style:normal;font-variant:normal;font-weight:400;font-size:82.5056076px;font-family:Calibri;fill:#000000" dy="0" dx="0"></tspan></tspan></text>     <text sodipodi:linespacing="125%" id="text3980" y="1087.3585" x="85.308571" style="font-style:normal;font-variant:normal;font-weight:400;font-size:13.8125px;line-height:125%;font-family:Calibri;text-align:start;letter-spacing:0px;word-spacing:0px;text-anchor:start;fill:#000000;fill-opacity:1;stroke:none" xml:space="preserve"><tspan id="tspan3982" y="0" x="0" sodipodi:role="line"><tspan id="tspan3984" style="font-style:normal;font-variant:normal;font-weight:400;font-size:13.8125px;font-family:Calibri;fill:#000000" dy="0" dx="0"></tspan></tspan></text>     <g style="font-style:normal;font-variant:normal;font-weight:400;font-size:13.8125px;line-height:125%;font-family:Calibri;text-align:start;letter-spacing:0px;word-spacing:0px;text-anchor:start;fill:#000000;fill-opacity:1;stroke:none" id="text4267" transform="matrix(6.2024074,0,0,6.2016826,-62.869915,-5357.8353)"></g>     <text sodipodi:linespacing="125%" id="text4331" y="1083.7958" x="83.372887" style="font-style:normal;font-variant:normal;font-weight:400;font-size:13.8125px;line-height:125%;font-family:Calibri;text-align:start;letter-spacing:0px;word-spacing:0px;text-anchor:start;fill-opacity:1;stroke:none" xml:space="preserve"><tspan id="tspan4333" y="0" x="0" sodipodi:role="line"><tspan id="tspan4335" style="font-style:normal;font-variant:normal;font-weight:400;font-size:13.8125px;font-family:Calibri" dy="0" dx="0"></tspan></tspan></text>     <g style="font-style:normal;font-variant:normal;font-weight:400;font-size:13.8125px;line-height:125%;font-family:Calibri;text-align:start;letter-spacing:0px;word-spacing:0px;text-anchor:start;fill:#000000;fill-opacity:1;stroke:none" id="text4394" transform="matrix(7.5669371,0,0,7.5622391,-98.504057,-6778.9852)"></g>     <text sodipodi:linespacing="125%" id="text4519" y="1280.7061" x="411.78085" style="font-style:normal;font-variant:normal;font-weight:400;font-size:73.50739288px;line-height:125%;font-family:Calibri;text-align:start;letter-spacing:0px;word-spacing:0px;text-anchor:start;fill-opacity:1;stroke:none" xml:space="preserve"><tspan id="tspan4521" y="0" x="0" sodipodi:role="line"><tspan id="tspan4523" style="font-style:normal;font-variant:normal;font-weight:400;font-size:73.50739288px;font-family:Calibri" dy="0" dx="0"></tspan></tspan></text>     <g style="font-style:normal;font-variant:normal;font-weight:400;font-size:16.91569519px;line-height:125%;font-family:'Segoe UI Symbol';text-align:start;letter-spacing:0px;word-spacing:0px;text-anchor:start;fill-opacity:1;stroke:none" id="text4955" transform="matrix(27.819263,0,0,27.789276,-278.71626,-27667.673)">       <path style="font-style:normal;font-variant:normal;font-weight:400;font-size:16.91569519px;font-family:'Segoe UI Symbol'" d="m 26.122772,1023.1298 c -0.763949,0.8194 -1.845113,1.0275 -2.875705,0.5757 -1.172866,1.1728 -2.27798,2.2818 -3.450846,3.4546 0.796409,1.4944 0.650551,2.8355 -0.575142,4.0303 l -2.875705,-2.303 -6.326551,4.6061 4.601128,-6.3334 -2.300564,-2.8788 c 1.194787,-1.2256 2.531653,-1.3722 4.025987,-0.5758 1.172866,-1.1729 2.277981,-2.2817 3.450847,-3.4546 -0.451862,-1.0306 -0.24408,-2.1148 0.575141,-2.8788 1.879129,1.883 3.879031,3.8718 5.75141,5.7577 z" id="path4979" inkscape:connector-curvature="0" sodipodi:nodetypes="cccccccccccc"></path>     </g>     <g style="font-style:normal;font-variant:normal;font-weight:400;font-size:13.8125px;line-height:125%;font-family:Calibri;text-align:start;letter-spacing:0px;word-spacing:0px;text-anchor:start;fill-opacity:1;stroke:none" id="text4961" transform="matrix(6.2023754,0,0,6.197438,-62.02324,-5352.6404)"></g>   </g> </svg>
    @endif
    @if($thread['isAnonymous'])
    <svg class="thread-props" xmlns="http://www.w3.org/2000/svg" viewBox="0 1 16 14">   <path fill-rule="evenodd" clip-rule="evenodd" d="M5.371 1.072a1 1 0 00-1.32.612L2.28 7H1a1 1 0 000 2h14a1 1 0 100-2h-1.28l-1.77-5.316a1 1 0 00-1.32-.612L8 2.123 5.371 1.072zM11.613 7l-1.226-3.678-2.016.806a1 1 0 01-.742 0l-2.016-.806L4.387 7h7.226z"></path>   <path d="M2 11a1 1 0 100 2c.552 0 .98.475 1.244.959A2 2 0 005 15h.558a2 2 0 001.898-1.367l.105-.317a.463.463 0 01.878 0l.105.316A2 2 0 0010.441 15H11a2 2 0 001.755-1.041c.266-.484.693-.959 1.245-.959a1 1 0 100-2H2z"></path> </svg>
    @endif
    @if($thread['isInfinite'])
    <svg class="thread-props" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="3 4 18 16">          <title>loop</title>     <desc>Created with sketchtool.</desc>     <g id="media-player" stroke="none" stroke-width="1" fill-rule="evenodd">         <g id="loop">             <path d="M6.8762659,15.1237341 C7.93014755,16.8486822 9.83062143,18 12,18 C14.6124377,18 16.8349158,16.3303847 17.6585886,14 L19.747965,14 C18.8598794,17.4504544 15.7276789,20 12,20 C9.28005374,20 6.87714422,18.6426044 5.43172915,16.5682708 L3,19 L3,13 L9,13 L6.8762659,15.1237341 Z M17.1245693,8.87543068 C16.0703077,7.15094618 14.1695981,6 12,6 C9.3868762,6 7.16381436,7.66961525 6.33992521,10 L4.25,10 C5.13831884,6.54954557 8.27134208,4 12,4 C14.7202162,4 17.123416,5.35695218 18.5692874,7.43071264 L21,5 L21,11 L15,11 L17.1245693,8.87543068 Z" id="Shape"></path>         </g>     </g> </svg>
    @endif
</div>
</div>
  @if(thread['replies'])
  @foreach($thread['replies'] as $reply)
  <div class="thread-reply-container">
    <div class="thread-hiperlink reply-hiperlink">{{ $reply['title'] }}</div>
    <div class="thread-user">- {{$reply['userName'] }}</div>
  </div>
  @endforeach
  @endif
@endforeach
@endif

</div>

</div>
</div>
@include('global.footer')
</body>
</html>