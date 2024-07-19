<x-app-layout title="Admin Profile">

    <x-slot name="navbar">
        @include('layouts.admin-navigation', ['admin' => $admin])
    </x-slot>

    @if (session()->has('nameUpdated'))
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            class="relative w-full mb-6 overflow-hidden rounded-md shadow-md border border-green-600 bg-white text-slate-700"
            role="alert">
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
                    <h3 class="text-sm font-semibold text-green-600">Perubahan Berhasil</h3>
                    <p class="text-xs font-medium sm:text-sm">{{ session('nameUpdated') }}</p>
                </div>
                <button @click="alertIsVisible = false" class="ml-auto" aria-label="dismiss alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                        fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <x-card>
        <div class="border-gray-900/10">
            <h2 class="text-sm font-semibold leading-7 text-gray-900">Informasi Data</h2>
            <p class="text-xs leading-6 text-gray-600">Gunakan data yang sesuai</p>

            <form action="{{ route('admin.ubahNama') }}" method="post">
                @csrf
                @method('patch')
                <div class="mt-6 gap-x-6 space-y-4 ">
                    <div class="sm:w-1/2 ">
                        <label for="name" class="block text-xs font-medium leading-6 text-gray-900">
                            Nama Lengkap
                        </label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" autocomplete="name"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                value="{{ old('name', $admin->name) }}">
                        </div>
                    </div>


                    <div class="sm:w-1/2">
                        <label for="email" class="block text-xs font-medium leading-6 text-gray-900">
                            Email
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                value="{{ old('email', $admin->email) }}">
                        </div>
                    </div>

                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition duration-200">
                        Simpan
                    </button>

                </div>
            </form>
        </div>
    </x-card>

    @if (session()->has('passwordUpdated'))
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            class="relative w-full mt-6 overflow-hidden rounded-md shadow-md border border-green-600 bg-white text-slate-700"
            role="alert">
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
                    <h3 class="text-sm font-semibold text-green-600">Perubahan Berhasil</h3>
                    <p class="text-xs font-medium sm:text-sm">{{ session('passwordUpdated') }}</p>
                </div>
                <button @click="alertIsVisible = false" class="ml-auto" aria-label="dismiss alert">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                        fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <x-card class="mt-6">
        <div class="border-gray-900/10">
            <h2 class="text-sm font-semibold leading-7 text-gray-900">Ubah Password</h2>
            <p class="text-xs leading-6 text-gray-600">Buat password baru yang mudah di ingat </p>

            <form action="{{ route('admin.ubahPassword') }}" method="post">
                @csrf
                @method('patch')
                <div class="mt-6 gap-x-6 space-y-4">
                    <div class="sm:w-1/2">
                        <label for="current_password" class="block text-xs font-medium leading-6 text-gray-900">
                            Password Saat Ini
                        </label>
                        <div x-data="{ showCurrentPassword: false }" class="relative mt-1">
                            <input :type="showCurrentPassword ? 'text' : 'password'" id="current_password"
                                name="current_password"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <button type="button" @click="showCurrentPassword = !showCurrentPassword"
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-700 "
                                aria-label="Show password">
                                <svg x-show="!showCurrentPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                    class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="showCurrentPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                    class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                            @error('current_password')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:w-1/2">
                        <label for="password" class="block text-xs font-medium leading-6 text-gray-900">
                            Password Baru
                        </label>
                        <div x-data="{ showPassword: false }" class="relative mt-1">
                            <input :type="showPassword ? 'text' : 'password'" id="password" name="password"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-700 "
                                aria-label="Show password">
                                <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                    class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                    class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                            @error('password')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:w-1/2">
                        <label for="password_confirmation" class="block text-xs font-medium leading-6 text-gray-900">
                            Konfirmasi Password Baru
                        </label>
                        <div x-data="{ showPasswordConfirmation: false }" class="relative mt-1">
                            <input :type="showPasswordConfirmation ? 'text' : 'password'" id="password_confirmation"
                                name="password_confirmation"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            <button type="button" @click="showPasswordConfirmation = !showPasswordConfirmation"
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-700 "
                                aria-label="Show password">
                                <svg x-show="!showPasswordConfirmation" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="showPasswordConfirmation" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                            @error('password_confirmation')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition duration-200">
                        Ubah Password
                    </button>
                </div>
            </form>


        </div>
    </x-card>

</x-app-layout>
