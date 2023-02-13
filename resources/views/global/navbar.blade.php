<table class="global-navbar">
<tr>
  <td class="global-navbar__intro global-navbar__td global-navbar__sitename">
    <div class="site-title"><a href="/" class="lara">Kurenai</a></div>
  </td>
  <td class="useful-pages global-navbar__td">
  <div class="global-user-ops__wrapper">
    @if(!Auth::check())
    <div class="global-user-ops"><a href="/services/login" class="user-ops-link">LOGIN</a></div>
    <div class="global-user-ops"><a href="/services/signup" class="user-ops-link">SIGN UP</a></div>
    @endif
  </div>
  </td>
</tr>
</table>
