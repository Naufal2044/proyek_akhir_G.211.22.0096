<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PENDAFTARAN KPPS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @unless($pendaftaran)
                <div class="mb-10 bg-white py-10 px-4 text-center">
                    <a href="{{ url('/pendaftaran/create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Lakukan pendaftaran
                    </a>
                </div>
            @else
                <div class="mb-10 bg-white py-10 px-4">
                    <div class="mb-6">
                        <div class="uppercase text-gray-700 text-xs font-bold mb-2">Nama Lengkap</div>
                        <div class="bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight">
                            {{ $pendaftaran->nama_lengkap }}
                        </div>
                    </div>
                    <!-- Continue with other fields... -->
                    <div class="mb-6">
                        <div class="uppercase text-gray-700 text-xs font-bold mb-2">Posisi Yang Di Inginkan</div>

                        @if($pendaftaran->prodi)
                            <div class="bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight">
                                {{ $pendaftaran->prodi->nama_prodi }}
                            </div>
                        @else
                            <div class="bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight">
                                Pilihan Prodi Tidak Tersedia
                            </div>
                        @endif
                    </div>

                    <div class="mb-6">
                        <div class="uppercase text-gray-700 text-xs font-bold mb-2">Status</div>
                        @if($pendaftaran->status=='DAFTAR')
                            <div class="bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight">
                                {{ $pendaftaran->status }}
                            </div>
                        @elseif($pendaftaran->status=='DITERIMA')
                            <div class="bg-green-500 text-white border border-gray-200 rounded py-3 px-4 leading-tight">
                                {{ $pendaftaran->status }}
                            </div>
                        @elseif($pendaftaran->status=='DITOLAK')
                            <div class="bg-red-500 text-white border border-gray-200 rounded py-3 px-4 leading-tight">
                                {{ $pendaftaran->status }}
                            </div>
                        @endif
                        <div class="text-gray-700 text-xs mb-2">Tanggal pendaftaran
                            {{ Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('Y-m-d') }}
                        </div>
                    </div>
                </div>
            @endunless
        </div>
    </div>
</x-app-layout>
