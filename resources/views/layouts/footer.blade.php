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
<nav class="navbar navbar-inverse bg-dark" style="background-color:red;width:100% !important;position:fixed;bottom:0">
  <div class="container-fluid">
    <div style="display: inline-block;width:100%;text-align:center;">
      <ul class="nav" style="width:100% !important;text-align:center;">
        <li style="padding:5px 5px 5px 0px;" class="menu 2d twod"><a href="{{ url('2d') }}" style="padding-left:0px">  Thai2D</a></li>
        <li style="padding:5px 5px 5px 0px;" class="menu dubai2d"><a href="{{ url('dubai2d') }}" style="padding-left:5px">  Dubai2D</a></li>
        <li style="padding:5px 5px 5px 0px;" class="menu histories"><a href="{{ url('histories') }}" style="padding-left:5px"> History</a></li>
        <li style="padding:5px 5px 5px 0px;" class="menu"><a href="{{ route('logout') }}" style="padding-left:5px"> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<style>
a:link { text-decoration: none; }
a:visited { text-decoration: none; }
a:hover { text-decoration: none; }
a:active { text-decoration: none; }
.menu{
  width:25%;
}
</style>