<div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
    <a class="px-0 nav-item nav-link me-xl-6" href="javascript:void(0)">
      <i class="bx bx-menu bx-md"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
        <i class="bx bx-search bx-md"></i>
        <input
          type="text"
          class="border-0 shadow-none form-control ps-1 ps-sm-2"
          placeholder="Search..."
          aria-label="Search..." />
      </div>
    </div>
    <!-- /Search -->

    <ul class="flex-row navbar-nav align-items-center ms-auto">
      <!-- Place this tag where you want the button to render. -->
      <li class="nav-item lh-1 me-4">
        <a
          class="github-button"
          href="https://github.com/themeselection/sneat-html-admin-template-free"
          data-icon="octicon-star"
          data-size="large"
          data-show-count="true"
          aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
          >Star</a
        >
      </li>

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a
          class="p-0 nav-link dropdown-toggle hide-arrow"
          href="javascript:void(0);"
          data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="{{ asset('assets/img/avatars/1.png')}}" alt class="h-auto w-px-40 rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="{{ asset('assets/img/avatars/1.png')}}" alt class="h-auto w-px-40 rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-0">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                  <small class="text-muted">{{ auth()->user()->position }}</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="my-1 dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-user bx-md me-3"></i><span>My Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#"> <i class="bx bx-cog bx-md me-3"></i><span>Settings</span> </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <span class="align-middle d-flex align-items-center">
                <i class="flex-shrink-0 bx bx-credit-card bx-md me-3"></i
                ><span class="align-middle flex-grow-1">Billing Plan</span>
                <span class="flex-shrink-0 badge rounded-pill bg-danger">4</span>
              </span>
            </a>
          </li>
          <li>
            <div class="my-1 dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="{{route('auth.logout')}}">
              <i class="bx bx-power-off bx-md me-3"></i><span>Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>