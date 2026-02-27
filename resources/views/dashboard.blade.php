@php use App\Models\Payment; @endphp
<x-app-layout title="{{ __('Dashboard') }}" header="{{ __('Dashboard') }}">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Reputation -->
        <div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Mon score réputation</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ auth()->user()->reputation }}</h3>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                        viewBox="0 0 48 48">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            d="M42 29.4V39a1.996 1.996 0 0 1-2 2H6a1.996 1.996 0 0 1-2-2V12a1.996 1.996 0 0 1 2-2h34a1.996 1.996 0 0 1 2 2v10" />
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            d="M6 10a3.375 3.375 0 0 1 3-3h28a3.375 3.375 0 0 1 3 3m4.5 12v7.4H37a4 4 0 0 1-4.054-3.7A4.016 4.016 0 0 1 37 22ZM17 26l6 9l6-9l-6-10.263Z" />
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            d="m17 26l6 4l6-4" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Unpaid Expenses -->
        <div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Dépenses Impayées</p>
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


    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-white sticky top-0 z-10">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Calendrier des Dépenses</h3>
                    <p class="text-sm text-gray-500" id="month-total-container">
                        Total du mois: <span id="month-total" class="font-bold text-blue-600">0.00 DH</span>
                    </p>
                </div>
                <div class="flex gap-2">
                    <button id="prev-btn" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>
                    <button id="today-btn"
                        class="px-3 py-1 text-sm font-medium hover:bg-gray-100 rounded-lg border border-gray-200 transition-colors">Aujourd'hui</button>
                    <button id="next-btn" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-4 flex-grow">
                <div id="calendar" class="min-h-[500px]"></div>
            </div>
        </div>

        <!-- Colocation Members -->
        <x-members :colocation="$colocation" />
    </div>

    <!-- Expense Modal -->
    <x-expense-modal :categories="$categories" />
    <x-expense-details-modal />
</x-app-layout>
