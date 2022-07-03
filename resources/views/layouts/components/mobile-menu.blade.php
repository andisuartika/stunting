<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone Laravel Admin Dashboard Starter Kit" class="w-6" src="">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler">
            <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="{{ route('dashboard') }}" class="menu @yield('dashboard')">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Dashboard </div>
            </a>
        </li>
        {{-- <li>
            <a href="javascript:;" class="menu @yield('input')">
                <div class="menu__icon"> <i data-feather="users"></i> </div>
                <div class="menu__title"> Pengguna <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ route('calon-ibu') }}" class="menu @yield('calon-ibu')">
                        <div class="menu__icon"> <i data-feather="user"></i> </div>
                        <div class="menu__title"> Calon Ibu </div>
                    </a>
                </li>
                <li>
                    <a href="" class="menu @yield('petugas')">
                        <div class="menu__icon"> <i data-feather="user-check"></i> </div>
                        <div class="menu__title"> Petugas </div>
                    </a>
                </li>
            </ul>
        </li> --}}
        <li>
            <a href="{{ route('calon-ibu') }}" class="menu @yield('calon-ibu')">
                <div class="menu__icon"> <i data-feather="user-plus"></i> </div>
                <div class="menu__title"> Calon Ibu </div>
            </a>
        </li>
        <li>
            <a href="{{ route('balita') }}" class="menu @yield('balita')">
                <div class="menu__icon"> <i data-feather="user"></i> </div>
                <div class="menu__title"> Balita </div>
            </a>
        </li>
    </ul>
</div>
<!-- END: Mobile Menu -->