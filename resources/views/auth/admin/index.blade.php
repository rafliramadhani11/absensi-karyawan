<x-app-layout>
    <x-slot name="navbar">
        @include('layouts.admin-navigation', ['admin' => $admin])
    </x-slot>

    <x-slot name="head">
        <h1 class="text-xl font-bold tracking-tight text-gray-900">
            Data Pegawai
        </h1>
    </x-slot>

    {{-- SESSION BERHASIL HAPUS --}}
    @if (session()->has('hapusPegawai'))
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
            class="relative w-full mb-6 overflow-hidden sm:rounded-md border border-green-600 bg-white text-slate-700 "
            role="alert" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="flex w-full items-center gap-2 bg-green-600/10 py-3 px-4">
                <div class="bg-green-600/15 text-green-600 rounded-full p-1" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-2">
                    <p class="font-semibold text-sm">Hapus Info</p>
                    <p class="text-xs">{{ session('hapusPegawai') }}
                    </p>
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

    {{-- SESSION BERHASIL TAMBAH PEGAWAI --}}
    @if (session()->has('addPegawai'))
        <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
            class="relative w-full mb-6 overflow-hidden sm:rounded-md border border-green-600 bg-white text-slate-700 "
            role="alert" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="flex w-full items-center gap-2 bg-green-600/10 py-3 px-4">
                <div class="bg-green-600/15 text-green-600 rounded-full p-1" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-2">
                    <p class="font-semibold text-sm">Pembaruan Info</p>
                    <p class="text-xs">{{ session('addPegawai') }}
                    </p>
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
        <div class="pb-4">
            <a href="{{ route('admin.add.user') }}"
                class="cursor-pointer inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-md shadow-md bg-blue-600 px-4 py-2 text-xs font-medium tracking-wide text-white transition duration-200 hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Pegawai
            </a>
        </div>
        <div class="overflow-hidden w-full overflow-x-auto rounded-xl">
            <table class="w-full text-left text-sm text-slate-700 ">
                <thead class="border-b border-slate-300 text-sm text-gray-900 ">
                    <tr>
                        <th scope="col" class="p-4">Kode Pegawai</th>
                        <th scope="col" class="p-4">Nama Pegawai</th>
                        <th scope="col" class="p-4">Jenis Kelamin</th>
                        <th scope="col" class="p-4">Jabatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-xs divide-slate-200">
                    @if ($users->count() == 0)
                        <tr>
                            <td class="pt-4 text-red-500 font-semibold text-center" colspan="4">Tidak ada
                                Pegawai</td>
                        </tr>
                    @endif
                    @foreach ($users as $user)
                        <tr>
                            <td class="p-4 text-gray-900 font-semibold">{{ $user->kode }}</td>
                            <td class="p-4 text-gray-500">
                                <span class="block">{{ $user->name }}</span>
                            </td>
                            <td class="p-4 text-gray-500">{{ $user->jeniskelamin }}</td>
                            <td class="p-4 text-gray-500">{{ $user->jabatan }}</td>
                            <td class="p-4 text-gray-500 flex items-center justify-center gap-1">
                                <a href="{{ route('admin.show.user', $user->slug) }}"
                                    class="cursor-pointer whitespace-nowrap rounded-md bg-sky-600 px-2 py-1 text-xs font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed ">
                                    Info
                                </a>

                                <div x-data="{ dangerModalIsOpen: false }">
                                    <button type="button" @click="dangerModalIsOpen = true"
                                        class="cursor-pointer whitespace-nowrap rounded-md bg-red-600 px-2 py-1 text-xs font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed ">
                                        Hapus
                                    </button>

                                    <div x-cloak x-show="dangerModalIsOpen" x-transition.opacity.duration.200ms
                                        x-trap.inert.noscroll="dangerModalIsOpen"
                                        @keydown.esc.window="dangerModalIsOpen = false"
                                        @click.self="dangerModalIsOpen = false"
                                        class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                                        role="dialog" aria-modal="true" aria-labelledby="dangerModalTitle">
                                        <!-- Modal Dialog -->
                                        <div x-show="dangerModalIsOpen"
                                            x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                            x-transition:enter-start="opacity-0 scale-50"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-xl border border-slate-300 bg-white text-slate-700 ">
                                            <!-- Dialog Header -->
                                            <div
                                                class="flex items-center justify-between border-b border-slate-300 bg-slate-100/60 px-4 py-2 ">
                                                <div
                                                    class="flex items-center justify-center rounded-full bg-red-600/20 text-red-600 p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="size-6" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <button @click="dangerModalIsOpen = false" aria-label="close modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        aria-hidden="true" stroke="currentColor" fill="none"
                                                        stroke-width="1.4" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <!-- Dialog Body -->
                                            <div class="px-4 text-center">
                                                <h3 id="dangerModalTitle"
                                                    class="mb-2 font-semibold tracking-wide text-black ">
                                                    Hapus Data</h3>
                                                <p>Data pegawai dan data kehadiran dari pegawai akan hilang, apakah anda
                                                    yakin
                                                    ingin menghapus data ini ?
                                                </p>
                                            </div>
                                            <!-- Dialog Footer -->
                                            <div class="flex items-center justify-center border-slate-300 p-4 ">
                                                <form action="{{ route('admin.delete.user', $user->slug) }}"
                                                    class="w-full" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit"
                                                        class="w-full cursor-pointer whitespace-nowrap rounded-xl bg-red-600 px-4 py-2 text-center text-sm font-semibold tracking-wide text-white transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 active:opacity-100 active:outline-offset-0">Hapus
                                                        Sekarang</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
