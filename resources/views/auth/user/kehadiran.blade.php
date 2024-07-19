<x-app-layout :user='$user'>

    <x-slot name="navbar">
        @include('layouts.user-navigation', ['user' => $user])
    </x-slot>

    <x-slot name="head">
        <h1 class="text-xl font-bold tracking-tight text-gray-900">
            Data Kehadiran
        </h1>
    </x-slot>

    <div id="reader"></div>

    {{-- PESAN STATUS ALFA --}}
    @if ($showAlfaMessage)
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
            class="relative w-full overflow-hidden rounded-xl border border-amber-500 bg-white text-slate-700 mt-6"
            role="alert" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="flex w-full items-center gap-2 bg-amber-500/10 p-4">
                <div class="bg-amber-500/15 text-amber-500 rounded-full p-1" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-2">
                    <h3 class="text-sm font-semibold text-amber-500">Info Kehadiran</h3>
                    <p class="text-xs font-medium sm:text-sm">Anda tidak hadir hari ini</p>
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
    {{-- PESAN IZIN --}}
    @if ($showIzinMessage)
        <div class="p-4 my-6 text-sm font-semibold bg-white rounded-md shadow-md" role="alert">
            Terimakasih sudah memberikan keterangan izin hari ini.
        </div>
    @endif
    {{-- SELESAI ABSEN --}}
    @if (session()->has('succesedAbsen'))
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
            class="relative w-full overflow-hidden rounded-md shadow-md border border-green-600 bg-white text-slate-700 mt-6"
            role="alert" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="flex w-full items-center gap-2 bg-green-600/10 p-4">
                <div class="bg-green-600/15 text-green-600 rounded-full p-1" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-2">
                    <h3 class="text-sm font-semibold text-green-600">Berhasil Presensi</h3>
                    <p class="text-xs font-medium sm:text-sm">{{ session('succesedAbsen') }}
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
    {{-- SELESAI PULANG --}}
    @if (session()->has('sucessedPulang'))
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
            class="relative w-full overflow-hidden rounded-md shadow-md border border-green-600 bg-white text-slate-700 mt-6"
            role="alert" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="flex w-full items-center gap-2 bg-green-600/10 p-4">
                <div class="bg-green-600/15 text-green-600 rounded-full p-1" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-2">
                    <h3 class="text-sm font-semibold text-green-600">Berhasil Presensi</h3>
                    <p class="text-xs font-medium sm:text-sm">{{ session('sucessedPulang') }}
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
    {{-- GAGAL ABSEN --}}
    @if (session()->has('absenFailed'))
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
            class="relative w-full overflow-hidden rounded-md shadow-md border border-red-600 bg-white text-slate-700 mt-6"
            role="alert" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="flex w-full items-center gap-2 bg-red-600/10 p-4">
                <div class="bg-red-600/15 text-red-600 rounded-full p-1" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-2">
                    <h3 class="text-sm font-semibold text-red-600">Gagal Melakukan Kehadiran</h3>
                    <p class="text-xs font-medium sm:text-sm">{{ session('absenFailed') }}
                    </p>
                </div>
                <button type="button" @click="alertIsVisible = false" class="ml-auto" aria-label="dismiss alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                        stroke="currentColor" fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
    {{-- GAGAL HADIR ULANG --}}
    @if (session()->has('failedHadirAgain'))
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
            class="relative w-full overflow-hidden shadow-md rounded-md border border-amber-500 bg-white text-slate-700 mt-6"
            role="alert" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="flex w-full items-center gap-2 bg-amber-500/10 p-4">
                <div class="bg-amber-500/15 text-amber-500 rounded-full p-1" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-2">
                    <h3 class="text-sm font-semibold text-amber-500">Info Presensi</h3>
                    <p class="text-xs font-medium sm:text-sm">{{ session('failedHadirAgain') }}</p>
                </div>
                <button type="button" @click="alertIsVisible = false" class="ml-auto" aria-label="dismiss alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                        stroke="currentColor" fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
    {{-- GAGAL PULANG ULANG --}}
    @if (session()->has('failedPulangAgain'))
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
            class="relative w-full overflow-hidden shadow-md rounded-md border border-amber-500 bg-white text-slate-700 mt-6"
            role="alert" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="flex w-full items-center gap-2 bg-amber-500/10 p-4">
                <div class="bg-amber-500/15 text-amber-500 rounded-full p-1" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-2">
                    <h3 class="text-sm font-semibold text-amber-500">Info Presensi</h3>
                    <p class="text-xs font-medium sm:text-sm">{{ session('failedPulangAgain') }}</p>
                </div>
                <button type="button" @click="alertIsVisible = false" class="ml-auto" aria-label="dismiss alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                        stroke="currentColor" fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-md shadow-md my-5 p-6">
        <div class="flex items-center justify-between gap-5">
            <div class=" text-xl font-bold tracking-tight text-gray-900">
                {{ Carbon\Carbon::parse($date)->translatedFormat('l, j F Y') }}
            </div>
            @if ($showFormHadir)
                <div>
                    <a href="{{ route('user.izin') }}"
                        class="cursor-pointer whitespace-nowrap rounded-md shadow-md bg-amber-500 px-4 py-2 text-sm font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed ">Izin
                        Hadir</a>
                </div>
            @endif
        </div>
        <div class="overflow-hidden w-full overflow-x-auto rounded-xl">
            <table class="w-full text-left text-sm text-slate-700 ">
                <thead class="border-b border-slate-300 text-sm text-gray-900 ">
                    <tr>
                        <th scope="col" class="p-4">Tanggal</th>
                        <th scope="col" class="p-4">Waktu Datang</th>
                        <th scope="col" class="p-4">Waktu Pulang</th>
                        <th scope="col" class="p-4">Feedback</th>
                        <th scope="col" class="p-4">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-xs">

                    @foreach ($hadirs as $hadir)
                        <tr>
                            <td class="p-4 text-gray-900 font-semibold">
                                {{ $hadir->date ? \Carbon\Carbon::parse($hadir->date)->translatedFormat('l, j F Y') : '-' }}
                            </td>
                            <td class="p-4 text-gray-500">
                                {{ $hadir->waktu_datang ? $hadir->waktu_datang : '-' }}
                            </td>
                            <td class="p-4 text-gray-500">
                                {{ isset($hadir->waktu_pulang) ? $hadir->waktu_pulang : '-' }}
                            </td>
                            <td class="p-4 text-gray-500">
                                {{ isset($hadir->komen) ? $hadir->komen : '-' }}
                            </td>
                            <td class="p-4 text-gray-500">
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="mt-5 flex justify-end">
            {{ $absens->links() }}
        </div> --}}
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            var url = decodedText;
            window.location.href = url;
        }

        function onScanFailure(error) {
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</x-app-layout>
