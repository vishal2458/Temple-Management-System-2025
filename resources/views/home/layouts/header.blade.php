 <!-- ================> header section start here <================== -->
 <header class="header">
    <div class="header__bottom">
        <div class="container">
            <div class="header__mainmenu navbar navbar-expand-xl navbar-light">
                <div class="header__logo">
                    <a href="index.html" class="d-none d-xl-block"><img src="{{ asset('assets/home/assets/images/logo/01.png') }}" alt="logo"></a>
                    <a href="index.html" class="d-xl-none"><img src="{{ asset('assets/home/assets/images/logo/01.png') }}" alt="logo"></a>
                </div>
                <div class="header__bar">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menubar" aria-controls="menubar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <button class="navbar-toggler header__bar-info" type="button" data-bs-toggle="collapse" data-bs-target="#menubar2" aria-controls="menubar2" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fas fa-info"></span>
                    </button>
                </div>
                <div class="header__menu navbar-expand-xl">
                    <div class="collapse navbar-collapse" id="menubar">
                        <ul>
                            <li class="active">
                                <a href="{{ route('home') }}" class="active">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('home.festivals') }}">Events</a>
                            </li>
                            <li>
                                <a href="{{ route('home.temples') }}">Temples</a>
                            </li>
                            <li>
                                <a href="{{ route('home.mahakhumb') }}">Mahakhumb</a>
                            </li>
                        </ul>
                        @if(Auth::check())
                        <div style="position: relative; display: inline-block;">
                            <a href="#" class="default-btn" id="userBtn" style="display: inline-block;">
                                <span style="color: black">Hi!, {{ Auth::user()->first_name }} <i class="fas fa-user"></i></span>
                            </a>
                            @php
                                if(Auth::user()->is_admin == true)
                                {
                                    $route = route('admin.dashboard');

                                }else {
                                    $route = route('user.dashboard');
                                }

                            @endphp

                            <div id="userDropdown"
                                 style="display: none; position: absolute; top: 100%; left: 26px; background: #fff; border-radius: 5px; border: 1px solid #ddd; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); width: 150px; z-index: 100; text-align: left; opacity: 0; transition: opacity 0.3s ease-in-out;">
                                <a href="{{ $route }}"
                                   style="display: block; padding: 10px; text-decoration: none; color: #333; transition: background 0.2s;">
                                    Dashboard
                                </a>
                                <a href="{{ route('logout') }}"
                                   style="display: block; padding: 10px; text-decoration: none; color: #333; transition: background 0.2s;">
                                    Logout
                                </a>
                            </div>
                        </div>
                        @else
                            <a href="{{ route('login') }}" class="default-btn">
                                <span>Sign-up <i class="fas fa-heart"></i></span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ================> header section end here <================== -->

@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const button = document.getElementById('userBtn');
        const dropdown = document.getElementById('userDropdown');

        let timeout;

        button.addEventListener('mouseenter', function() {
            clearTimeout(timeout);
            dropdown.style.display = 'block';
            setTimeout(() => { dropdown.style.opacity = '1'; }, 10);
        });

        button.addEventListener('mouseleave', function() {
            timeout = setTimeout(() => {
                dropdown.style.opacity = '0';
                setTimeout(() => { dropdown.style.display = 'none'; }, 300);
            }, 300);
        });

        dropdown.addEventListener('mouseenter', function() {
            clearTimeout(timeout);
            dropdown.style.opacity = '1';
        });

        dropdown.addEventListener('mouseleave', function() {
            timeout = setTimeout(() => {
                dropdown.style.opacity = '0';
                setTimeout(() => { dropdown.style.display = 'none'; }, 30);
            }, 300);
        });

        // Add hover effect on menu items
        document.querySelectorAll("#userDropdown a").forEach(item => {
            item.addEventListener("mouseenter", function() {
                this.style.background = "#f1c152";
            });
            item.addEventListener("mouseleave", function() {
                this.style.background = "transparent";
            });
        });
    });
</script>
@endpush