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
    <div class="lg:col-span-1">
        <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm mb-6 transition-all hover:shadow-md">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-indigo-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="text-indigo-600">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Qui doit à qui ?</h3>
            </div>

            <div class="space-y-4">
                @forelse (\App\Models\Payment::unpaid()->get() as $payment)
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
                        <div class="flex flex-col sm:flex-row items-center gap-4">
                            <!-- Left side with expense title and users -->
                            <div class="flex-1 w-full">
                                <!-- Expense Title -->
                                <div class="text-center sm:text-left mb-2 sm:mb-1">
                                    <p class="text-xs font-medium text-gray-500">
                                        <span class="text-gray-400">Dépense:</span>
                                        <span class="text-gray-700 font-semibold">{{ $payment->expense->title }}</span>
                                    </p>
                                </div>

                                <!-- Payer & Recipient -->
                                <div class="flex items-center justify-center sm:justify-start gap-2 sm:gap-4">
                                    <!-- Recipient -->
                                    <div class="flex flex-col items-center min-w-[70px]">
                                        <span class="text-[10px] font-semibold text-emerald-600 uppercase">Destinataire</span>
                                        <div class="h-10 w-10 flex items-center justify-center bg-emerald-50 rounded-full border-2 border-white">
                                            <span class="text-sm font-bold text-emerald-700">{{ substr($payment->user->name, 0, 1) }}</span>
                                        </div>
                                        <p class="text-xs font-medium text-gray-700 mt-1 truncate max-w-[80px]">{{ $payment->user->name }}</p>
                                    </div>

                                    <!-- Arrow -->
                                    <div class="text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </div>

                                    <!-- Payer -->
                                    <div class="flex flex-col items-center min-w-[70px]">
                                        <span class="text-[10px] font-semibold text-indigo-600 uppercase">Payeur</span>
                                        <div class="h-10 w-10 flex items-center justify-center bg-indigo-50 rounded-full border-2 border-white">
                                            <span class="text-sm font-bold text-indigo-700">{{ substr($payment->expense->payer->name, 0, 1) }}</span>
                                        </div>
                                        <p class="text-xs font-medium text-gray-700 mt-1 truncate max-w-[80px]">{{ $payment->expense->payer->name }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Amount & Button -->
                            <div class="flex items-center justify-between sm:justify-end gap-4 w-full sm:w-auto border-t sm:border-t-0 pt-3 sm:pt-0">
                                <span class="text-xl font-bold text-red-600 whitespace-nowrap">
                                    {{ number_format($payment->amount, 2) }} <span class="text-sm">DH</span>
                                </span>
                                @if(auth()->id() === $payment->user_id || auth()->id() === $payment->expense->user_id)
                                    <form action="{{ route('expenses.mark-as-paid', $payment) }}" method="POST"
                                          onsubmit="return confirm('Etes-vous sûr de vouloir marquer ce paiement comme payé ?');">
                                        @csrf
                                        <button type="submit" title="Marquer comme payé"
                                                class="flex items-center gap-2 px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition active:scale-95">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="hidden xs:inline">Marquer payé</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Aucune dépense impayée</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <x-members :colocation="$colocation" />
    </div>
</div>

<!-- Expense Modal -->
<x-expense-modal :categories="$categories" />
<x-expense-details-modal />
