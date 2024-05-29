<x-app-layout>
    <x-slot name="navbar">
        @include('layouts.admin-navigation', ['user' => $user])
    </x-slot>

    <x-slot name="head">
        <h1 class="text-xl font-bold tracking-tight text-gray-900">
            Dashboard
        </h1>
    </x-slot>
    <h1>Ini adalah halaman Admin</h1>
</x-app-layout>
