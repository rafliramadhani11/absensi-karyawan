<x-app-layout title="Absensi">
    <x-slot name="navbar">
        @include('layouts.admin-navigation', ['admin' => $admin])
    </x-slot>

    <x-slot name="head">
        <h1 class="text-xl font-bold tracking-tight text-gray-900">
            Absensi Pegawai
        </h1>
    </x-slot>

    {{-- SESSION UPDATE ABSENSI --}}
    @if (session()->has('updateAbsenPegawai'))
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
            class="relative w-full mb-6 overflow-hidden sm:rounded-md border border-green-600 bg-white text-slate-700 "
            role="alert" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="flex w-full items-center gap-2 bg-green-600/10 py-3 px-4">
                <div class="bg-green-600/15 text-green-600 rounded-full p-1" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-2">
                    <p class="font-semibold text-sm">Update Info</p>
                    <p class="text-xs">{{ session('updateAbsenPegawai') }}
                    </p>
                </div>
                <button type="button" @click="alertIsVisible = false" class="ml-auto" aria-label="dismiss alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                        fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-md shadow-md p-6 col-span-2">
        <h1 class="text-xl font-bold tracking-tight px-4 mb-4 text-gray-900">
            {{ Carbon\Carbon::parse($date)->translatedFormat('l, j F Y') }}
        </h1>


        <div class="w-full overflow-auto rounded-xl ">
            <table class="w-full text-left text-xs text-slate-700 ">
                <thead class="border-b border-slate-300 text-sm text-black ">
                    <tr>
                        <th scope="col" class="p-4">Pegawai</th>
                        <th scope="col" class="p-4">Waktu Datang</th>
                        <th scope="col" class="p-4">Waktu Pulang</th>
                        <th scope="col" class="p-4">Status</th>
                        <th scope="col" class="p-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-300 ">

                    @if ($hadirs->count() == 0)
                        <td class="pt-4 font-semibold text-red-500 text-center" colspan="5">
                            Belum ada karyawan yang absen
                        </td>
                    @endif

                    @foreach ($hadirs as $hadir)
                        <tr>
                            <td class="p-4">
                                <div class="flex w-max items-center gap-2">
                                    <div class="flex flex-col">
                                        <span class="text-black ">
                                            {{ $hadir->user->name }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">{{ $hadir->waktu_datang ?? '' }}</td>
                            <td class="p-4">{{ $hadir->waktu_pulang ?? '' }}</td>
                            <td class="p-4">
                                @if ($hadir->status == 'Hadir')
                                    <div class="mt-1 flex items-center gap-x-1.5">
                                        <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                                            <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"></div>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-500">Hadir</p>
                                    </div>
                                @elseif ($hadir->status == 'Izin')
                                    <div class="mt-1 flex items-center gap-x-1.5">
                                        <div class="flex-none rounded-full bg-amber-500/20 p-1">
                                            <div class="h-1.5 w-1.5 rounded-full bg-amber-500"></div>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-500">Izin</p>
                                    </div>
                                @else
                                    <div class="mt-1 flex items-center gap-x-1.5">
                                        <div class="flex-none rounded-full bg-red-500/20 p-1">
                                            <div class="h-1.5 w-1.5 rounded-full bg-red-500"></div>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-500">Alfa</p>
                                    </div>
                                @endif
                            </td>
                            <td class="p-4">
                                <a href="{{ route('admin.user.absensi.detail', $hadir->id) }}"
                                    class="cursor-pointer whitespace-nowrap rounded-xl bg-transparent p-0.5 font-semibold text-blue-700 outline-blue-700 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 ">Detail</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>


    </div>

</x-app-layout>
