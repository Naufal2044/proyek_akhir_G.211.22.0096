<x-app-layout>
 <x-slot name="header">
 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 {{ __('Dashboard') }}
 </h2>
 </x-slot>
 <div class="py-12">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
 <div class="mb-5 bg-white">
 <div class="border rounded-b px-4
 py-3">
 <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 
 dark:text-white">{{ $daftar}}</h5>
 <p class="font-normal text-gray-700 mb-4">
 Jumlah Peserta yang belum direspon.</p>
 <a href="{{ url('/pendaftaran') }}" class="items-center px-3 py-2 
 text-sm font-medium text-center text-white bg-blue-500 
 rounded-lg hover:bg-blue-700 focus:ring-4 
 focus:outline-none focus:ring-blue-300">
 Kelola Pendaftaran
 </a>
 </div>
 </div>
 <div class="mb-5 w-full flex">
 <div class="border rounded-b px-4 w-1/2 bg-white mx-2
 py-3">
 <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 
 dark:text-white">{{ number_format($terima) }}</h5>
 <p class="font-normal text-gray-700">
 Peserta diterima dalam bulan terakhir</p>
 </div>
 <div class="border rounded-b px-4 w-1/2 bg-white mx-2
 py-3">
 <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 
 dark:text-white">{{ number_format($tidak_diterima) }}</h5>
 <p class="font-normal text-gray-700">
 Peserta diterima dalam bulan terakhir</p>
 </div>
 </div>
 </div>
 </div>
</x-app-layout>