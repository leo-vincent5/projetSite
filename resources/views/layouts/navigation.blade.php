<nav
    x-data="{ open: false }"
    class="sticky top-0 z-50 border-b border-white/10 bg-[#090406]/90 text-white shadow-[0_10px_40px_rgba(0,0,0,0.35)] backdrop-blur-xl"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 justify-between">

            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <x-application-logo class="block h-10 w-auto fill-current text-amber-300" />

                    <span class="text-2xl font-black tracking-tight">
                        Equicode
                    </span>
                </a>

                <div class="hidden sm:ml-10 sm:flex sm:items-center sm:space-x-2">
                    <a
                        href="{{ route('dashboard') }}"
                        class="rounded-full px-4 py-2 text-sm font-semibold transition
                        {{ request()->routeIs('dashboard')
                            ? 'bg-amber-300 text-[#12070d]'
                            : 'text-rose-100/80 hover:bg-white/10 hover:text-white' }}"
                    >
                        Galeries
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/15">
                            <span>{{ Auth::user()->name }}</span>

                            <svg class="h-4 w-4 text-amber-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Mon profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                Déconnexion
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button
                    @click="open = !open"
                    class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/10 p-3 text-amber-300 transition hover:bg-white/15"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <div
        :class="{'block': open, 'hidden': !open}"
        class="hidden border-t border-white/10 bg-[#12070d] sm:hidden"
    >
        <div class="space-y-2 px-4 py-4">
            <a
                href="{{ route('dashboard') }}"
                class="block rounded-2xl px-4 py-3 text-base font-semibold transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-amber-300 text-[#12070d]'
                    : 'text-rose-100/80 hover:bg-white/10 hover:text-white' }}"
            >
                Galeries
            </a>
        </div>

        <div class="border-t border-white/10 px-4 py-5">
            <div class="font-bold text-white">{{ Auth::user()->name }}</div>
            <div class="mt-1 text-sm text-rose-100/60">{{ Auth::user()->email }}</div>

            <div class="mt-4 space-y-2">
                <a
                    href="{{ route('profile.edit') }}"
                    class="block rounded-2xl px-4 py-3 text-sm font-semibold text-rose-100/80 transition hover:bg-white/10 hover:text-white"
                >
                    Mon profil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block rounded-2xl px-4 py-3 text-sm font-semibold text-rose-100/80 transition hover:bg-white/10 hover:text-white"
                    >
                        Déconnexion
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>