<table class="global-navbar">
<tr>
  <td class="global-navbar__intro global-navbar__td global-navbar__sitename">
    <div class="site-title"><a href="/" class="lara">Kurenai</a></div>
  </td>
  <td class="useful-pages global-navbar__td">
  <div class="global-user-ops__wrapper">
    @if(!Auth::check())
    <a href="/services/login" class="user-ops-link">LOGIN</a>
    <a href="/services/signup" class="user-ops-link">SIGN UP</a>
    @else
    <span class="global-user-ops global-user-ops-item">Hiyah,</span>
    <span class="global-user-ops global-user-ops-item">{{ Auth::User()->name }}.</span>
    <form  class="global-user-ops-item" method="post" action="/forms/logout/">
      @csrf
      <input class="global-user-ops global-user-ops-logout" type="submit" value="log out"> 
    </form>
    @endif
  </div>
  </td>
</tr>
</table>
