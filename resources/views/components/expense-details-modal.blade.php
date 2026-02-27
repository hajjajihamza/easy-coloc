<div id="expense-details-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white border border-gray-200 rounded-xl shadow-sm p-4 md:p-6">
            <!-- Modal header -->
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <h3 class="text-lg font-bold text-gray-900">
                    Détails de la dépense
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center transition-colors"
                    data-modal-hide="expense-details-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="py-4 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</label>
                    <p id="detail-title" class="text-base font-semibold text-gray-900 mt-1"></p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</label>
                        <p id="detail-amount" class="text-lg font-bold text-blue-600 mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Date</label>
                        <p id="detail-date" class="text-sm font-medium text-gray-700 mt-1"></p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Payé par</label>
                        <p id="detail-payer" class="text-sm font-medium text-gray-700 mt-1"></p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</label>
                        <p id="detail-category" class="text-sm font-medium text-gray-700 mt-1"></p>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-end pt-4 border-t border-gray-100">
                <button data-modal-hide="expense-details-modal" type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>
