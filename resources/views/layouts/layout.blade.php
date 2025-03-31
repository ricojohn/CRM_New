<!doctype html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Q8 Marketing</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta name="csrf-token" /> --}}

    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Load Bootstrap Datepicker CSS -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/cupertino/jquery-ui.css">

    <!-- Load Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script> --}}

    <!-- flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- CKEditor CSS and JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.16.2/ckeditor.js" integrity="sha512-bGYUkjDyyOMGm3ASzq3zRaWZ4CONNH1wAYMFch/Z0ASZrsg722SeRsX0FPPRZjTuJrqIMbB9fvY0LEMzyHeyeQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.45/moment-timezone-with-data.min.js" integrity="sha512-t/mY3un180WRfsSkWy4Yi0tAxEDGcY2rAEx873hb5BrkvLA0QLk54+SjfYgFBBoCdJDV1H86M8uyZdJhAOHeyA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    {{-- <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" /> --}}

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
    @livewireStyles
  </head> 

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          @include('layouts.sidebar')
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="container layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            @include('layouts.navbar')
          </nav>

          <!-- / Navbar -->

          <!-- Toast with Placements -->
          <div
            class="m-2 bs-toast toast toast-placement-ex"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            data-bs-delay="2000">
            <div class="toast-header">
              <i class="bx bx-bell me-2"></i>
              <div class="me-auto fw-medium">Status</div>
              <small>0 mins</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
          </div>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container flex-grow-1 container-p-y">
              <div >
                    @yield('content')
                    
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container">
                <div
                  class="py-4 footer-container d-flex align-items-center justify-content-between flex-md-row flex-column">
                  <div class="text-body">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by
                    {{-- <a href="https://themeselection.com" target="_blank" class="footer-link">ThemeSelection</a> --}}
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    {{-- <script src="../assets/js/ui-toasts.js"></script> --}}

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @livewireScripts

      <!-- Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <form method="POST" action="{{ route('auth.logout') }}">
                  @csrf
                  @method('DELETE')
                  <div class="modal-header">
                      <h1 class="modal-title fs-5" id="logoutModalLabel">Logout?</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      Are you sure that you want to logout?
                  </div>
                  <input type="hidden" name="logoutSessionPrompt" id="logoutSessionPrompt" value="">
                  <div class="modal-footer">
                      <button type="button" data-bs-dismiss="modal" class="btn btn-outline-dark" id="stayLoggedInButton2">Back</button>
                      <button type="submit" class="btn btn-danger" id="timeoutsbmt">Yes</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

   <!-- Session Timeout Modal -->
   <div class="modal fade" id="sessionTimeoutModal" tabindex="-1" aria-labelledby="sessionTimeoutLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <form method="POST" action="{{ route('auth.logout') }}">
                  @csrf
                  @method('DELETE')
                  <div class="modal-header">
                      <h5 class="modal-title" id="sessionTimeoutLabel">Session Timeout</h5>
                  </div>
                  <div class="modal-body">
                      You've been gone for a while. For security, we will log you out in <b>90s</b>. Please click "Stay logged in" to keep working or click "Log out" to end your session now.
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>
                      <button type="button" class="btn btn-primary" id="stayLoggedInButton">Stay Logged In (<span id="countdownTimer"></span>s)</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
  </body>
  <script>
    $(document).ready(function () {
        const warningTime = 510; // 510 Seconds
        const autoLogoutTime = 90; // 90 Seconds
        
        let timeoutWarning;
        let countdown;
        let autoLogoutTimeout;
        let warningCountdown;

        // Initialize warningTime countdown display

        $('#warningTimer').text(`You will be warned in ${Math.floor(warningTime / 60)} minute(s) and ${warningTime % 60} second(s).`);

        function startWarningCountdown() {
            let warningTimeLeft = warningTime;

            // Clear previous warning countdown, if any
            clearInterval(warningCountdown);

            // Start the warning countdown
            warningCountdown = setInterval(function () {
                warningTimeLeft--;

                if (warningTimeLeft >= 0) {
                    // Calculate minutes and seconds
                    const minutes = Math.floor(warningTimeLeft / 60);
                    const seconds = warningTimeLeft % 60;

                    // Update the warning timer display with minutes and seconds
                    $('#warningTimer').text(`You will be warned in ${minutes} minute(s) and ${seconds} second(s).`);
                }
                if (warningTimeLeft === 0) {
                    clearInterval(warningCountdown);
                    showTimeoutWarning(); // Show the timeout warning when countdown reaches 0
                }
            }, 1000); // Update every second
        }

        function showTimeoutWarning() {
            const countdownElement = $('#countdownTimer');
            let timeLeft = autoLogoutTime;

            countdownElement.text(timeLeft);

            $('#sessionTimeoutModal').modal('show');

            countdown = setInterval(function () {
                timeLeft--;
                if (timeLeft >= 0) {
                    countdownElement.text(timeLeft); // Update the countdown timer display
                } else {
                    clearInterval(countdown);
                    logoutUser();
                }
            }, 1000);

            // Auto logout if no action within autoLogoutTime
            autoLogoutTimeout = setTimeout(logoutUserTimeout, autoLogoutTime * 1000);
        }

        function resetTimeouts() {
            clearTimeout(timeoutWarning);
            clearTimeout(autoLogoutTimeout);
            clearInterval(countdown);
            clearInterval(warningCountdown); // Stop the warning countdown
            $('#sessionTimeoutModal').modal('hide');
        }

        function logoutUser() {
            $('#timeoutsbmt').click();
        }

        function logoutUserTimeout() {
            // Get the input element by its ID
            const inputElement = document.getElementById('logoutSessionPrompt');

            // Change the value of the input element
            inputElement.value = 'Session Timeout. You have been signed out due to inactivity.';

            $('#timeoutsbmt').click();
        }

        // Function to reset the warning countdown and timeout warning
        function resetWarningTimer() {
            // Clear the existing timeout for showing the warning
            clearTimeout(timeoutWarning);
            clearInterval(warningCountdown); // Clear the countdown if running

            // Reset the warningTime countdown and timeout
            startWarningCountdown();
            timeoutWarning = setTimeout(showTimeoutWarning, warningTime * 1000);
        }

        // Start the initial warning countdown
        startWarningCountdown();

        // Add event listeners for mousemove, click, keypress, and scroll to reset the timer
        $(document).on('mousemove click keypress scroll', function () {
            resetWarningTimer();
        });

        $('#stayLoggedInButton, #stayLoggedInButton2').click(function () {
            // Send a request to keep the session alive
           
            location.reload();
        });

        // Reset auto-logout if user interacts with the modal
        $('#stayLoggedInButton, #stayLoggedInButton2, #timeoutsbmt').click(function() {
            clearTimeout(autoLogoutTimeout);
            clearTimeout(timeoutWarning);
            clearInterval(countdown);
            clearInterval(warningCountdown); // Stop the warning countdown if the user interacts
        });

    });
</script>
</html>
