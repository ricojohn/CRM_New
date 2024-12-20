@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="mb-6 col-xxl-8 order-0">
    <div class="card">
      <div class="d-flex align-items-start row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="mb-3 card-title text-primary">Congratulations John! 🎉</h5>
            <p class="mb-6">
              You have done 72% more sales today.<br />Check your new badge in your profile.
            </p>

            <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
          </div>
        </div>
        <div class="text-center col-sm-5 text-sm-left">
          <div class="px-0 pb-0 card-body px-md-6">
            <img
              src="assets/img/illustrations/man-with-laptop.png"
              height="175"
              class="scaleX-n1-rtl"
              alt="View Badge User" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="order-1 col-lg-4 col-md-4">
    <div class="row">
      <div class="mb-6 col-lg-6 col-md-12 col-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="mb-4 card-title d-flex align-items-start justify-content-between">
              <div class="flex-shrink-0 avatar">
                <img
                  src="assets/img/icons/unicons/chart-success.png"
                  alt="chart success"
                  class="rounded" />
              </div>
              <div class="dropdown">
                <button
                  class="p-0 btn"
                  type="button"
                  id="cardOpt3"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded text-muted"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <p class="mb-1">Profit</p>
            <h4 class="mb-3 card-title">$12,628</h4>
            <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
          </div>
        </div>
      </div>
      <div class="mb-6 col-lg-6 col-md-12 col-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="mb-4 card-title d-flex align-items-start justify-content-between">
              <div class="flex-shrink-0 avatar">
                <img
                  src="assets/img/icons/unicons/wallet-info.png"
                  alt="wallet info"
                  class="rounded" />
              </div>
              <div class="dropdown">
                <button
                  class="p-0 btn"
                  type="button"
                  id="cardOpt6"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded text-muted"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <p class="mb-1">Sales</p>
            <h4 class="mb-3 card-title">$4,679</h4>
            <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Total Revenue -->
  <div class="order-2 mb-6 col-12 col-xxl-8 order-md-3 order-xxl-2">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-lg-8">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="mb-0 card-title">
              <h5 class="m-0 me-2">Total Revenue</h5>
            </div>
            <div class="dropdown">
              <button
                class="p-0 btn"
                type="button"
                id="totalRevenue"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded bx-lg text-muted"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalRevenue">
                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
              </div>
            </div>
          </div>
          <div id="totalRevenueChart" class="px-3"></div>
        </div>
        <div class="col-lg-4 d-flex align-items-center">
          <div class="card-body px-xl-9">
            <div class="mb-6 text-center">
              <div class="btn-group">
                <button type="button" class="btn btn-outline-primary">
                  <script>
                    document.write(new Date().getFullYear() - 1);
                  </script>
                </button>
                <button
                  type="button"
                  class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                  data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:void(0);">2021</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">2020</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">2019</a></li>
                </ul>
              </div>
            </div>

            <div id="growthChart"></div>
            <div class="my-6 text-center fw-medium">62% Company Growth</div>

            <div class="gap-3 d-flex justify-content-between">
              <div class="d-flex">
                <div class="avatar me-2">
                  <span class="avatar-initial rounded-2 bg-label-primary"
                    ><i class="bx bx-dollar bx-lg text-primary"></i
                  ></span>
                </div>
                <div class="d-flex flex-column">
                  <small>
                    <script>
                      document.write(new Date().getFullYear() - 1);
                    </script>
                  </small>
                  <h6 class="mb-0">$32.5k</h6>
                </div>
              </div>
              <div class="d-flex">
                <div class="avatar me-2">
                  <span class="avatar-initial rounded-2 bg-label-info"
                    ><i class="bx bx-wallet bx-lg text-info"></i
                  ></span>
                </div>
                <div class="d-flex flex-column">
                  <small>
                    <script>
                      document.write(new Date().getFullYear() - 2);
                    </script>
                  </small>
                  <h6 class="mb-0">$41.2k</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Total Revenue -->
  <div class="order-3 col-12 col-md-8 col-lg-12 col-xxl-4 order-md-2">
    <div class="row">
      <div class="mb-6 col-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="mb-4 card-title d-flex align-items-start justify-content-between">
              <div class="flex-shrink-0 avatar">
                <img src="assets/img/icons/unicons/paypal.png" alt="paypal" class="rounded" />
              </div>
              <div class="dropdown">
                <button
                  class="p-0 btn"
                  type="button"
                  id="cardOpt4"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded text-muted"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <p class="mb-1">Payments</p>
            <h4 class="mb-3 card-title">$2,456</h4>
            <small class="text-danger fw-medium"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
          </div>
        </div>
      </div>
      <div class="mb-6 col-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="mb-4 card-title d-flex align-items-start justify-content-between">
              <div class="flex-shrink-0 avatar">
                <img src="assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
              </div>
              <div class="dropdown">
                <button
                  class="p-0 btn"
                  type="button"
                  id="cardOpt1"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded text-muted"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <p class="mb-1">Transactions</p>
            <h4 class="mb-3 card-title">$14,857</h4>
            <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
          </div>
        </div>
      </div>
      <div class="mb-6 col-12">
        <div class="card">
          <div class="card-body">
            <div class="gap-10 d-flex justify-content-between align-items-center flex-sm-row flex-column">
              <div class="flex-row d-flex flex-sm-column align-items-start justify-content-between">
                <div class="mb-6 card-title">
                  <h5 class="mb-1 text-nowrap">Profile Report</h5>
                  <span class="badge bg-label-warning">YEAR 2022</span>
                </div>
                <div class="mt-sm-auto">
                  <span class="text-success text-nowrap fw-medium"
                    ><i class="bx bx-up-arrow-alt"></i> 68.2%</span
                  >
                  <h4 class="mb-0">$84,686k</h4>
                </div>
              </div>
              <div id="profileReportChart"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <!-- Order Statistics -->
  <div class="mb-6 col-md-6 col-lg-4 col-xl-4 order-0">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between">
        <div class="mb-0 card-title">
          <h5 class="mb-1 me-2">Order Statistics</h5>
          <p class="card-subtitle">42.82k Total Sales</p>
        </div>
        <div class="dropdown">
          <button
            class="p-0 btn text-muted"
            type="button"
            id="orederStatistics"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded bx-lg"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="mb-6 d-flex justify-content-between align-items-center">
          <div class="gap-1 d-flex flex-column align-items-center">
            <h3 class="mb-1">8,258</h3>
            <small>Total Orders</small>
          </div>
          <div id="orderStatisticsChart"></div>
        </div>
        <ul class="p-0 m-0">
          <li class="mb-5 d-flex align-items-center">
            <div class="flex-shrink-0 avatar me-3">
              <span class="rounded avatar-initial bg-label-primary"
                ><i class="bx bx-mobile-alt"></i
              ></span>
            </div>
            <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
              <div class="me-2">
                <h6 class="mb-0">Electronic</h6>
                <small>Mobile, Earbuds, TV</small>
              </div>
              <div class="user-progress">
                <h6 class="mb-0">82.5k</h6>
              </div>
            </div>
          </li>
          <li class="mb-5 d-flex align-items-center">
            <div class="flex-shrink-0 avatar me-3">
              <span class="rounded avatar-initial bg-label-success"><i class="bx bx-closet"></i></span>
            </div>
            <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
              <div class="me-2">
                <h6 class="mb-0">Fashion</h6>
                <small>T-shirt, Jeans, Shoes</small>
              </div>
              <div class="user-progress">
                <h6 class="mb-0">23.8k</h6>
              </div>
            </div>
          </li>
          <li class="mb-5 d-flex align-items-center">
            <div class="flex-shrink-0 avatar me-3">
              <span class="rounded avatar-initial bg-label-info"><i class="bx bx-home-alt"></i></span>
            </div>
            <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
              <div class="me-2">
                <h6 class="mb-0">Decor</h6>
                <small>Fine Art, Dining</small>
              </div>
              <div class="user-progress">
                <h6 class="mb-0">849k</h6>
              </div>
            </div>
          </li>
          <li class="d-flex align-items-center">
            <div class="flex-shrink-0 avatar me-3">
              <span class="rounded avatar-initial bg-label-secondary"
                ><i class="bx bx-football"></i
              ></span>
            </div>
            <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
              <div class="me-2">
                <h6 class="mb-0">Sports</h6>
                <small>Football, Cricket Kit</small>
              </div>
              <div class="user-progress">
                <h6 class="mb-0">99</h6>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Order Statistics -->

  <!-- Expense Overview -->
  <div class="order-1 mb-6 col-md-6 col-lg-4">
    <div class="card h-100">
      <div class="card-header nav-align-top">
        <ul class="nav nav-pills" role="tablist">
          <li class="nav-item">
            <button
              type="button"
              class="nav-link active"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#navs-tabs-line-card-income"
              aria-controls="navs-tabs-line-card-income"
              aria-selected="true">
              Income
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab">Expenses</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab">Profit</button>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="p-0 tab-content">
          <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
            <div class="mb-6 d-flex">
              <div class="flex-shrink-0 avatar me-3">
                <img src="assets/img/icons/unicons/wallet.png" alt="User" />
              </div>
              <div>
                <p class="mb-0">Total Balance</p>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-1">$459.10</h6>
                  <small class="text-success fw-medium">
                    <i class="bx bx-chevron-up bx-lg"></i>
                    42.9%
                  </small>
                </div>
              </div>
            </div>
            <div id="incomeChart"></div>
            <div class="gap-3 mt-6 d-flex align-items-center justify-content-center">
              <div class="flex-shrink-0">
                <div id="expensesOfWeek"></div>
              </div>
              <div>
                <h6 class="mb-0">Income this week</h6>
                <small>$39k less than last week</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Expense Overview -->

  <!-- Transactions -->
  <div class="order-2 mb-6 col-md-6 col-lg-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="m-0 card-title me-2">Transactions</h5>
        <div class="dropdown">
          <button
            class="p-0 btn text-muted"
            type="button"
            id="transactionID"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded bx-lg"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
          </div>
        </div>
      </div>
      <div class="pt-4 card-body">
        <ul class="p-0 m-0">
          <li class="mb-6 d-flex align-items-center">
            <div class="flex-shrink-0 avatar me-3">
              <img src="assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
            </div>
            <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
              <div class="me-2">
                <small class="d-block">Paypal</small>
                <h6 class="mb-0 fw-normal">Send money</h6>
              </div>
              <div class="gap-2 user-progress d-flex align-items-center">
                <h6 class="mb-0 fw-normal">+82.6</h6>
                <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="mb-6 d-flex align-items-center">
            <div class="flex-shrink-0 avatar me-3">
              <img src="assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
            </div>
            <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
              <div class="me-2">
                <small class="d-block">Wallet</small>
                <h6 class="mb-0 fw-normal">Mac'D</h6>
              </div>
              <div class="gap-2 user-progress d-flex align-items-center">
                <h6 class="mb-0 fw-normal">+270.69</h6>
                <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="mb-6 d-flex align-items-center">
            <div class="flex-shrink-0 avatar me-3">
              <img src="assets/img/icons/unicons/chart.png" alt="User" class="rounded" />
            </div>
            <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
              <div class="me-2">
                <small class="d-block">Transfer</small>
                <h6 class="mb-0 fw-normal">Refund</h6>
              </div>
              <div class="gap-2 user-progress d-flex align-items-center">
                <h6 class="mb-0 fw-normal">+637.91</h6>
                <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="mb-6 d-flex align-items-center">
            <div class="flex-shrink-0 avatar me-3">
              <img src="assets/img/icons/unicons/cc-primary.png" alt="User" class="rounded" />
            </div>
            <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
              <div class="me-2">
                <small class="d-block">Credit Card</small>
                <h6 class="mb-0 fw-normal">Ordered Food</h6>
              </div>
              <div class="gap-2 user-progress d-flex align-items-center">
                <h6 class="mb-0 fw-normal">-838.71</h6>
                <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="mb-6 d-flex align-items-center">
            <div class="flex-shrink-0 avatar me-3">
              <img src="assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
            </div>
            <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
              <div class="me-2">
                <small class="d-block">Wallet</small>
                <h6 class="mb-0 fw-normal">Starbucks</h6>
              </div>
              <div class="gap-2 user-progress d-flex align-items-center">
                <h6 class="mb-0 fw-normal">+203.33</h6>
                <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
          <li class="d-flex align-items-center">
            <div class="flex-shrink-0 avatar me-3">
              <img src="assets/img/icons/unicons/cc-warning.png" alt="User" class="rounded" />
            </div>
            <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
              <div class="me-2">
                <small class="d-block">Mastercard</small>
                <h6 class="mb-0 fw-normal">Ordered Food</h6>
              </div>
              <div class="gap-2 user-progress d-flex align-items-center">
                <h6 class="mb-0 fw-normal">-92.45</h6>
                <span class="text-muted">USD</span>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Transactions -->
</div>
@endsection