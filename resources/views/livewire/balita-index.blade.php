<div>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Balita
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-5">
            <!-- BEGIN: Calon Ibu-->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Informasi Ibu
                    </h2>
                </div>
                <div class="p-5" id="basic-datepicker">
                    <div class="preview">
                            <div wire:ignore> 
                                <label class="flex flex-col sm:flex-row">Nama <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Nama Ibu</span>
                                </label>
                                <div class="mt-2"> 
                                    <select wire:model="nama"  wire:change="getBayiByIbu" id="select2"  name="nama" class="select2 hover:bg-theme-3 block w-full border mt-2">
                                        <option value="0">Pilih Ibu</option>
                                        @foreach ($ibu as $i)
                                            <option value="{{ $i->pesertaID }}">{{ $i->nama }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="flex flex-col sm:flex-row"> NIK <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, NIK sesuai dengan KTP</span> </label>
                                <input wire:model.defer="NIK" type="number" name="NIK" class="input w-full border mt-2" placeholder="Nomor Induk Kependudukan"  required>
                            </div>
                            <div class="mt-3">
                                <label class="flex flex-col sm:flex-row"> Tanggal Lahir <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Tangal Lahir Ibu</span> </label>
                                <input wire:model.defer="tglLahir" data-timepicker="true" type="date" name="date" class="input  w-full border" placeholder="MM/DD/YYYY" required>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="intro-y col-span-12 lg:col-span-7">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Balita-->
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                            Informasi Balita
                        </h2>
                    </div>
                    <div class="p-5" id="basic-datepicker">
                        <div class="preview">
                                <div> 
                                    <label class="flex flex-col sm:flex-row">Nama <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Nama Ibu</span>
                                    </label>
                                    <div class="mt-2"> 
                                        <select wire:model="balita" id="balita"  name="balita" class="select2 select_balita hover:bg-theme-3 block w-full border mt-2">
                                            <option value="0">Balita</option>
                                            {{-- @foreach ($bayi as $b)
                                                <option value="{{ $b->pesertaID }}">{{ $b->peserta()->get()->implode('nama') }}</option>
                                            @endforeach --}}
                                        </select> 
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> NIK <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, NIK sesuai dengan KK</span> </label>
                                    <input wire:model.defer="NIKBalita" type="number" name="NIKBalita" class="input w-full border mt-2" placeholder="Nomor Induk Kependudukan"  required>
                                </div>
                                <div class="mt-3">
                                    <label class="flex flex-col sm:flex-row"> Tanggal Lahir <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Tangal Lahir Ibu</span> </label>
                                    <input wire:model.defer="tglLahirBalita" data-timepicker="true" type="date" name="date" class="input  w-full border" placeholder="MM/DD/YYYY" required>
                                </div>
                                <div class="mt-3"> <label>Jenis Kelamin</label>
                                    <div class="flex flex-col sm:flex-row mt-2">
                                        <div wire:model="JKBalita" class="flex items-center text-gray-700 mr-2"> 
                                            <input type="radio" class="input border mr-2" id="laki-lai" name="horizontal_radio_button" value="L"> 
                                            <label class="cursor-pointer select-none" for="jenis-kelamin">Laki-laki</label> 
                                        </div>
                                        <div wire:model="JKBalita"  class="flex items-center text-gray-700 mr-2"> 
                                            <input type="radio" class="input border mr-2" id="perempuan" name="horizontal_radio_button" value="P"> 
                                            <label class="cursor-pointer select-none" for="jenis-kelamin">Perempuan</label> 
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BEGIN: Balita-->
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Kesehatan Balita
                    </h2>
                </div>
                <div class="p-5" id="basic-datepicker">
                    <div class="preview">
                            <div>
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
                                <input wire:model.defer="beratBalita" type="text" class="input pr-12 w-full border col-span-4">
                                <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Kg</div>
                            </div>
                            <div class="mt-3">
                                <label class="flex flex-col sm:flex-row"> Panjang Badan <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Panjang Badan Balita</span> </label>                               
                            </div>
                            <div class="relative"> 
                                <input wire:model.defer="panjangBalita" type="text" class="input pr-12 w-full border col-span-4">
                                <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Cm</div>
                            </div>
                            <div class="mt-3">
                                <label class="flex flex-col sm:flex-row"> Lingkar Kepala <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Lingkar Kepala Balita</span> </label>                               
                            </div>
                            <div class="relative"> 
                                <input wire:model.defer="lingkarKepalaBalita" type="text" class="input pr-12 w-full border col-span-4">
                                <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">Cm</div>
                            </div>
                            <div class="mt-3"> 
                                <label>Asi Ekslusif</label>
                                <div class="flex items-center text-gray-700 mt-2"> 
                                    <input wire:model="asiEkslusif" type="checkbox" class="input border mr-2" id="asi-ekslusif" value="true"> 
                                    <label class="cursor-pointer select-none" for="asi-ekslusif">Ya</label> 
                                </div>
                            </div>
                            <div class="mt-3"> 
                                <label class="flex flex-col sm:flex-row">Imunisasi <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Required, Jenis Imunisasi</span>
                                </label>
                                <div wire:ignore class="mt-2"> 
                                    <select wire:model="imunisasi" id="imunisasi"  name="imunisasi" class="select2 hover:bg-theme-3 block w-full border mt-2">
                                        <option value="0">Pilih Jenis Imunisasi</option>
                                        @foreach ($imunisasis as $imu)
                                                <option value="{{ $imu->imunisasiID }}">{{ $imu->imunisasi }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="text-right">
                                <button wire:click="store" class="button bg-theme-3 text-white mt-5 ml-auto">Simpan</button>
                            </div>
                    </div>
                </div>
            </div>
            <!-- END: Form Validation -->
        </div>
    </div>
</div>

@section('scripts')

<script>
            
    $(document).ready(function() {
    $('#select2').select2({
        tags: true
    });
    $('#select2').on('change', function (e) {
        @this.nama  = $(this).val();
        livewire.emit('getBayiByIbu');
    });

});
</script>

<script>
    $(document).ready(function() {
        $('#balita').select2({
            tags: true
        });
        $('#balita').on('change', function (e) {
            @this.balita  = $(this).val();
        });
    });
    
</script>

<script>
            
    $(document).ready(function() {
    $('#imunisasi').select2({
        tags: true
    });
    $('#imunisasi').on('change', function (e) {
        @this.imunisasi  = $(this).val();
        
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>

<script>
    new Pikaday({
        field: document.getElementById('tglLahir'),
        format: 'MM/DD/YYYY'
    })
</script>

@endsection