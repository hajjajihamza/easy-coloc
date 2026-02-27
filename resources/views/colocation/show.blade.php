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
                            <span>{{ $colocation->members->count() }} {{ __('membres') }}</span>
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
                        <button type="button" data-modal-target="colocation-modal-edit"
                            data-modal-toggle="colocation-modal-edit"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            {{ __('Modifier') }}
                        </button>

                        <a href="{{ route('expenses.export') }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-green-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            {{ __('Exporter en CSV') }}
                        </a>

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
        'isPayment' => true,
    ])
</x-app-layout>
