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
