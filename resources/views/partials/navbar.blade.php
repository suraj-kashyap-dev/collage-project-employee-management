<nav class="navbar navbar-expand navbar-light navbar-bg">
  <a class="sidebar-toggle js-sidebar-toggle">
    <i class="hamburger align-self-center"></i>
  </a>

  <ul class="navbar-nav navbar-align">
    <li class="nav-item dropdown">
      <a class="nav-icon nav-link dropdown-toggle" href="javascript:void(0)" id="itemsDropdown" data-bs-toggle="dropdown">
        <i class="align-middle" data-feather="plus"></i>
        <span class="align-middle" style="font-size: 0.85rem;">New Items</span>
      </a>
      <div class="dropdown-menu py-0" aria-labelledby="itemsDropdown">
        <div class="dropdown-menu-header">{{ __('Add New Opion') }}</div>
        <div class="list-group">
          <a href="{{ route('department.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('Department') }}</span>
          </a>
          <a href="{{ route('designation.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('Designation') }}</span>
          </a>
          <a href="{{ route('employee.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('Employee') }}</span>
          </a>
          <a href="{{ route('attendance.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('Attendance') }}</span>
          </a>
          <a href="{{ route('leaves.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('Leave') }}</span>
          </a>
          <a href="{{ route('user.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('User') }}</span>
          </a>
        </div>
      </div>
    </li>
  </ul>

  <div class="navbar-collapse collapse">
    <ul class="navbar-nav navbar-align">
      <li class="nav-item dropdown">
        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
          <i class="align-middle" data-feather="settings"></i>
        </a>
        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
          <img src="{{ asset('img/avatars/dummy.png') }}" class="avatar img-fluid me-1 rounded" alt="Charles Hall" /> <span class="text-dark">{{ Auth::user()->name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
          {{-- <a class="dropdown-item" href="javascript:void(0)">Log out</a> --}}
          <!-- Authentication -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
              <i class="me-1 align-middle" data-feather="log-out"></i>
              <span class="me-1">{{ __('Log Out') }}</span>
            </a>
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>