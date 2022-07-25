@extends('../layouts/side-menu')

@section('subhead')
    <title>Stunting - Dashboard</title>
@endsection

@section('dashboard', 'side-menu--active')
@section('title', 'Dashboard')

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Laporan Bulan ini</h2>
                    <a href="" class="ml-auto flex text-theme-1">
                        <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Refresh Data
                    </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">12</b></div>
                                <div class="text-base text-gray-600 mt-1">Jumlah Balita</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user-plus" class="report-box__icon text-theme-9"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">21</b></div>
                                <div class="text-base text-gray-600 mt-1">Calon Ibu</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="home" class="report-box__icon text-theme-10"></i>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">54</div>
                                <div class="text-base text-gray-600 mt-1">Posyandu</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user-check" class="report-box__icon text-theme-10"></i>
                                    
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">16</div>
                                <div class="text-base text-gray-600 mt-1">Tenaga Medis</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Laporan Kesehatan Balita</h2>
                    <a href="" class="ml-auto text-theme-1 truncate">Lihat semua</a>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="flex flex-col xl:flex-row xl:items-center">
                        <div class="flex">
                            <div>
                                {{-- <div class="text-theme-20 text-lg xl:text-xl font-bold">{{ Str::rupiah($trBulanIni) }}</div> --}}
                                <div class="text-gray-600">Bulan ini</div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="report-chart">
                        <div id="transaksi" style="min-width: 310px; height: 400px; max-width: 600px;" class="mt-6"></div>
                    </div>
                </div>
            </div>
            <!-- END: Sales Report -->
            <!-- BEGIN: Weekly Top Seller -->
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Laporan Kesehatan Ibu</h2>
                    <a href="" class="ml-auto text-theme-1 truncate">Lihat semua</a>
                </div>
                <div class="intro-y box p-5 mt-5">
                    <div class="flex flex-col xl:flex-row xl:items-center">
                        <div class="flex">
                        </div>
                    </div>
                    <div id="sampah" class="mt-6" style="min-width: 310px; height: 400px; max-width: 600px;"></div>
                </div>
            </div>
            <!-- END: Weekly Top Seller -->
        
            
        </div>
    </div>
@endsection
<script src="https://code.highcharts.com/highcharts.js"></script>

     
    