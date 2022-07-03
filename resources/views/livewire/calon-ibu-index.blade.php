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
                                    <input wire:model.defer="nik" type="nik" name="nik" class="input w-full border mt-2" placeholder="Nomor Induk Kependudukan" value="{{ $nik }}" >
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
                                    
                                    @if($isLoading)  
                                        <button class="button bg-theme-3 text-white mt-5 ml-auto cursor-wait">Proses Simpan Data...</button>
                                    @else
                                        <button type="submit" class="button bg-theme-3 text-white mt-5 ml-auto">Simpan Data Calon Ibu</button>
                                    @endif
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
                            <div class="mt-2"> 
                                <label class="flex flex-col sm:flex-row"> Posyandu </label>
                                <select wire:model="posyanduID" class="input border mr-2 w-full">
                                    <option value="">--- Pilih Periode Periksa ---</option>
                                    @foreach ($posyandu as $p)
                                        <option value="{{ $p->posyanduID}}" class="py-3">{{ $p->namaPosyandu}}</option>
                                    @endforeach
                                </select> 
                            </div>
                            <div class="mt-3"> 
                                <label class="flex flex-col sm:flex-row"> Periode Periksa </label>
                                <select wire:model="periode" class="input border mr-2 w-full">
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
                            </div>
                            @if($periode)
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Umur <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Umur Calon Ibu</span> </label>
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="umur" type="number" name="umur" class="input pr-12 w-full border col-span-4"  required>
                                    <div class="absolute top-0 right-0 rounded-r w-16 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Tahun</div>
                                </div>
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Berat Badan <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Berat Calon Ibu</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="beratBadan" type="text" class="input pr-12 w-full border col-span-4">
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Kg</div>
                                </div>
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Tinggi Badan <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Tinggi Calon Ibu</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="tinggiBadan" type="text" class="input pr-12 w-full border col-span-4">
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Cm</div>
                                </div>
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Lingkar Pinggang <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Lingkar Pinggang Calon Ibu</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="lingkarPinggang" type="text" class="input pr-12 w-full border col-span-4">
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Cm</div>
                                </div>
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Lingkar Bokong <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Lingkar Bokong Calon Ibu</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="lingkarBokong" type="text" class="input pr-12 w-full border col-span-4">
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Cm</div>
                                </div>
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Lingkar Lengan <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Lingkar Lengan Calon Ibu</span> </label>                               
                                </div>
                                <div class="relative"> 
                                    <input wire:model.defer="lingkarLengan" type="text" class="input pr-12 w-full border col-span-4">
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Cm</div>
                                </div>
                                
                                <div class="text-right">
                                    @if($idPeserta)
                                        <button wire:click="store" class="button bg-theme-3 text-white mt-5 ml-auto">Simpan Data Periksa</button>
                                    @else
                                        <a href="javascript:;" class="tooltip button inline-block bg-gray-600 mt-5 text-white" title="Silahkan masukkan data calon Ibu terlebih dahulu!">Simpan Data Periksa</a>
                                    @endif
                                </div>
                            @endif
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
