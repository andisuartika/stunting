<div>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Calon Ibu
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-5">
            <!-- BEGIN: Calon Ibu-->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Informasi Calon Ibu
                    </h2>
                </div>
                <div class="p-5">
                    <div class="preview">   
                            <div class="">
                                <label class="flex flex-col sm:flex-row"> Cari Calon Ibu</label>
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
                                        @if(!empty($query) && $selectedPeserta == 0 && $showDropdown)
                                            <div class="absolute z-10  mt-1  w-full p-3 bg-white right-0 shadow-lg">
                                                @if (!empty($pesertas))
                                                    @foreach($pesertas as $i => $peserta)
                                                    <div class="dropdown-box__content box">
                                                        <a
                                                            wire:click="selectPeserta({{ $peserta['pesertaID'] }})"
                                                            class="flex items-center p-2 cursor-pointer transition duration-300 ease-in-out bg-white hover:bg-indigo-600 hover:text-white rounded-md"
                                                        >{{ $peserta['NIK'] }} - {{ $peserta['nama'] }}</a>
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <span class="block py-1 px-2 text-sm">Data Tidak Ditemukan!</span>
                                                @endif
                                            </div>
                                        @endif
                                        <button wire:click="resetForm" class="focus:ring-2 focus:ring-offset-2 rounded-md focus:ring-indigo-600 absolute right-0 top-0 transition duration-150 ease-in-out hover:bg-indigo-900 focus:outline-none bg-theme-3 rounded-r text-white px-5 h-10 text-sm">Data Baru</button>
                                    </div>
                                </div>   
                            </div>                  
                            @if($showDataPeserta)
                            <form wire:submit.prevent="submitPeserta" enctype="multipart/form-data">
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Nama <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Nama Calon Ibu</span> </label>
                                    <input wire:model.defer="nama" type="text" name="nama" class="input w-full border mt-2" placeholder="Nama Calon Ibu" value="{{ $nama }}">
                                    @error('nama') <span class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> NIK <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, NIK sesuai dengan KTP</span> </label>
                                    <input wire:model.defer="nik" type="number" name="nik" class="input w-full border mt-2" placeholder="Nomor Induk Kependudukan" value="{{ $nik }}" >
                                    @error('nik') <span class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Tanggal Lahir <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Tangal Lahir calon Ibu</span> </label>
                                    <input wire:model.defer="tglLahir" data-timepicker="true" type="date" name="date" class="input  w-full border" placeholder="MM/DD/YYYY" \>
                                    @error('tglLahir') <span class="text-red-600">{{ $message }}</span> @enderror
                                </div>
                                <div  class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Upload Kartu Keluarga <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, JPG | JPEG | PNG</span> </label>
                                    <input wire:model="file" class="input  w-full border" type="file">
                                    @error('file') <span class="text-red-600">{{ $message }}</span> @enderror
                                    @if ($urlFile)
                                        <span class="text-theme-3 my-3"><a target="_blank" href="{{ $urlFile }}">Lihat Kartu Keluarga</a></span>
                                    @endif
                                    
                                </div>

                                <div class="text-right">
                                    
                                    <button type="submit" class="flex button px-5 py-3 bg-purple text-white mt-5 ml-auto">
                                        <div  wire:loading wire:target="submitPeserta">
                                            <svg class="mr-3 h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </div>  
                                        Simpan Data Calon Ibu
                                    </button>
                                    
                                </div>
                                
                            </form>                            
                            @endif
                    </div>
                </div>
            </div>
            <!-- END: Form Validation -->
        </div>
        <div class="intro-y col-span-12 lg:col-span-7">
            <!-- BEGIN: Calon Ibu-->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Kesehatan Calon Ibu
                    </h2>
                </div>
                <div class="p-5" id="basic-datepicker">
                    <div class="preview">
                        <form wire:submit.prevent="store" enctype="multipart/form-data">
                            @csrf                       
                            <div class="mt-2"> 
                                <label class="flex flex-col sm:flex-row"> Periode Periksa </label>
                                <select wire:model="periode" class="input border mr-2 w-full" 
                                @if (!$idPeserta)
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
                                <select wire:model.defer="posyanduID" class="input border mr-2 w-full"
                                @if (!$idPeserta)
                                disabled
                                @endif>
                                    <option value="">--- Pilih Posyandu ---</option>
                                    @foreach ($posyandu as $p)
                                        <option value="{{ $p->posyanduID}}" class="py-3">{{ $p->namaPosyandu}}</option>
                                    @endforeach
                                </select> 
                                @error('posyanduID') <span class="text-red-600">{{ $message }}</span> @enderror
                            </div>
                            @if($periode)
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Umur <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Umur Calon Ibu</span> </label>
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="umur" type="number" name="umur" class="input pr-12 w-full border col-span-4" value="{{ $umur }}"  required>
                                    <div class="absolute top-0 right-0 rounded-r w-16 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Tahun</div>
                                    
                                </div>
                                @error('umur') <span class="text-red-600">{{ $message }}</span> @enderror
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Berat Badan <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Berat Calon Ibu</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="beratBadan" type="number" class="input pr-12 w-full border col-span-4" required>
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Kg</div>
                                </div>
                                @error('beratBadan') <span class="text-red-600">{{ $message }}</span> @enderror
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Tinggi Badan <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Tinggi Calon Ibu</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="tinggiBadan" type="number" class="input pr-12 w-full border col-span-4" required>
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Cm</div>
                                </div>
                                @error('tinggiBadan') <span class="text-red-600">{{ $message }}</span> @enderror
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Lingkar Pinggang <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Lingkar Pinggang Calon Ibu</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="lingkarPinggang" type="number" class="input pr-12 w-full border col-span-4" required>
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Cm</div>
                                </div>
                                @error('lingkarPinggang') <span class="text-red-600">{{ $message }}</span> @enderror
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Lingkar Bokong <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Lingkar Bokong Calon Ibu</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="lingkarBokong" type="number" class="input pr-12 w-full border col-span-4" required>
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Cm</div>
                                </div>
                                @error('lingkarBokong') <span class="text-red-600">{{ $message }}</span> @enderror
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Lingkar Lengan <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Lingkar Lengan Calon Ibu</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="lingkarLengan" type="number" class="input pr-12 w-full border col-span-4" required>
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Cm</div>
                                </div>
                                @error('lingkarLengan') <span class="text-red-600">{{ $message }}</span> @enderror
                                
                                <div class="text-right">
                                    @if($idPeserta)
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
            <!-- END: Form Validation -->
        </div>
    </div>
</div>

@section('scripts')

    {{-- FILEPOND | UPLOAD FILE --}}
    <script>
        // Get a file input reference
        const inputElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create( inputElement );
        FilePond.setOptions({
        server: {
            url: '/ibu',
            headers : {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
    {{-- FILEPOND | UPLOAD FILE --}}
 
    </script>

@endsection
