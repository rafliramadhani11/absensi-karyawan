<x-app-layout :user='$user'>

    <x-slot name="navbar">
        @include('layouts.user-navigation', ['user' => $user])
    </x-slot>

    <x-slot name="head">
        <h1 class="text-xl font-bold tracking-tight text-gray-900">
            Dashboard
        </h1>
    </x-slot>

    <div>Ini adalah halaman User</div>

</x-app-layout>
