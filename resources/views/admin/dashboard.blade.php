@php use App\Models\Colocation;use App\Models\Payment;use App\Models\User; @endphp
<x-app-layout title="{{ __('Administration') }}" header="{{ __('Administration') }}">
    <div class="space-y-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Users -->
            <div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Utilisateurs</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ User::count() }}</h3>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Users -->
            <div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Colocations Actives</p>
                        <h3 class="text-2xl font-bold text-green-600">{{ Colocation::countActiveColocations() }}</h3>
                    </div>
                    <div class="p-3 bg-green-50 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Banned Users -->
            <div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Utilisateurs Bannis</p>
                        <h3 class="text-2xl font-bold text-red-600">{{ User::countBannedUsers() }}</h3>
                    </div>
                    <div class="p-3 bg-red-50 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="currentColor" d="M414.39 97.61A224 224 0 1 0 97.61 414.39A224 224 0 1 0 414.39 97.61M432 256a175.1 175.1 0 0 1-35.8 106.26L149.74 115.8A175.1 175.1 0 0 1 256 80c97.05 0 176 79 176 176m-352 0a175.1 175.1 0 0 1 35.8-106.26L362.26 396.2A175.1 175.1 0 0 1 256 432c-97 0-176-78.95-176-176"/></svg>
                    </div>
                </div>
            </div>

            <!-- Unpaid Expenses -->
            <div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Dépenses Impayées</p>
                        <h3 class="text-2xl font-bold text-orange-600">
                            {{ number_format(Payment::totalUnpaidExpenses(), 2) }} DH
                        </h3>
                    </div>
                    <div class="p-3 bg-orange-50 rounded-lg">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Management Section -->
        <div
            class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
            <!-- Header Section -->
            <div
                class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-2">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Gestion des Utilisateurs</h2>
                </div>

                <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-wrap items-center gap-3">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400 group-focus-within:text-blue-500 transition-colors"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm placeholder-gray-400 transition-all duration-200"
                               placeholder="Rechercher par nom ou email...">
                    </div>

                    <div class="relative">
                        <select name="status"
                                onchange="this.form.submit()"
                                class="block w-full py-2 pl-3 pr-10 border border-gray-300 bg-white rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm appearance-none cursor-pointer hover:border-gray-400 transition-colors duration-200">
                            <option value="">Tous les statuts</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actifs
                            </option>
                            <option value="banned" {{ request('status') === 'banned' ? 'selected' : '' }}>Bannis
                            </option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs font-semibold text-gray-600 uppercase tracking-wider bg-gray-50/80">
                    <tr>
                        <th scope="col" class="px-6 py-4">Utilisateur</th>
                        <th scope="col" class="px-6 py-4">Email</th>
                        <th scope="col" class="px-6 py-4">Inscription</th>
                        <th scope="col" class="px-6 py-4">Statut</th>
                        <th scope="col" class="px-6 py-4 text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="bg-white hover:bg-blue-50/30 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="relative flex-shrink-0">
                                        @if($user->image)
                                            <img class="w-10 h-10 rounded-full object-cover ring-2 ring-gray-200"
                                                 src="{{ $user->image_url }}"
                                                 alt="{{ $user->name }}">
                                        @else
                                            <div class="text-gray-400 rounded-full object-cover ring-2 ring-gray-200">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 {{ $user->is_banned ? 'bg-red-500' : 'bg-green-500' }} border-2 border-white rounded-full"></div>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $user->name }}</div>
                                        @if($user->is_admin)
                                            <span class="text-xs text-purple-600 font-medium">Administrateur</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="mailto:{{ $user->email }}"
                                   class="text-gray-600 hover:text-blue-600 transition-colors">
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span
                                        class="text-xs font-medium text-gray-900">{{ $user->created_at->format('d/m/Y') }}</span>
                                    <span class="text-xs text-gray-500">{{ $user->created_at->format('H:i') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->is_banned)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <span class="w-1.5 h-1.5 mr-1 bg-red-500 rounded-full"></span>
                                        Banni
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 mr-1 bg-green-500 rounded-full"></span>
                                        Actif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if (!$user->is_admin)
                                    @if ($user->is_banned)
                                        <form action="{{ route('admin.users.unban', $user) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir réactiver')">
                                            @csrf
                                            <button
                                                type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-700 bg-blue-50 rounded-lg hover:bg-blue-100 focus:ring-4 focus:ring-blue-300 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                Réactiver
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.users.ban', $user) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir bannir')">
                                            @csrf
                                            <button
                                                type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-red-700 bg-red-50 rounded-lg hover:bg-red-100 focus:ring-4 focus:ring-red-300 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                                </svg>
                                                Bannir
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">Aucun utilisateur trouvé</p>
                                    <p class="text-sm">Essayez de modifier vos filtres de recherche</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            <div class="px-6 py-4 bg-gray-50/80 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
