<x-app-layout>
    <x-slot name="navbar">
        @include('layouts.user-navigation', ['user' => $user])
    </x-slot>

    <x-slot name="head">
        <ol class="flex flex-wrap items-center gap-2">
            <li class="flex items-center gap-2">
                <a href="{{ route('user.kehadiran') }}"
                    class="text-xl font-bold tracking-tight text-blue-500 hover:underline">Data Kehadiran</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true"
                    stroke-width="2" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </li>
            <li class="flex items-center gap-2">
                <h1 class="text-xl font-bold tracking-tight text-gray-900">
                    Izin Hadir
                </h1>
            </li>
        </ol>
    </x-slot>

    <div class="bg-white rounded-md shadow-md p-6 ">
        <div>
            <div class="px-4 sm:px-0">
                <h3 class="text-base font-semibold leading-7 text-gray-900">Informasi Izin Kehadiran</h3>
                <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Periksa Data dan isi Alasan yang jelas</p>
            </div>
            <form action="{{ route('user.aksi.izin') }}" method="post">
                @csrf
                <div class="mt-6 border-t  border-gray-200">
                    <dl class="divide-y divide-gray-200 ">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Tanggal</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0 w-1/2 ">
                                <input type="text" name="date" id="date" autocomplete="date"
                                    value="{{ $date->format('j F Y') }}" disabled
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 disabled:opacity-75">
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">
                                <label for="alasan">Alasan</label>
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                <textarea id="alasan" name="alasan" rows="3"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    required></textarea>
                            </dd>
                        </div>
                    </dl>
                </div>
                <div class="mt-3 flex items-center justify-end gap-x-6">
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
    </div>

</x-app-layout>
