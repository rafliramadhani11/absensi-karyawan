<x-guest-layout>

    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class=" text-center text-xl lg:text-2xl font-bold leading-9 tracking-tight text-gray-900">PT. Alpha Prime
            Creation
        </h2>
        <p class="text-xs text-center">
            Kelola Penggajian Karyawan dengan Sistem yang Mudah Digunakan
        </p>
    </div>

    <div class="mt-10 w-full sm:mx-auto sm:w-full sm:max-w-sm">
        <form action="/submit" method="POST" class="bg-white p-6 rounded-md ">
            <h2 class="text-center text-xl lg:text-2xl font-bold leading-9 tracking-tight text-gray-900 ">Login
                Account
            </h2>
            @csrf

            <x-input label="Email" name="email" type="email" autocomplete="email" required="true" />
            <x-input label="Password" name="password" type="password" autocomplete="current-password" required="true" />

            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Submit</button>
        </form>
    </div>

</x-guest-layout>
