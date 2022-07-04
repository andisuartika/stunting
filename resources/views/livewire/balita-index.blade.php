<div>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Balita
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-5">
            <!-- BEGIN: Balita-->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Informasi Balita
                    </h2>
                </div>
                <div class="p-5" id="basic-datepicker">
                    <div class="preview">
                            <div class="">
                                <label class="flex flex-col sm:flex-row"> Cari Balita</label>
                                <div class="flex items-stretch mt-2">
                                    <div class="relative w-full">
                                        <div class="relative">
                                            <input 
                                            placeholder="Cari Berdasarkan NIK atau Nama..."
                                            wire:model="query"
                                            wire:click="reset"
                                            wire:keydown.enter.prevent="selectPeserta"
                                            type="text"
                                            class="input w-full border " required>
                                            @if ($query)
                                            <div wire:click="reset" class="tooltip w-4 h-4 absolute my-auto inset-y-0 right-0 mr-3 cursor-pointer" title="Reset">✖</div> 
                                            @endif
                                        </div> 
                                        @if(!empty($query) && $selectedBayi == 0 && $showDropdown)
                                            <div class="absolute z-10  mt-1  w-full p-3 bg-white right-0 shadow-lg">
                                                @if (!empty($bayis))
                                                    @foreach($bayis as $i => $peserta)
                                                    <div class="dropdown-box__content box">
                                                        <a
                                                            wire:click="selectBayi({{ $peserta['pesertaID'] }})"
                                                            class="flex items-center p-2 cursor-pointer transition duration-300 ease-in-out bg-white hover:bg-indigo-600 hover:text-white rounded-md"
                                                        >{{ $peserta['NIK'] }} - {{ $peserta['nama'] }}</a>
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <span class="block py-1 px-2 text-sm">Data Tidak Ditemukan!</span>
                                                @endif
                                            </div>
                                        @endif
                                        <button wire:click="addData" class="focus:ring-2 focus:ring-offset-2 rounded-md focus:ring-indigo-600 absolute right-0 top-0 transition duration-150 ease-in-out hover:bg-indigo-900 focus:outline-none bg-theme-3 rounded-r text-white px-5 h-10 text-sm">Data Baru</button>
                                    </div>
                                </div>   
                            </div>
                            @if ($dataBaru)
                            <div class="mt-3">
                                <label class="flex flex-col sm:flex-row"> Ibu Balita</label>
                                <div class="flex items-stretch">
                                    <div class="relative w-full">
                                        <div class="relative">
                                            <input 
                                            placeholder="Cari Berdasarkan NIK atau Nama..."
                                            wire:model="queryIbu"
                                            wire:click="reset"
                                            wire:keydown.enter.prevent="selectPeserta"
                                            type="text"
                                            class="input w-full border " required>
                                        </div> 
                                        @if(!empty($queryIbu) && $selectedIbu == 0 && $showDropdown)
                                            <div class="absolute z-10  mt-1  w-full p-3 bg-white right-0 shadow-lg">
                                                @if (!empty($ibus))
                                                    @foreach($ibus as $i => $peserta)
                                                    <div class="dropdown-box__content box">
                                                        <a
                                                            wire:click="selectIbu({{ $peserta['pesertaID'] }})"
                                                            class="flex items-center p-2 cursor-pointer transition duration-300 ease-in-out bg-white hover:bg-indigo-600 hover:text-white rounded-md"
                                                        >{{ $peserta['NIK'] }} - {{ $peserta['nama'] }}</a>
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <span class="block py-1 px-2 text-sm">Data Tidak Ditemukan!</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>   
                                @error('queryIbu') <span class="text-red-600">{{ $message }}</span> @enderror
                            </div>    
                            @endif     
                            @if ($showDataBayi)
                                <form wire:submit.prevent="submitBayi" enctype="multipart/form-data">
                                    <div class="mt-3">
                                        <label class="flex flex-col sm:flex-row"> Nama <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Nama Balita</span> </label>
                                        <input wire:model.defer="namaBalita" type="text" name="nama" class="input w-full border" placeholder="Nama Balita" value="{{ $namaBalita }}" required>
                                        @error('namaBalita') <span class="text-red-600">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label class="flex flex-col sm:flex-row"> NIK <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, NIK sesuai dengan KK</span> </label>
                                        <input wire:model.defer="NIKBalita" type="number" name="NIKBalita" class="input w-full border" placeholder="Nomor Induk Kependudukan"  required>
                                    </div>
                                    <div class="mt-3">
                                        <label class="flex flex-col sm:flex-row"> Tanggal Lahir <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Tangal Lahir Ibu</span> </label>
                                        <input wire:model.defer="tglLahirBalita" data-timepicker="true" type="date" name="date" class="input  w-full border" placeholder="MM/DD/YYYY" required>
                                    </div>
                                    <div class="mt-3"> <label>Jenis Kelamin</label>
                                        <div class="flex flex-col sm:flex-row mt-2">
                                            <div class="flex items-center text-gray-700 mr-2"> 
                                                <input wire:model="JKBalita" type="radio" class="input border mr-2" id="laki-lai" name="horizontal_radio_button" value="L"> 
                                                <label class="cursor-pointer select-none" for="jenis-kelamin">Laki-laki</label> 
                                            </div>
                                            <div class="flex items-center text-gray-700 mr-2"> 
                                                <input wire:model="JKBalita" type="radio" class="input border mr-2" id="perempuan" name="horizontal_radio_button" value="P"> 
                                                <label class="cursor-pointer select-none" for="jenis-kelamin">Perempuan</label> 
                                            </div>
                                        </div>
                                        @error('JKBalita') <span class="text-red-600">{{ $message }}</span> @enderror
                                    </div>
                                    <div  class="mt-3">
                                        <label class="flex flex-col sm:flex-row"> Upload Kartu Identitas Anak <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, JPG | JPEG | PNG</span> </label>
                                        <input wire:model="file" class="input  w-full border" type="file">
                                        @error('file') <span class="text-red-600">{{ $message }}</span> @enderror
                                        @if ($urlFile)
                                            <span class="text-theme-3 my-3"><a target="_blank" href="{{ $urlFile }}">Lihat Kartu Identitas Anak</a></span>
                                        @endif
                                        
                                    </div>
        
                                    <div class="text-right">
                                        
                                        <button type="submit" class="flex button px-5 py-3 bg-purple text-white mt-5 ml-auto">
                                            <div  wire:loading wire:target="submitBayi">
                                                <svg class="mr-3 h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </div>  
                                            Simpan Data Balita
                                        </button>
                                        
                                    </div>
                                </form>
                            @endif
                    </div>
                </div>
            </div>
            <!-- BEGIN: Ibu-->
            @if ($showDataBayi)
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Informasi Ibu
                    </h2>
                </div>
                
                <div class="p-5" id="basic-datepicker">
                    <div class="preview">
                            
                            <div>
                                <label class="flex flex-col sm:flex-row"> Nama Ibu </label>
                                <input wire:model.defer="namaIbu" type="text" name="NIK" class="input w-full border mt-2" placeholder="Nama Ibu"  disabled>
                            </div>
                            <div class="mt-3">
                                <label class="flex flex-col sm:flex-row"> NIK Ibu </label>
                                <input wire:model.defer="NIKIbu" type="number" name="NIK" class="input w-full border mt-2" placeholder="Nomor Induk Kependudukan"  disabled>
                            </div>
                            <div class="mt-3">
                                <label class="flex flex-col sm:flex-row"> Tanggal Lahir Ibu </label>
                                <input wire:model.defer="tglLahirIbu" data-timepicker="true" type="date" name="date" class="input  w-full border" placeholder="MM/DD/YYYY" disabled>
                            </div>
                    </div>
                </div>
            </div>
            @endif
            
        </div>
        <div class="intro-y col-span-12 lg:col-span-7">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Balita-->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Kesehatan Balita
                    </h2>
                </div>
                <div class="p-5" id="basic-datepicker">
                    <div class="preview">
                        <form wire:submit.prevent="store" enctype="multipart/form-data">
                            @csrf 
                            <div class="mt-2"> 
                                <label class="flex flex-col sm:flex-row"> Periode Periksa </label>
                                <select wire:model="periode" class="input border mr-2 w-full" 
                                @if (!$idBalita)
                                disabled
                                @endif>
                                    <option value="">--- Pilih Periode Periksa ---</option>
                                    <option value="1" class="py-3">Bulan Januari</option>
                                    <option value="2" class="py-3">Bulan Februari</option>
                                    <option value="3" class="py-3">Bulan Maret</option>
                                    <option value="4" class="py-3">Bulan April</option>
                                    <option value="5" class="py-3">Bulan Mei</option>
                                    <option value="6" class="py-3">Bulan Juni</option>
                                    <option value="7" class="py-3">Bulan Juli</option>
                                    <option value="8" class="py-3">Bulan Agustus</option>
                                    <option value="9" class="py-3">Bulan September</option>
                                    <option value="10" class="py-3">Bulan Oktober</option>
                                    <option value="11" class="py-3">Bulan November</option>
                                    <option value="12" class="py-3">Bulan Desember</option>
                                </select> 
                                @error('periode') <span class="text-red-600">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-3"> 
                                <label class="flex flex-col sm:flex-row"> Posyandu </label>
                                <select wire:model.defer="posyandu" class="input border mr-2 w-full"
                                @if (!$idBalita)
                                disabled
                                @endif>
                                    <option value="">--- Pilih Periode Periksa ---</option>
                                    @foreach ($posyandus as $p)
                                        <option value="{{ $p->posyanduID}}" class="py-3">{{ $p->namaPosyandu}}</option>
                                    @endforeach
                                </select> 
                                @error('posyandu') <span class="text-red-600">{{ $message }}</span> @enderror
                            </div>
                            @if ($periode)
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Umur <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Umur Balita</span> </label>
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="umurBalita" type="number" name="umur" class="input pr-12 w-full border col-span-4"  required>
                                    <div class="absolute top-0 right-0 rounded-r w-16 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Bulan</div>
                                </div>
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Berat Badan <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Berat Balita</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="beratBalita" type="number" class="input pr-12 w-full border col-span-4" required>
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Kg</div>
                                </div>
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Panjang Badan <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Panjang Badan Balita</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="panjangBalita" type="number" class="input pr-12 w-full border col-span-4" required>
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Cm</div>
                                </div>
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Lingkar Kepala <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Lingkar Kepala Balita</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="lingkarKepalaBalita" type="number" class="input pr-12 w-full border col-span-4" required>
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Cm</div>
                                </div>
                                <div class="mt-3"> 
                                    <label>Asi Ekslusif</label>
                                    <div class="flex items-center text-gray-700 mt-2"> 
                                        <input wire:model.defer="asiEkslusif" type="checkbox" class="input border mr-2" id="asi-ekslusif" value="true"> 
                                        <label class="cursor-pointer select-none" for="asi-ekslusif">Ya</label> 
                                    </div>
                                </div>
                                <div class="mt-3"> 
                                    <label class="flex flex-col sm:flex-row">Imunisasi <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Jenis Imunisasi</span>
                                    </label>
                                    <div class="mt-2"> 
                                        <select wire:model.defer="imunisasi" class="input border mr-2 w-full">
                                            <option value="">--- Pilih Jenis Imunisasi ---</option>
                                            @foreach ($imunisasis as $imu)
                                                    <option value="{{ $imu->imunisasiID }}">{{ $imu->imunisasi }}</option>
                                            @endforeach
                                        </select> 
                                        @error('imunisasi') <span class="text-red-600">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="text-right">
                                    @if($idBalita)
                                    <button type="submit" class="button bg-purple px-5 py-3 text-white mt-5 ml-auto">Simpan Data Periksa</button>
                                    @else
                                        <a href="javascript:;" class="tooltip button inline-block px-5 py-3 bg-gray-600 mt-5 text-white" title="Silahkan masukkan data calon Ibu terlebih dahulu!">Simpan Data Periksa</a>
                                    @endif
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
                
            </div>
        </div>
    </div>
</div>
