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
                                    <i data-feather="download" class="report-box__icon text-theme-9"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="25% Lebih banyak dari bulan lalu">
                                            25% <i data-feather="chevron-up" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="text-3xl font-bold leading-8 mt-6">{{ $sampahMasuk }} <b class="text-lg">kg</b></div> --}}
                                <div class="text-base text-gray-600 mt-1">Sampah Masuk</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="upload" class="report-box__icon text-theme-9"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="35% Lebih rendah dari bulan lalu">
                                            35% <i data-feather="chevron-down" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="text-3xl font-bold leading-8 mt-6">{{ $sampahKeluar }} <b class="text-lg">kg</b></div> --}}
                                <div class="text-base text-gray-600 mt-1">Sampah Keluar</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user" class="report-box__icon text-theme-10"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="20% Lebih banyak dari bulan lalu">
                                            20% <i data-feather="chevron-up" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="text-3xl font-bold leading-8 mt-6">{{ $nasabah }} <b class="text-lg">Pengguna</b></div> --}}
                                <div class="text-base text-gray-600 mt-1">Nasabah Aktif</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user-check" class="report-box__icon text-theme-6"></i>
                                    
                                </div>
                                {{-- <div class="text-3xl font-bold leading-8 mt-6">{{ $petugas }} <b class="text-lg">Petugas</b></div> --}}
                                <div class="text-base text-gray-600 mt-1">Petugas Sampah</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Laporan Transaksi</h2>
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
                    <h2 class="text-lg font-medium truncate mr-5">Sampah Masuk</h2>
                    <a href="" class="ml-auto text-theme-1 truncate">Lihat semua</a>
                </div>
                <div class="intro-y box p-5 mt-5">
                    <div class="flex flex-col xl:flex-row xl:items-center">
                        <div class="flex">
                            <div>
                                <div class="text-theme-20 text-lg xl:text-xl font-bold"> Kg</div>
                                <div class="text-gray-600">Total Sampah</div>
                            </div>
                        </div>
                    </div>
                    <div id="sampah" class="mt-6" style="min-width: 310px; height: 400px; max-width: 600px;"></div>
                </div>
            </div>
            <!-- END: Weekly Top Seller -->
            
            <!-- BEGIN: General Report -->
            <div class="col-span-12 grid grid-cols-12 gap-6 mt-8">
                <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y">
                    <div class="mini-report-chart box p-5 zoom-in">
                        <div class="flex items-center">
                            <div class="w-2/4 flex-none">
                                <div class="text-lg font-medium truncate">Transaksi</div>
                                <div class="text-gray-600 mt-1">Masuk</div>
                            </div>
                            <div class="flex-none ml-auto relative">
                                {{-- <canvas id="report-donut-chart-1" width="90" height="90"></canvas> --}}
                                <div class="font-medium absolute w-full h-full flex items-center justify-center top-0 left-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y">
                    <div class="mini-report-chart box p-5 zoom-in">
                        <div class="flex">
                            <div class="text-lg font-medium truncate mr-3">Artikel Konten</div>
                            <div class="py-1 px-2 rounded-full text-xs bg-gray-200 text-gray-600 cursor-pointer ml-auto truncate"></div>
                        </div>
                        <div class="mt-4">
                            <canvas class="simple-line-chart-1 -ml-1" height="60"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y">
                    <div class="mini-report-chart box p-5 zoom-in">
                        <div class="flex items-center">
                            <div class="w-2/4 flex-none">
                                <div class="text-lg font-medium truncate">Penarikan</div>
                                <div class="text-gray-600 mt-1">Poin</div>
                            </div>
                            <div class="flex-none ml-auto relative">
                                {{-- <canvas id="report-donut-chart-2" width="90" height="90"></canvas> --}}
                                <div class="font-medium absolute w-full h-full flex items-center justify-center top-0 left-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y">
                    <div class="mini-report-chart box p-5 zoom-in">
                        <div class="flex">
                            <div class="text-lg font-medium truncate mr-3">Banner</div>
                            <div class="py-1 px-2 rounded-full text-xs bg-gray-200 text-gray-600 cursor-pointer ml-auto truncate"></div>/div>
                        </div>
                        <div class="mt-4">
                            <canvas class="simple-line-chart-1 -ml-1" height="60"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            
        </div>
    </div>
@endsection
<script src="https://code.highcharts.com/highcharts.js"></script>

     
    