<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>

                <x-application-logo class="w-10 h-10 fill-current text-gray-500" />

                <div class="hidden md:block ms-10 border-l border-gray-400 ps-4">
                    <h1 class="text-xl font-semibold text-gray-800">
                        {{ $header ?? 'Dashboard' }}
                    </h1>
                </div>
            </div>
            <div class="flex items-center">
                <x-primary-button type="button" data-modal-target="colocation-modal-new" data-modal-toggle="colocation-modal-new"
                    class="px-4 py-3 sm:px-6 sm:py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">

                    <svg class="inline h-5 w-5 mr-0 sm:mr-2" xmlns="http://www.w3.org/2000/svg" width="1em"
                        height="1em" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M17 14h2v3h3v2h-3v3h-2v-3h-3v-2h3zM12 3l10 9h-4a6.005 6.005 0 0 0-5.66 8H5v-8H2z" />
                    </svg>

                    <span class="hidden sm:inline">Nouvelle colocation</span>
                </x-primary-button>
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex items-center p-1.5 text-sm font-medium text-gray-900 rounded-full hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            @if (Auth::user()->image)
                                <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->image_url }}"
                                    alt="{{ Auth::user()->name }}">
                            @else
                                <div class="text-gray-400 rounded-full object-cover ring-2 ring-gray-200">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            <span class="mx-2 hidden sm:block">{{ ucfirst(Auth::user()->name) }}</span>
                            <svg class="w-4 h-4 mx-1 hidden sm:block" aria-hidden="true" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Profile</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-start block px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                                        role="menuitem">Deconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Modal -->
<x-modal-colocation />
