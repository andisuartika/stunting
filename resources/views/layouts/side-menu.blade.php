@extends('../layouts/main')

@section('head')
    @yield('subhead')
@endsection

@section('content')
    @include('../layouts/components/mobile-menu')
    <div class="flex ">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav bg-theme-3">
            <a href="" class="intro-x flex items-center pl-5 pt-4">
                {{-- <img alt="ewaste logo" class="w-6" src="{{ asset('dist/images/ewaste.svg') }}" alt="ewaste-logo">
                 --}}
                 <i data-feather="activity" class="text-white"></i>
                <span class="hidden xl:block text-white text-lg ml-3 font-medium">Stunting</span>
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="side-menu @yield('dashboard')">
                        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="side-menu__title"> Dashboard </div>
                    </a>
                </li>
                {{-- <li>
                    <a href="javascript:;" class="side-menu @yield('pengguna')">
                        <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                        <div class="side-menu__title"> Pengguna <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="" class="side-menu @yield('nasabah')">
                                <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                                <div class="side-menu__title"> Nasabah </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="side-menu @yield('petugas')">
                                <div class="side-menu__icon"> <i data-feather="user-check"></i> </div>
                                <div class="side-menu__title"> Petugas </div>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li>
                    <a href="{{ route('calon-ibu') }}" class="side-menu @yield('calon-ibu')">
                        <div class="side-menu__icon"> <i data-feather="user-plus"></i> </div>
                        <div class="side-menu__title"> Calon Ibu </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('balita') }}" class="side-menu @yield('balita')">
                        <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                        <div class="side-menu__title"> Balita </div>
                    </a>
                </li>
                         
            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            @include('../layouts/components/top-bar')
            @yield('subcontent')
        </div>
        <!-- END: Content -->
    </div>
@endsection