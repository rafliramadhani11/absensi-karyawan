<x-app-layout :user='$user'>

    <x-slot name="navbar">
        @include('layouts.user-navigation', ['user' => $user])
    </x-slot>

    <x-slot name="head">
        <h1 class="text-xl font-bold tracking-tight text-gray-900">
            Absen Harian
        </h1>
    </x-slot>

    <div class="bg-white rounded-md shadow-md p-6">
        <form action="" method="post">
            @method('put')
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-8 space-y-3">

                    <div class="lg:w-1/4">
                        <label for="date" class="block text-sm font-medium leading-6 text-gray-900">Tanggal</label>
                        <div class="mt-2">
                            <input type="text" name="date" id="date" autocomplete="date"
                                {{-- value="{{ date('H : i : s, Y-m-d') }}" --}} value="{{ date('j F Y') }}" disabled
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 disabled:opacity-75">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 lg:w-1/2 gap-5">
                        <div>
                            <label for="waktu_datang" class="block text-sm font-medium leading-6 text-gray-900">Waktu
                                Datang</label>
                            <div class="mt-2">
                                <input type="text" name="waktu_datang" id="waktu_datang" autocomplete="waktu_datang"
                                    {{-- value="{{ date('H : i : s, Y-m-d') }}" --}} value="{{ date('H : i : s') }}" disabled
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 disabled:opacity-75">
                            </div>
                        </div>
                        <div>
                            <label for="waktu_datang" class="block text-sm font-medium leading-6 text-gray-900">Waktu
                                Datang</label>
                            <div class="mt-2">
                                <input type="text" name="waktu_datang" id="waktu_datang" autocomplete="waktu_datang"
                                    {{-- value="{{ date('H : i : s, Y-m-d') }}" --}} value="{{ date('H : i : s') }}" disabled
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 disabled:opacity-75">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-6 flex items-center justify-start gap-x-6">
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
