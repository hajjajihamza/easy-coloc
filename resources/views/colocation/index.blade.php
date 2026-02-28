<x-app-layout title="{{ __('Mes Colocations') }}" header="{{ __('Mes Colocations') }}">
    <!-- Colocations Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($colocations as $colocation)
            <!-- Colocation Card -->
            <div
                class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-200 overflow-hidden
                @if ($colocation->isLeavingAuth()) opacity-60 pointer-events-none @endif">

                <!-- Card Header -->
                <div class="p-5 border-b border-gray-200">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                {{ $colocation->name }}
                            </h3>
                            <div class="flex items-center space-x-2">
                                <!-- Status Badge -->
                                @if ($colocation->isLeavingAuth())
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-yellow-500 rounded-full"></span>
                                        {{ __('Sortie') }}
                                    </span>
                                @else
                                    @if ($colocation->is_active)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span>
                                            {{ __('Active') }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <span class="w-1.5 h-1.5 mr-1.5 bg-red-500 rounded-full"></span>
                                            {{ __('Annulée') }}
                                        </span>
                                    @endif
                                @endif

                                <!-- Owner Badge -->
                                @if ($colocation->is_owner)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                        </svg>
                                        {{ __('Propriétaire') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-5">
                    <!-- Description -->
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $colocation->description ?: __('Aucune description') }}
                    </p>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <!-- Members Count -->
                        <div class="bg-gray-50 rounded-lg p-3">
                            <div class="flex items-center text-gray-600 mb-1">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span class="text-xs font-medium">{{ __('Membres') }}</span>
                            </div>
                            <p class="text-xl font-semibold text-gray-900">
                                {{ $colocation->count_members }}
                            </p>
                        </div>

                        <!-- Expenses Count -->
                        <div class="bg-gray-50 rounded-lg p-3">
                            <div class="flex items-center text-gray-600 mb-1">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-xs font-medium">{{ __('Dépenses') }}</span>
                            </div>
                            <p class="text-xl font-semibold text-gray-900">
                                {{ $colocation->count_expenses }}
                            </p>
                        </div>
                    </div>

                    <!-- Action Button -->
                    @if (!$colocation->isLeavingAuth())
                        <a href="{{ route('colocations.show', $colocation) }}"
                            class="inline-flex items-center justify-center w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            {{ __('Voir les détails') }}
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @else
                        <div
                            class="inline-flex items-center justify-center w-full px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-500 cursor-not-allowed">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            {{ __('Accès restreint - Sortie en cours') }}
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="col-span-full">
                <div class="text-center py-12 px-4 bg-white rounded-xl border-2 border-dashed border-gray-300">
                    <!-- Empty State Icon -->
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z M17 21v-4H7v4 M12 7v6 M9 10h6" />
                        </svg>
                    </div>

                    <!-- Empty State Text -->
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        {{ __('Aucune colocation') }}
                    </h3>
                    <p class="text-gray-500 mb-6 max-w-md mx-auto">
                        {{ __('Vous n\'avez pas encore de colocation. Créez-en une pour commencer à gérer vos dépenses partagées !') }}
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination if needed -->
    @if (method_exists($colocations, 'links'))
        <div class="mt-6">
            {{ $colocations->links() }}
        </div>
    @endif
</x-app-layout>
