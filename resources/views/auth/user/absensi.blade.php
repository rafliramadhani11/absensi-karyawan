<x-app-layout>
    <x-slot name="navbar">
        @include('layouts.user-navigation', ['user' => $user])
    </x-slot>

    <x-slot name="head">
        <h1 class="text-xl font-bold tracking-tight text-gray-900">
            Absensi Pegawai
        </h1>
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
                                {{ Carbon\Carbon::parse($monthData['month'])->translatedFormat('F Y') }}
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
