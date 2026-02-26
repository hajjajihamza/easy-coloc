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
        <!-- Recent Expenses -->
        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">Dépenses Récentes</h3>
                <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Voir tout</a>
            </div>
            <div class="p-0">
                {{-- @php
                    $userColocation = auth()->user()->colocations()->first();
                    $recentExpenses = $userColocation
                        ? \App\Models\Expense::whereHas('category', function ($query) use ($userColocation) {
                            $query->where('colocation_id', $userColocation->id);
                        })
                            ->with(['payer', 'category'])
                            ->latest()
                            ->take(5)
                            ->get()
                        : collect();
                @endphp --}}

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Titre</th>
                                <th class="px-4 py-3">Payeur</th>
                                <th class="px-4 py-3 text-right">Montant</th>
                            </tr>
                        </thead>
                        {{-- <tbody class="divide-y divide-gray-100">
                            @forelse($recentExpenses as $expense)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 whitespace-nowrap text-gray-500">
                                        {{ $expense->date_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="font-medium text-gray-900">{{ $expense->title }}</div>
                                        <div class="text-xs text-gray-500">{{ $expense->category->name }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <img src="{{ $expense->payer->image_url }}" alt=""
                                                class="w-6 h-6 rounded-full">
                                            <span class="text-gray-700">{{ $expense->payer->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-right font-bold text-gray-900 whitespace-nowrap">
                                        {{ number_format($expense->amount, 2) }} DH
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-gray-500 italic">
                                        Aucune dépense récente.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>

        <!-- Colocation Members -->
        <x-members :colocation="$colocation"/>
    </div>
</x-app-layout>
