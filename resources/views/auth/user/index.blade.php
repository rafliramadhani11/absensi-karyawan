<x-app-layout :user='$user'>

    <x-slot name="navbar">
        @include('layouts.user-navigation', ['user' => $user])
    </x-slot>

    <x-slot name="head">
        <h1 class="text-xl font-bold tracking-tight text-gray-900">
            Data Kehadiran
        </h1>
    </x-slot>

    <div class="bg-white rounded-md shadow-md p-6">
        <div class="overflow-hidden w-full overflow-x-auto rounded-xl">
            <table class="w-full text-left text-sm text-slate-700 dark:text-slate-300">
                <thead class="border-b border-slate-300 text-sm text-gray-900 ">
                    <tr>
                        <th scope="col" class="p-4">Tanggal</th>
                        <th scope="col" class="p-4">Waktu Datang</th>
                        <th scope="col" class="p-4">Waktu Pulang</th>
                        <th scope="col" class="p-4">Feedback</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @if ($absens->count() > 1)
                        @foreach ($absens as $absen)
                            <tr>
                                <td class="p-4 text-gray-900 font-semibold">{{ $absen->date }}</td>
                                <td class="p-4 text-gray-500">{{ $absen->waktu_datang }}</td>
                                <td class="p-4 text-gray-500">{{ $absen->waktu_pulang }}</td>
                                <td class="p-4 text-gray-500">{{ Str::words($absen->komen, 5) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="pt-5 text-center font-semibold text-red-500">
                                <h1>Data tidak ditemukan</h1>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-5 flex justify-end">
            {{ $absens->links() }}
        </div>
    </div>

</x-app-layout>
