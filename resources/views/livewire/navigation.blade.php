<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 fixed w-full top-0 shadow-sm" style="z-index: 900">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <img class="w-12" src="{{ asset('/img/logo-especiera.png') }}" alt="Logo-EspecieraSgo">
                    </a>
                </div>
            </div>

            <div class="flex justify-center items-center">

                <div class="ml-3 relative">
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('product.index') }}">
                                    Administrador
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ route('welcome') }}">
                                    Vista cliente
                                </x-dropdown-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <x-dropdown>
                            <x-slot name="trigger">
                                <div class="text-center items-center">
                                    <i class="fa-solid fa-user text-greenEspeciera text-3xl cursor-pointer"></i>
                                </div>
                            </x-slot>

                            <x-slot name="content">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="{{ route('login') }}">
                                    ¿Eres administrador?
                                </x-dropdown-link>

                                <div class="border-t border-gray-200"></div>
                            </x-slot>
                        </x-dropdown>

                    @endauth
                </div>

                <div class="flex items-center space-x-4 ml-6">
                    @livewire('dropdown-cart')
                </div>
            </div>
        </div>
</nav>
