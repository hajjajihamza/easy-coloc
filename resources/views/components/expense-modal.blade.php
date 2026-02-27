@props(['categories'])
<div id="add-expense-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white border border-gray-200 rounded-xl shadow-sm p-4 md:p-6">
            <!-- Modal header -->
            <div class="flex items-center justify-between border-b border-gray-100 pb-4 md:pb-5">
                <h3 class="text-lg font-bold text-gray-900">
                    Ajouter une nouvelle dépense
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center transition-colors"
                    data-modal-hide="add-expense-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="py-4 md:py-6">
                <form class="space-y-4" method="POST" action="{{ route('expenses.store') }}">
                    @csrf
                    <!-- Date -->
                    <div class="mb-5">
                        <x-input-label for="modal-date" :value="__('Date de la dépense')" class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="1em"
                                    height="1em" viewBox="0 0 512 512">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M405.334 64v21.333h-42.667v341.333h42.667V448l-42.667-.001V448h-21.333l-.001-.001l-42.666.001v-21.333l42.666-.001V85.333h-42.666V64zm64 64v256H384v-42.667h42.667V170.667H384V128zM320 128v256H42.667V128zm-98.133 25.6H192v145.067c0 13.333-.833 21.666-1.458 29.687l-.082 1.068l-.079 1.067c-.296 4.09-.514 8.207-.514 12.978h29.867v-19.2a42.67 42.67 0 0 0 38.4 21.333a45.65 45.65 0 0 0 36.266-17.067a99.63 99.63 0 0 0 19.2-53.333c0-40.533-21.333-68.267-53.333-68.267a48.43 48.43 0 0 0-38.4 19.2zm-59.733 72.533a54.61 54.61 0 0 0-44.8-17.066a102.2 102.2 0 0 0-49.067 10.666l8.533 21.334a96.2 96.2 0 0 1 36.267-10.667a27.093 27.093 0 0 1 29.867 29.867v2.133H121.6a89.2 89.2 0 0 0-38.4 6.4a35.63 35.63 0 0 0-21.333 36.267a38.187 38.187 0 0 0 42.667 38.4a50.35 50.35 0 0 0 40.533-17.067v14.933H172.8a172.4 172.4 0 0 1-2.133-34.133v-38.4a66.77 66.77 0 0 0-8.533-42.667m-21.334 51.2v25.6a37.12 37.12 0 0 1-29.866 19.2a17.92 17.92 0 0 1-19.2-19.2c0-14.933 10.666-23.466 36.266-25.6zM251.734 230.4c17.066 0 29.866 17.067 29.866 44.8S270.934 320 253.867 320a35.84 35.84 0 0 1-32-21.333v-46.934a40.32 40.32 0 0 1 29.867-21.333" />
                                </svg>
                            </div>
                            <x-text-input id="modal-date"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                type="text" name="date_at" :value="old('date_at')" required readonly
                                placeholder="Date de la dépense" />
                        </div>
                        <x-input-error :messages="$errors->get('date_at')" class="mt-2" />
                    </div>

                    <!-- Title -->
                    <div class="mb-5">
                        <x-input-label for="title" :value="__('Titre de la dépense')" class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="1em"
                                    height="1em" viewBox="0 0 512 512">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M405.334 64v21.333h-42.667v341.333h42.667V448l-42.667-.001V448h-21.333l-.001-.001l-42.666.001v-21.333l42.666-.001V85.333h-42.666V64zm64 64v256H384v-42.667h42.667V170.667H384V128zM320 128v256H42.667V128zm-98.133 25.6H192v145.067c0 13.333-.833 21.666-1.458 29.687l-.082 1.068l-.079 1.067c-.296 4.09-.514 8.207-.514 12.978h29.867v-19.2a42.67 42.67 0 0 0 38.4 21.333a45.65 45.65 0 0 0 36.266-17.067a99.63 99.63 0 0 0 19.2-53.333c0-40.533-21.333-68.267-53.333-68.267a48.43 48.43 0 0 0-38.4 19.2zm-59.733 72.533a54.61 54.61 0 0 0-44.8-17.066a102.2 102.2 0 0 0-49.067 10.666l8.533 21.334a96.2 96.2 0 0 1 36.267-10.667a27.093 27.093 0 0 1 29.867 29.867v2.133H121.6a89.2 89.2 0 0 0-38.4 6.4a35.63 35.63 0 0 0-21.333 36.267a38.187 38.187 0 0 0 42.667 38.4a50.35 50.35 0 0 0 40.533-17.067v14.933H172.8a172.4 172.4 0 0 1-2.133-34.133v-38.4a66.77 66.77 0 0 0-8.533-42.667m-21.334 51.2v25.6a37.12 37.12 0 0 1-29.866 19.2a17.92 17.92 0 0 1-19.2-19.2c0-14.933 10.666-23.466 36.266-25.6zM251.734 230.4c17.066 0 29.866 17.067 29.866 44.8S270.934 320 253.867 320a35.84 35.84 0 0 1-32-21.333v-46.934a40.32 40.32 0 0 1 29.867-21.333" />
                                </svg>
                            </div>
                            <x-text-input id="title"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                type="text" name="title" :value="old('title')" required autofocus
                                placeholder="Titre de la dépense" />
                        </div>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Amount -->
                    <div class="mb-5">
                        <x-input-label for="amount" :value="__('Montant (DH)')" class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">DH</span>
                            </div>
                            <x-text-input id="amount"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                type="number" name="amount" :value="old('amount')" required step="0.01"
                                placeholder="0.00" />
                        </div>
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div class="mb-5">
                        <x-input-label for="category_id" :value="__('Catégorie')" class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <select id="category_id" name="category_id"
                                class="block w-full pl-3 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center justify-end space-x-3 pt-2 border-t border-gray-100">
                        <button data-modal-hide="add-expense-modal" type="button"
                            class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-200">
                            <svg class="inline h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" width="1em"
                                height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                            </svg>
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-8 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-md shadow-blue-200 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg class="inline h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" width="1em"
                                height="1em" viewBox="0 0 16 16">
                                <path fill="currentColor"
                                    d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v7.793L4.854 6.646a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0-.708-.708L8.5 9.293z" />
                            </svg>
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
