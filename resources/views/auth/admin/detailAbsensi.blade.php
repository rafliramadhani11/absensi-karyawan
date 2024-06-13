<x-app-layout>
    <x-slot name="navbar">
        @include('layouts.admin-navigation', ['admin' => $admin])
    </x-slot>

    <x-slot name="head">
        <ol class="flex flex-wrap items-center gap-2">
            <li class="flex items-center gap-2">
                <a href="{{ route('admin.user.absensi') }}"
                    class="text-xl font-bold tracking-tight text-blue-500 hover:underline">Absensi Pegawai</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true"
                    stroke-width="2" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </li>
            <li class="flex items-center gap-2">
                <h1 class="text-xl font-bold tracking-tight text-gray-900">
                    Detail Absen Hari Ini
                </h1>
            </li>
        </ol>
    </x-slot>

    @if (session()->has('komentarAdded'))
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
            class="relative w-full overflow-hidden rounded-md shadow-md border mb-4 border-green-600 bg-white text-slate-700 "
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
                    <h3 class="text-sm font-semibold text-green-600">Berhasil menambahkan komentar</h3>
                    <p class="text-xs font-medium sm:text-sm">{{ session('komentarAdded') }}</p>
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

    <div class="bg-white rounded-md shadow-md p-6">
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">Informasi Absen</h3>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Detail Absen
                {{ Carbon\Carbon::now()->translatedFormat('l, j F Y') }}</p>
        </div>
        <div class="mt-6 pb-6 border-t border-b border-gray-200">
            <dl>
                <form action="{{ route('admin.ubah.absen.user', $hadir->id) }}" method="post">
                    @csrf
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Nama Pegawai</dt>
                        <dd class="mt-1 sm:w-1/3 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $hadir->user->name }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">
                            Waktu Datang
                        </dt>
                        <dd class="mt-1 sm:w-1/3 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            @if ($hadir->status == 'Alfa')
                                <div id="waktu_datang_container">
                                    <label for="waktu_datang"
                                        class="block text-sm font-medium leading-6 text-gray-900">Waktu Datang</label>
                                    <input type="time" name="waktu_datang" value="" id="waktu_datang"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <p class="text-xs text-gray-500 mt-1">AM 12 Malam - Siang , PM 12 Siang - Malam</p>
                                </div>
                            @else
                                <input type="time" name="waktu_datang" id="waktu_datang"
                                    value="{{ $hadir->waktu_datang }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <p class="text-xs text-gray-500 mt-1">AM 12 Malam - Siang , PM 12 Siang - Malam</p>
                            @endif
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Waktu Pulang</dt>
                        <dd class="mt-1 sm:w-1/3 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            @if ($hadir->status == 'Alfa')
                                <input type="time" name="waktu_pulang" value="" id="waktupulang"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <p class="text-xs text-gray-500 mt-1">AM 12 Malam - Siang , PM 12 Siang - Malam</p>
                            @else
                                <input type="time" name="waktu_pulang" id="waktu_pulang"
                                    value="{{ $hadir->waktu_pulang }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <p class="text-xs text-gray-500 mt-1">AM 12 Malam - Siang , PM 12 Siang - Malam</p>
                            @endif
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Status Kehadiran</dt>
                        <dd class="mt-1 sm:w-1/3 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            <select name="status" id="status" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="Hadir" {{ $hadir->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="Izin" {{ $hadir->status == 'Izin' ? 'selected' : '' }}>Izin</option>
                                <option value="Alfa" {{ $hadir->status == 'Alfa' ? 'selected' : '' }}>Alfa</option>
                            </select>
                        </dd>
                    </div>
                    <div class=" flex items-center justify-end gap-x-6">
                        <button type="submit"
                            class="rounded-md  inline-flex justify-center items-center gap-2  bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-md hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                            Simpan Perubahan
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="3" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        </button>
                    </div>
                </form>
            </dl>
        </div>

        @if ($hadir->alasan)
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Alasan</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $hadir->alasan ?? '-' }}</dd>
            </div>
        @else
            <form action="{{ route('admin.user.absen.addKomentar', $hadir->id) }}" method="post">
                @csrf
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Beri Komentar Kinerja</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <textarea id="komen" name="komen" rows="3"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $hadir->komen }}</textarea>
                    </dd>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
                    <button type="submit"
                        class="rounded-md  inline-flex justify-center items-center gap-2  bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-md hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Simpan Komentar
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </button>
                </div>
            </form>
        @endif
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const waktuDatangInput = document.getElementById('waktu_datang');
            const waktuPulangInput = document.getElementById('waktu_pulang');

            waktuDatangInput.addEventListener('input', function() {
                if (statusSelect.value === 'Alfa' && waktuDatangInput.value !== '') {
                    statusSelect.value = 'Hadir';
                }
            });

            statusSelect.addEventListener('change', function() {
                if (statusSelect.value === 'Alfa') {
                    waktuDatangInput.value = '';
                    waktuPulangInput.value = '';
                }
            });
        });
    </script>

</x-app-layout>
