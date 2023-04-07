<table class="global-navbar">
<tr>
  <td class="global-navbar__intro global-navbar__td global-navbar__sitename">
    <div class="site-title"><a href="/" class="lara">Kurenai</a></div>
  </td>
  <td class="useful-pages global-navbar__td">
  <div class="global-user-ops__wrapper">
    @if(!Auth::check())
    <a href="/services/login" class="global-util__button navbar-btn">login</a>
    <a href="/services/signup" class="global-util__button  navbar-btn">sign up</a>
    @else
  {{-- <span class="global-user-ops global-user-ops-item grey">Hiyah,</span> --}}
    <span class="global-user-ops global-user-ops-item grey">{{ Auth::User()->name }}</span>
    <form  class="global-user-ops-item" method="post" action="/forms/logout/">
      @csrf
      <input class="global-util__button logout-btn" type="submit" value="log out"> 
    </form>
    @endif
  </div>
  </td>
</tr>
</table>
