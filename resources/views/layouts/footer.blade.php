<!-- <div class="footer-row">
    <nav>
        <div class="menu menu2d">
            <a  href="{{url('2d')}}" style="width:100%">Thai2D</a>
        </div> 
        <div class="menu menu2d">
            <a  href="{{url('dubai2d')}}" style="width:100%">Dubai2D</a>
        </div> 
        <div class="menu history">
            <a  href="{{url('history')}}" style="width:100%;">History</a>
        </div>
        <div class="menu">
            <a href="{{ route('logout') }}" style="width:100%">Logout</a>
        </div>
    </nav>
</div> -->
<nav class="navbar navbar-inverse" style="background:#3c4857;width:100% !important;position:fixed;bottom:0;padding:0;margin:0;">
  <div  style="background-color:#3c4857;display: inline-block;width:100%;padding:0;">
      <ul class="nav" style="width:100% !important;text-align:center;background:#000;">
        <li style="padding:5px 4px 5px 4px;text-align:center;border:1px solid #3c4857" class="menu 2d twod"><a href="{{ url('2d') }}" style="width:100%;">Thai2D</a></li>
        <li style="padding:5px 4px 5px 4px;text-align:center;border:1px solid #3c4857" class="menu dubai2d"><a href="{{ url('dubai2d') }}" style="width:100%;">  Dubai2D</a></li>
        <li style="padding:5px 4px 5px 4px;text-align:center;border:1px solid #3c4857" class="menu histories"><a href="{{ url('histories') }}" style="width:100%;"> History</a></li>
        <li style="padding:5px 4px 5px 4px;text-align:center;border:1px solid #3c4857;border-right:none;" class="menu"><a href="{{ route('logout') }}" style="width:100%;tex-align:center"> Logout</a></li>
      </ul>
  </div>
</nav>
<style>
a:link { text-decoration: none; }
a:visited { text-decoration: none; }
a:hover { text-decoration: none; }
a:active { text-decoration: none; }
.menu{
  width:25% !important;
  background:#000;
}

/* test */
</style>