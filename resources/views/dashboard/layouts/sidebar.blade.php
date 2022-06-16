<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home"></span>
            Dashboard
          </a>
        </li>
        @if(Auth::user()->role_id == 2)
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/jobs*') ? 'active' : '' }}" href="/dashboard/jobs">
            <span data-feather="briefcase"></span>
            My Job
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/order*') ? 'active' : '' }}" href="/dashboard/orders">
            <span data-feather="file-text"></span>
            My Order
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/portfolio*') ? 'active' : '' }}" href="/dashboard/portfolio">
            <span data-feather="file-text"></span>
            My Portfolio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/review*') ? 'active' : '' }}" href="/dashboard/reviews">
            <span data-feather="file-text"></span>
            My Review
          </a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/orderUser*') ? 'active' : '' }}" href="/dashboard/ordersUser">
            <span data-feather="file-text"></span>
            My Order
          </a>
        </li>
        @endif
      </ul>
        
    </div>
  </nav>