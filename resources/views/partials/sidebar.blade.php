<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white flex flex-col justify-between">
        <div>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->is('dashboard*') ? 'bg-gray-100' : '' }}">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('colocations.index') }}"
                       class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->is('colocations*') ? 'bg-gray-100' : '' }}">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span class="ms-3">Colocations</span>
                    </a>
                </li>
                @if (auth()->user()->is_admin)
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                            </svg>
                            <span class="ms-3">Administration</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="pt-4 mt-4 border-t border-gray-200">
            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 shadow-sm">
                @php
                    $reputation = auth()->user()->reputation ?? 0;
                    $isPositive = $reputation > 0;
                    $isNegative = $reputation < 0;
                    $colorClass = $isPositive ? 'text-green-600' : ($isNegative ? 'text-red-500' : 'text-gray-500');
                    $bgClass = $isPositive
                        ? 'bg-green-100 text-green-800'
                        : ($isNegative
                            ? 'bg-red-100 text-red-800'
                            : 'bg-gray-100 text-gray-600');
                    $prefix = $isPositive ? '+' : '';
                @endphp

                <div class="text-[10px] uppercase tracking-wider font-bold text-gray-400 mb-2">
                    Votre Réputation
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-extrabold {{ $colorClass }}">
                            {{ $prefix }}{{ $reputation }}
                        </span>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $bgClass }}">
                        {{ $isPositive ? 'Positif' : ($isNegative ? 'Négatif' : 'Neutre') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</aside>
