<div>
    <!-- BEGIN: Datatable -->
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2  whitespace-no-wrap">NIK</th>
                    <th class="border-b-2  whitespace-no-wrap">Nama</th>
                    <th class="border-b-2  whitespace-no-wrap">Nama Ibu</th>
                    <th class="border-b-2  whitespace-no-wrap">Tanggal Lahir</th>
                    <th class="border-b-2  text-center whitespace-no-wrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataBalita as $balita )
                <tr>
                    <td class="border-b">
                        <div class="flex sm:justify-left">
                            <div class="font-medium whitespace-no-wrap">
                            @if ($balita->NIK )
                            {{ $balita->NIK }}
                            @else
                                -
                            @endif</div>                               
                        </div>
                    </td>
                    <td class="text-center border-b">
                        <div class="flex sm:justify-left">
                            <div class="font-medium whitespace-no-wrap">{{ $balita->nama }}</div>                               
                        </div>
                    </td>
                    <td class="border-b">{{ $balita->ibu()->get()->implode('nama')}}</td>
                    <td class="border-b">{{ $balita->tanggalLahir }}</td>
                    <td class="border-b">
                        <div class="flex sm:justify-center items-center">
                            <a href="" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-3 text-white"> <i data-feather="file-text" class="w-4 h-4 mr-2 text-white"></i> Detail </a>
                        </div>
                    </td>
                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
    <!-- END: Datatable -->
</div>
