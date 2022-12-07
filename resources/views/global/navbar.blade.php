<table class="global-navbar">
<tr>
  <td class="global-navbar__intro global-navbar__td global-navbar__sitename">
    <div class="site-title"><span class="lara">LARA</span><span class="board">BOARD<span></div>
  </td>
  <td class="useful-pages global-navbar__td">
  <div class="global-user-ops__wrapper">
    @if(!Auth::check())
    <div class="global-user-ops">LOGIN</div>
    <div class="global-user-ops">SIGN UP</div>
    @endif
  </div>
  </td>
</tr>
</table>
