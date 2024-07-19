<x-app-layout title="Absen Qr Code">
    <x-slot name="navbar">
        @include('layouts.admin-navigation', ['admin' => $admin])
    </x-slot>

    <x-slot name="head">
        <h1 class="text-xl font-bold tracking-tight text-gray-900">
            Qr Code Presensi
        </h1>
    </x-slot>

    <h1 class="text-xl font-bold tracking-tight px-4 mb-4 text-gray-900">
        {{ Carbon\Carbon::parse($date)->translatedFormat('l, j F Y') }}
    </h1>

    <div class=" w-full mb-4 overflow-hidden rounded-md shadow-md border border-sky-600 bg-white text-slate-700 "
        role="alert">
        <div class="flex w-full items-center gap-2 bg-sky-600/10 p-4">
            <div class="bg-sky-600/15 text-sky-600 rounded-full p-1" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-2">
                <h3 class="text-sm font-semibold text-sky-600">Info Presensi</h3>
                <ul class="mt-2 list-inside list-disc pl-2 text-xs font-medium sm:text-sm">
                    <li class="text-xs font-medium sm:text-sm">
                        Jika karyawan tidak absen lebih dari jam 17.00
                        dinyatakan
                        <span class="text-red-500 font-semibold">Tidak Hadir/Alfa</span>
                    </li>
                    <li>QR Code akan tampil sampai jam 22.59</li>
                    <li>Presensi dibuka tepat dari jam 08.00 - 22.59</li>
                </ul>
            </div>
        </div>
    </div>

    @if ($date->format('H') >= 8 && $date->format('H') <= 22)

        @foreach ($users as $user)
            <div x-data="{ isExpanded: false }" class="divide-y divide-slate-300 bg-white shadow-md rounded-lg my-3">
                <button id="controlsAccordionItemOne" type="button"
                    class="flex w-full items-center justify-between gap-4  p-4 text-left underline-offset-2 hover:bg-slate-100 focus-visible:bg-slate-100/75 focus-visible:underline focus-visible:outline-none transition duration-200 text-sm"
                    aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded"
                    :class="isExpanded ? 'text-onSurfaceStrong font-medium' :
                        'text-onSurface  font-medium '"
                    :aria-expanded="isExpanded ? 'true' : 'false'">
                    {{ $user->name }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2"
                        stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true"
                        :class="isExpanded ? 'rotate-180 transition duration-300' : ''">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-cloak x-show="isExpanded" id="accordionItemOne" aria-labelledby="controlsAccordionItemOne"
                    x-collapse>
                    <div class="sm:flex sm:items-center sm:justify-around py-5">
                        <div class="flex items-center justify-center ">
                            <div>
                                {{ QrCode::size(160)->margin(2)->generate(route('user.hadir', ['jwt' => $user->qr_code_jwt])) }}
                                <p class="text-center text-sm text-emerald-600 font-semibold">*Scan Absen Hadir</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-center ">
                            <div>
                                {{ QrCode::size(160)->margin(2)->generate(route('user.pulang', ['jwt' => $user->qr_code_jwt])) }}
                                <p class="text-center text-sm text-red-600 font-semibold">*Scan Absen Pulang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    @endif


</x-app-layout>
