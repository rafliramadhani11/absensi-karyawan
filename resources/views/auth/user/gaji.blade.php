<x-app-layout>
    <x-slot name="navbar">
        @include('layouts.user-navigation', ['user' => $user])
    </x-slot>

    <x-slot name="head">
        <h1 class="text-xl font-bold tracking-tight text-gray-900">
            Pemantauan Gaji
        </h1>
    </x-slot>

    <div class="bg-white rounded-md shadow-md p-6">
        <div class="overflow-hidden w-full overflow-x-auto rounded-xl">
            <table class="w-full text-left text-slate-700 dark:text-slate-300">
                <thead class="border-b border-slate-300 text-sm text-gray-900 ">
                    <tr>
                        <th scope="col" class="p-4">Bulan</th>
                        <th scope="col" class="p-4">Gaji Pokok</th>
                        <th scope="col" class="p-4">Bonus</th>
                        <th scope="col" class="p-4">Lembur</th>
                        <th scope="col" class="p-4">Potongan</th>
                        <th scope="col" class="p-4">Total Gaji</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-xs">
                    @foreach ($hadirs as $month => $value)
                        <tr>
                            <td class="p-4 text-gray-900 font-semibold">
                                {{ Carbon\Carbon::parse($month)->translatedFormat('F') }}</td>
                            <td class="p-4 text-gray-500">
                                Rp. {{ number_format($value['gajiPokok'], 0, ',', '.') }}
                            </td>
                            <td class="p-4 text-gray-500">
                                @if ($value['totalData'] == Carbon\Carbon::parse($month)->daysInMonth())
                                    Rp. {{ number_format(100000, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="p-4 text-gray-500">
                                + Rp. {{ number_format($value['bayaranLembur'], 0, ',', '.') }}
                            </td>
                            <td class="p-4 text-gray-500">
                                @if ($value['alfaIzinCount'] > 0)
                                    - Rp.
                                    {{ number_format($value['potongan'], 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="p-4 text-gray-500">
                                @if ($value['totalData'] == Carbon\Carbon::parse($month)->daysInMonth())
                                    Rp.
                                    {{ number_format($value['totalGaji'] + 100000, 0, ',', '.') }}
                                @else
                                    Rp.
                                    {{ number_format($value['totalGaji'], 0, ',', '.') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
