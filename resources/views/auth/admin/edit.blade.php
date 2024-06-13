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
                    Ubah
                </h1>
            </li>
        </ol>
    </x-slot>

    <div class="bg-white rounded-md shadow-md p-6">
        <form action="{{ route('admin.update.user', $user->slug) }}" method="post">
            @method('put')
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Ubah Data</h2>

                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <div class="flex justify-between items-center">
                                <label for="fullname" class="block text-sm font-medium leading-6 text-gray-900">
                                    Nama Lengkap
                                </label>
                                @error('name')
                                    <p class="text-xs text-red-500 ">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <input type="text" name="name" id="fullname" autocomplete="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <div class="flex justify-between items-center">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                                    Email
                                </label>
                                @error('email')
                                    <p class="text-xs text-red-500 ">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-1">
                            <label for="tanggalLahir" class="block text-sm font-medium leading-6 text-gray-900">Tanggal
                                Lahir</label>
                            <div class="mt-2">
                                <input type="date" name="tanggalLahir" id="tanggalLahir" required
                                    value="{{ old('tanggalLahir', $user->tanggalLahir) }}" autocomplete="tanggalLahir"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('tanggalLahir')
                                <p class="text-xs text-red-500 ">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-1">
                            <label for="jeniskelamin" class="block text-sm font-medium leading-6 text-gray-900">Jenis
                                Kelamin</label>
                            <div class="mt-2">
                                <select id="jeniskelamin" name="jeniskelamin" autocomplete="jeniskelamin" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="Laki - Laki"
                                        {{ old('jeniskelamin', $user->jeniskelamin ?? '') == 'Laki - Laki' ? 'selected' : '' }}>
                                        Laki - Laki
                                    </option>
                                    <option value="Perempuan"
                                        {{ old('jeniskelamin', $user->jeniskelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>

                            </div>
                            @error('jeniskelamin')
                                <p class="text-xs text-red-500 ">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-1 sm:col-start-3">

                            <label for="jabatan"
                                class="block text-sm font-medium leading-6 text-gray-900">Jabatan</label>
                            @php
                                $jabatanOptions = [
                                    'Direktur Utama',
                                    'Manajer Proyek',
                                    'Pengawas Lapangan',
                                    'Kepala Gudang',
                                    'Finance',
                                    'Purchasing',
                                    'Supervisor',
                                ];
                                $selectedJabatan = old('jabatan', $user->jabatan ?? '');
                            @endphp
                            <div class="mt-2">
                                <select id="jabatan" name="jabatan" autocomplete="jabatan" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    @foreach ($jabatanOptions as $option)
                                        <option value="{{ $option }}"
                                            {{ $selectedJabatan == $option ? 'selected' : '' }}>
                                            {{ ucfirst($option) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('jabatan')
                                <p class="text-xs text-red-500 ">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-full">
                            <label for="alamat"
                                class="block text-sm font-medium leading-6 text-gray-900">Alamat</label>
                            <div class="mt-2">
                                <input type="text" name="alamat" id="alamat" autocomplete="alamat"
                                    value="{{ old('alamat', $user->alamat) }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('alamat')
                                <p class="text-xs text-red-500 ">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit"
                    class="rounded-md  inline-flex justify-center items-center gap-2  bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-md hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
