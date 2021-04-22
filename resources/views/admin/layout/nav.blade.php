  <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
          <a href="/dash"><img
                  src="https://media-exp1.licdn.com/dms/image/C561BAQFGwG_I_yubDA/company-background_10000/0?e=2159024400&v=beta&t=f83zNNQ6RU2uunQpo_aAuAPu5mcO131gWldsrsewsQo"
                  class="img-fluid" id="dashlogo"></a>

      </div>
      <ul class="sidebar-nav" id="myDIV">
          <li class="active nav-link">
              <a href="/"><i class="fa fa-home"></i>Dashboard</a>
          </li>
          <li class="nav-link">
              <a href="/country"><i class="fa fa-plug"></i>Locations</a>
          </li>
          <li class="nav-link">
              <a href="/category"><i class="fa fa-plug"></i>Categories</a>
          </li>
          <li class="nav-link">
              <a href="/subcategory"><i class="fa fa-user"></i>Sub Categories</a>
          </li>
          <li class="nav-link">
              <a href="/service"><i class="fa fa-user"></i>Services</a>
          </li>
          <li class="nav-link">
              <a href="/manager"><i class="fa fa-user"></i>Manager</a>
          </li>
          <li class="nav-link">
              <a href="/partner"><i class="fa fa-user"></i>Partner</a>
          </li>
          <li class="nav-link">
              <a href="/customer"><i class="fa fa-user"></i>Customer</a>
          </li>
          <li class="nav-link">
              <a href="/payment_method"><i class="fa fa-user"></i>Payment Methods</a>
          </li>
          <li class="nav-link">
              <a href="/contact"><i class="fa fa-user"></i>Queries</a>
          </li>
          <li class="nav-link">
              <a href="/appointment"><i class="fa fa-user"></i>Appointments</a>
          </li>
          <li class="nav-link">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>

          </li>


      </ul>
  </aside>

  <div id="navbar-wrapper">
      <nav class="navbar navbar-inverse">
          <div class="container-fluid">
              <div class="navbar-header">
                  <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
              </div>
          </div>
      </nav>
  </div>
  <script>
// Add active class to the current button (highlight it)
var header = document.getElementById("myDIV");
var btns = header.getElementsByClassName("nav-link");
for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        if (current.length > 0) {
            current[0].className = current[0].className.replace(" active", "");
        }
        this.className += " active";
    });
}
  </script>