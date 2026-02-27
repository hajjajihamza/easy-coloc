@php use App\Models\Payment; @endphp
<x-app-layout title="{{ __('Dashboard') }}" header="{{ __('Dashboard') }}">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Reputation -->
        <div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Mon score réputation</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ auth()->user()->reputation }}</h3>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M10.92 2.868a1.25 1.25 0 0 1 2.16 0l2.795 4.798l5.428 1.176a1.25 1.25 0 0 1 .667 2.054l-3.7 4.141l.56 5.525a1.25 1.25 0 0 1-1.748 1.27L12 19.592l-5.082 2.24a1.25 1.25 0 0 1-1.748-1.27l.56-5.525l-3.7-4.14a1.25 1.25 0 0 1 .667-2.055l5.428-1.176z"/></g></svg>
                </div>
            </div>
        </div>

        <!-- Unpaid Expenses by payer -->
        <div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-green-500 uppercase tracking-wider">Dépenses Impayées par les autres</p>
                    <h3 class="text-2xl font-bold text-green-600">
                        {{ number_format(Payment::totalUnpaidExpensesByPayer(auth()->user()), 2) }} DH
                    </h3>
                </div>
                <div class="p-3 bg-orange-50 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                         viewBox="0 0 48 48">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              d="M42 29.4V39a1.996 1.996 0 0 1-2 2H6a1.996 1.996 0 0 1-2-2V12a1.996 1.996 0 0 1 2-2h34a1.996 1.996 0 0 1 2 2v10"/>
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              d="M6 10a3.375 3.375 0 0 1 3-3h28a3.375 3.375 0 0 1 3 3m4.5 12v7.4H37a4 4 0 0 1-4.054-3.7A4.016 4.016 0 0 1 37 22ZM17 26l6 9l6-9l-6-10.263Z"/>
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              d="m17 26l6 4l6-4"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Unpaid Expenses by user -->
        <div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Mes dépenses impayées</p>
                    <h3 class="text-2xl font-bold text-orange-600">
                        {{ number_format(Payment::totalUnpaidExpensesByUser(auth()->user()), 2) }} DH
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

    @include('colocation.include._calendar')
</x-app-layout>
