<x-app-layout>
    <x-slot name="navbar">
        @include('layouts.admin-navigation', ['admin' => $admin])
    </x-slot>

    <x-slot name="head">
        <ol class="flex flex-wrap items-center gap-2">
            <li class="flex items-center gap-2">
                <a href="{{ route('admin.index') }}"
                    class="text-xl font-bold tracking-tight text-blue-500 hover:underline">Data Pegawai</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true"
                    stroke-width="2" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </li>
            <li class="flex items-center gap-2">
                <a href="{{ route('admin.show.user', $user->slug) }}"
                    class="text-xl font-bold tracking-tight text-blue-500 hover:underline">Info Pegawai</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true"
                    stroke-width="2" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </li>
            <li class="flex items-center gap-2">
                <h1 class="text-xl font-bold tracking-tight text-gray-900">
                    Detail Absensi Pegawai
                </h1>
            </li>
        </ol>
    </x-slot>

    <div class="bg-white rounded-md shadow-md p-6">
        <div class="overflow-hidden w-full overflow-x-auto rounded-xl">
            <table class="w-full text-left text-slate-700 dark:text-slate-300">
                <thead class="border-b border-slate-300 text-sm text-gray-900 ">
                    <tr>
                        <th scope="col" class="p-4">Bulan</th>
                        <th scope="col" class="p-4">Hadir</th>
                        <th scope="col" class="p-4">Izin</th>
                        <th scope="col" class="p-4">Alfa</th>
                        <th scope="col" class="p-4">Total Masuk</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 text-xs">
                    @foreach ($monthsData as $monthData)
                        <tr>
                            <td class="p-4 text-gray-900 font-semibold">
                                {{ Carbon\Carbon::parse($monthData['month'])->translatedFormat('F') }}
                            </td>
                            <td class="p-4 text-gray-500 ">{{ $monthData['countHadir'] }}</td>
                            <td class="p-4 text-gray-500">{{ $monthData['countIzin'] }}</td>
                            <td class="p-4 text-gray-500">{{ $monthData['countAlfa'] }}</td>
                            <td class="p-4 text-gray-500">
                                {{ $monthData['totalMasuk'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
