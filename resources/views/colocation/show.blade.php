<x-app-layout :title="__('Détails de la colocation')" :header="$colocation->name">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('colocations.index') }}"
            class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            {{ __('Retour aux colocations') }}
        </a>
    </div>

    <!-- Colocation Header Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-3">
                        <h1 class="text-2xl font-bold text-gray-900">
                            {{ $colocation->name }}
                        </h1>
                        <!-- Status Badge -->
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
                    </div>

                    <p class="text-gray-600 mb-4">
                        {{ $colocation->description ?: __('Aucune description fournie') }}
                    </p>

                    <!-- Quick Stats -->
                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>{{ $colocation->count_members }} {{ __('membres') }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $colocation->expenses->count() }} {{ __('dépenses') }}</span>
                        </div>
                        @if ($colocation->is_owner)
                            <div class="flex items-center text-sm text-purple-600">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                <span>{{ __('Vous êtes propriétaire') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 md:mt-0 flex space-x-2">
                    @if ($colocation->is_owner)
                        <div class="space-y-2 sm:space-y-0 sm:flex sm:items-center sm:justify-end sm:gap-2">
                            @if ($colocation->is_active)
                                <!-- Cancel Button -->
                                <form action="{{ route('colocations.cancel', $colocation) }}" method="POST"
                                    onsubmit="return confirm('{{ __('Êtes-vous sûr de vouloir annuler cette colocation ?') }}')"
                                    class="block sm:inline-block w-full sm:w-auto">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-3 sm:py-2 bg-red-50 border border-red-200 rounded-lg text-sm font-medium text-red-700 hover:bg-red-100 transition-colors duration-200">
                                        <svg class="w-5 h-5 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>{{ __('Annuler') }}</span>
                                    </button>
                                </form>

                                <!-- Edit Button -->
                                <button type="button" data-modal-target="colocation-modal-edit"
                                    data-modal-toggle="colocation-modal-edit"
                                    class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-3 sm:py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <svg class="w-5 h-5 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>{{ __('Modifier') }}</span>
                                </button>
                            @endif

                            <!-- Export Button -->
                            <a href="{{ route('expenses.export') }}"
                                class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-3 sm:py-2 bg-green-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-green-700 transition-colors duration-200">
                                <svg class="w-5 h-5 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>{{ __('Exporter les dépenses CSV') }}</span>
                            </a>
                        </div>

                        <x-modal-colocation action="{{ route('colocations.update', $colocation) }}" method="PUT"
                            id="colocation-modal-edit" :colocation="$colocation" title="{{ __('Modifier la colocation') }}"
                            button_text="{{ __('Enregistrer les modifications') }}" />
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('colocation.include._calendar', [
        'categories' => $colocation->categories,
    ])
</x-app-layout>
