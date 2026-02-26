<x-app-layout :title="__('Détails de la colocation')" :header="$colocation->name">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('colocations.index') }}"
           class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
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
                        @if($colocation->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span>
                                        {{ __('Active') }}
                                    </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
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
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span>{{ $colocation->members->count() }} {{ __('membres') }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $colocation->expenses->count() }} {{ __('dépenses') }}</span>
                        </div>
                        @if($colocation->is_owner)
                            <div class="flex items-center text-sm text-purple-600">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                                <span>{{ __('Vous êtes propriétaire') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 md:mt-0 flex space-x-2">
                    @if($colocation->is_owner)
                        <button
                            type="button" data-modal-target="colocation-modal-edit" data-modal-toggle="colocation-modal-edit"
                           class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            {{ __('Modifier') }}
                        </button>

                        <x-modal-colocation
                            action="{{ route('colocations.update', $colocation) }}"
                            method="PUT"
                            id="colocation-modal-edit"
                            :colocation="$colocation"
                            title="{{ __('Modifier la colocation') }}"
                            button_text="{{ __('Enregistrer les modifications') }}"
                        />
                    @endif
                    <a href=""
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ __('Nouvelle dépense') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Members -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-5 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            {{ __('Membres') }}
                        </h2>
                        <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $colocation->members->count() }}
                        </span>
                    </div>
                </div>

                <div class="p-5">
                    @forelse($colocation->members as $member)
                        <div class="flex items-center justify-between py-2 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold text-sm">
                                        {{ strtoupper(substr($member->name, 0, 2)) }}
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $member->name }}
                                        @if($member->id === auth()->id())
                                            <span class="text-xs text-gray-500 italic">
                                                ({{ __('Vous') }})
                                            </span>
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $member->email }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if(!$member->pivot->is_owner)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                        </svg>
                                        {{ __('Propriétaire') }}
                                    </span>
                                @else
                                    @if($colocation->is_owner && $member->id !== auth()->id())
                                        <form action="{{ route('colocations.members.toggle-owner', [$colocation, 'user' => $member]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800 hover:bg-orange-200" title="{{ __('Rendre propriétaire') }}">
                                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M30.48 8.385H32v3.04h-1.52Zm-3.05 6.09h1.52v6.1H18.29V22.1h1.52v1.52h-1.52v1.53h10.66v3.05h1.53V11.425h-3.05Zm-4.57 9.14h-1.53V22.1h1.53Zm6.09 0H25.9V22.1h3.05Zm0-13.71v-1.52h1.53v-1.53h-3.05v1.53H25.9v3.04h1.53v-1.52z"/><path fill="currentColor" d="M16.76 28.195v-1.53h-1.52v1.53H3.05v1.52h25.9v-1.52zm4.57-12.2v1.53h1.53v1.52h1.52v-1.52h1.52v-1.53h1.53v-1.52H25.9v-1.52h-1.52v-1.53h-1.52v1.53h-1.53v1.52h-1.52v1.52zm-3.04-3.04h1.52v1.52h-1.52Zm0-9.15h1.52v4.58h-1.52Zm-1.53 21.34h1.53v1.52h-1.53Zm0-6.1h1.53v1.53h-1.53Zm0-7.62h1.53v1.53h-1.53Zm-1.52 10.67h1.52v1.52h-1.52Zm0-4.57h1.52v1.52h-1.52Zm1.52-7.62h1.53v-1.52h-4.58v1.52h1.53v1.52h1.52zm-1.52-4.57h1.52v1.52h-1.52Zm-1.53-3.05h4.58v1.52h-4.58Zm0 22.86h1.53v1.52h-1.53Zm0-6.1h1.53v1.53h-1.53Zm0-7.62h1.53v1.53h-1.53Zm-1.52 1.53h1.52v1.52h-1.52Zm0-9.15h1.52v4.58h-1.52ZM6.1 15.995v1.53h1.52v1.52h1.52v-1.52h1.53v-1.53h1.52v-1.52h-1.52v-1.52H9.14v-1.53H7.62v1.53H6.1v1.52H4.57v1.52zm-3.05-6.09h1.52v1.52H6.1v-3.04H4.57v-1.53H1.52v1.53h1.53z"/><path fill="currentColor" d="M13.71 25.145v-1.53h-1.52V22.1h1.52v-1.52H3.05v-6.1h1.52v-3.05H1.52V28.2h1.53v-3.05ZM9.14 22.1h1.53v1.52H9.14Zm-6.09 0H6.1v1.52H3.05ZM0 8.385h1.52v3.04H0Z"/></svg>
                                            </button>
                                        </form>

                                        <form action="{{ route('colocations.members.leaving', [$colocation, 'user' => $member]) }}" method="POST" class="inline ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800 hover:bg-red-200" {{ __('Retirer') }}
                                                    onclick="return confirm('{{ __('Êtes-vous sûr de vouloir retirer ce membre ?') }}')">
                                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M20.12 8.46L18 10.59l-2.12-2.13l-1.42 1.42L16.59 12l-2.13 2.12l1.42 1.42L18 13.41l2.12 2.13l1.42-1.42L19.41 12l2.13-2.12zM8 4a4 4 0 1 0 0 8a4 4 0 1 0 0-8M3 20h10c.55 0 1-.45 1-1v-1c0-2.76-2.24-5-5-5H7c-2.76 0-5 2.24-5 5v1c0 .55.45 1 1 1"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                @endif

                                <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    {{ $member->reputation }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <p class="text-gray-500 text-sm">
                                {{ __('Aucun membre dans cette colocation') }}
                            </p>
                        </div>
                    @endforelse

                    @if($colocation->is_owner)
                        <div class="mt-4">
                            <button
                                type="button"
                                data-modal-target="modal-invite-members" data-modal-toggle="modal-invite-members"
                                class="inline-flex items-center justify-center w-full px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                                {{ __('Inviter un membre') }}
                            </button>
                        </div>

                        <!-- Modal -->
                        <div id="modal-invite-members" tabindex="-1" aria-hidden="true"
                             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <form method="POST" action="{{ route('colocations.invite', $colocation) }}"
                                      class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                                    @csrf
                                    <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                                        <h3 class="text-lg font-medium text-heading">
                                            {{ __('Inviter un membre') }}
                                        </h3>
                                        <button type="button"
                                                class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                                                data-modal-hide="modal-invite-members">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18 17.94 6M18 18 6.06 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <div class="space-y-4 md:space-y-6 py-2 md:py-2">
                                        <!-- Email -->
                                        <div class="mb-5">
                                            <x-input-label for="member-email" :value="__('Adresse email du membre')" class="text-gray-700 font-medium"/>
                                            <div class="mt-1 relative rounded-lg shadow-sm">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                                <x-text-input id="member-email"
                                                              class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                                              type="text" name="email" :value="old('email')" required autofocus
                                                              placeholder="Adresse email du membre"/>
                                            </div>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end space-x-3 pt-2 border-t border-gray-100">
                                        <button data-modal-hide="modal-invite-members" type="button"
                                                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                            <svg class="inline h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                 viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22"/>
                                            </svg>
                                            Annuler
                                        </button>
                                        <button type="submit"
                                                class="px-8 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-md shadow-blue-200 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            <svg class="inline h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                            </svg>
                                            {{ __('Inviter') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Expenses -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-5 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Dépenses') }}
                        </h2>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">
                                {{ __('Total:') }}
                                <span class="font-semibold text-gray-900">
                                    {{ number_format($colocation->expenses->sum('amount'), 2) }} €
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-5">
                    @forelse($colocation->expenses->groupBy(function($expense) {
                        return $expense->created_at->format('F Y');
                    }) as $month => $monthlyExpenses)
                        <!-- Month Group -->
                        <div class="mb-6 last:mb-0">
                            <h3 class="text-sm font-medium text-gray-500 mb-3">
                                {{ $month }}
                            </h3>

                            <div class="space-y-3">
                                @foreach($monthlyExpenses as $expense)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                        <div class="flex-1">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">
                                                        {{ $expense->title }}
                                                    </p>
                                                    <div class="flex items-center text-xs text-gray-500 mt-0.5">
                                                        <span>{{ $expense->category->name }}</span>
                                                        <span class="mx-1">•</span>
                                                        <span>{{ $expense->created_at->format('d M Y') }}</span>
                                                        <span class="mx-1">•</span>
                                                        <span>{{ __('Par') }} {{ $expense->user->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                                    <span class="text-lg font-semibold text-gray-900">
                                                        {{ number_format($expense->amount, 2) }} €
                                                    </span>
                                            @if($expense->user_id === auth()->id() || $colocation->is_owner)
                                                <div class="flex items-center space-x-1">
                                                    <a href=""
                                                       class="p-1 text-gray-400 hover:text-gray-600">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                    </a>
                                                    <form action="" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="p-1 text-gray-400 hover:text-red-600"
                                                                onclick="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer cette dépense ?') }}')">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                {{ __('Aucune dépense') }}
                            </h3>
                            <p class="text-gray-500 mb-4">
                                {{ __('Commencez par ajouter une dépense à cette colocation.') }}
                            </p>
                            <a href=""
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                {{ __('Ajouter une dépense') }}
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
