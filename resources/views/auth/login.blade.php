<x-guest-layout>

    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class=" text-center text-xl lg:text-2xl font-bold leading-9 tracking-tight text-gray-900">PT. Alpha Prime
            Creation
        </h2>
        <p class="text-xs text-center">
            Kelola Penggajian Karyawan dengan Sistem yang Mudah Digunakan
        </p>
    </div>

    <div class="mt-5 w-full sm:mx-auto sm:w-full sm:max-w-sm">
        <form action="{{ route('login') }}" method="POST" class="bg-white p-6 rounded-md ">
            @csrf
            <h2 class="text-center text-xl lg:text-2xl font-bold leading-9 tracking-tight text-gray-900 ">Login
            </h2>
            <x-input label="Email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" />
            <x-input label="Password" name="password" type="password" autocomplete="current-password" />

            <x-button id="submit" type="submit">Submit</x-button>
        </form>
    </div>

</x-guest-layout>
