<nav class="bg-white border border-b-2" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between ">

            {{-- COMPANY NAME --}}
            <div class="flex-shrink-0">
                <h1 class="font-semibold">PT. Alpha Prime Creation</h1>
            </div>

            {{-- NAV LINK --}}
            <div class="flex items-center ">
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('admin.index') }}"
                            class="{{ Request::is('data-pegawai*') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium transition duration-200">
                            Data Pegawai
                        </a>
                        <a href="{{ route('admin.user.absensi') }}"
                            class="{{ Request::is('absensi-pegawai*') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium transition duration-200">
                            Absensi Pegawai
                        </a>
                        <a href="{{ route('admin.qrCodeAbsen') }}"
                            class="{{ Request::is('qr-code-absen') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium transition duration-200">
                            Qr Code Absen
                        </a>
                    </div>
                </div>
            </div>

            {{-- DROPDOWN --}}
            <div class="hidden md:block ">
                <div class="ml-4 flex items-center md:ml-6">
                    <div class="relative ml-5">

                        <div>

                            <button type="button" @click="isOpen = !isOpen"
                                class="relative flex max-w-xs items-center px-4 py-2 text-sm " id="user-menu-button"
                                aria-expanded="false" aria-haspopup="true">
                                <span>{{ $admin->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4 ml-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </div>
                        <div @click.away="isOpen = false" x-show="isOpen"
                            x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <a href="{{ route('admin.profile', $admin->slug) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 transition duration-200"
                                role="menuitem" tabindex="-1" id="user-menu-item-0">Profile</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-500 hover:text-white transition duration-200"
                                    role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button type="button" @click="isOpen = !isOpen"
                    class="relative inline-flex items-center justify-center rounded-md bg-gray-900 p-2 text-gray-400 hover:bg-gray-800 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 transition duration-300"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>

                    <!-- Icon untuk menu tertutup -->
                    <svg :class="{ 'hidden': isOpen, 'block': !isOpen }"
                        class="block h-6 w-6 transition ease-in-out duration-300" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>

                    <!-- Icon untuk menu terbuka -->
                    <svg :class="{ 'block': isOpen, 'hidden': !isOpen }"
                        class="hidden h-6 w-6 transition ease-in-out duration-300" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>


    <div x-show="isOpen" class="md:hidden relative z-20" id="mobile-menu"
        x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75 transform"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        <div class="absolute w-full bg-white shadow-xl">
            <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3 ">
                <a href="{{ route('admin.index') }}"
                    class="{{ Request::is('data-pegawai*') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}  block rounded-md px-3 py-2 text-base font-medium transition duration-200"
                    aria-current="page">Data Pegawai</a>
                <a href="{{ route('admin.user.absensi') }}"
                    class="{{ Request::is('absensi-pegawai*') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}  block rounded-md px-3 py-2 text-base font-medium transition duration-200"
                    aria-current="page">Absensi Pegawai</a>
                <a href="{{ route('admin.qrCodeAbsen') }}"
                    class="{{ Request::is('qr-code-absen') ? 'bg-gray-900 text-white' : 'text-gray-900 hover:bg-gray-900 hover:text-white' }}  block rounded-md px-3 py-2 text-base font-medium transition duration-200"
                    aria-current="page">Qr Code Absen</a>
            </div>
            <div class="border-t border-gray-700 pb-3 pt-4 ">
                <div class="flex items-center px-5">
                    <div>
                        <div class="text-base font-medium leading-none text-gray-900">{{ $admin->name }}</div>
                        <div class="text-sm font-medium leading-none text-gray-500">{{ $admin->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <a href="{{ route('admin.profile', $admin->slug) }}"
                        class="block rounded-md px-3 py-2 text-sm text-gray-900 hover:bg-gray-900 hover:text-white transition duration-200">
                        Profile
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            this.closest('form').submit();"
                            class="block px-3 py-2 rounded-md  text-sm text-gray-900 hover:bg-red-500 hover:text-white transition duration-200"
                            role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</nav>
