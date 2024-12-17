<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
      <!-- Greeting Message -->
        <div class="navbar-nav align-items-center mt-2">
            <div class="nav-item d-flex align-items-center">
                <h4 class="fw-medium d-block mb-3" id="greetingMessage"></h4>
            </div>
        </div>
        <!-- /Greeting Message -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            @if (Auth::check())
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{asset('img/avatars/1.jpeg')}}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                                    @if (session('user_id'))
                                    <!-- Menampilkan informasi pengguna dari sesi -->
                                    User ID from session: {{ session('user_id') }}
                                    @endif

                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            @else
            <p>You are not logged in. <a href="{{ route('login') }}">Login</a></p>
            @endif
            <!--/ User -->
        </ul>
    </div>
</nav>
<!-- / Navbar -->

<!-- Script JavaScript untuk menampilkan pesan selamat -->
<script>
    // Fungsi untuk mendapatkan waktu saat ini dan menentukan pesan selamat yang sesuai
    function getCurrentTime() {
        var currentTime = new Date();
        var hours = currentTime.getHours();

        // Tentukan pesan tergantung pada waktu
        if (hours < 12) {
            return 'Good Morning';
        } else if (hours < 18) {
            return 'Good Afternoon';
        } else {
            return 'Good Evening';
        }
    }

    // Set pesan selamat pagi/siang/malam berdasarkan waktu saat ini
    var greetingMessage = getCurrentTime() + ', Admin';
    document.getElementById('greetingMessage').textContent = greetingMessage;
</script>
