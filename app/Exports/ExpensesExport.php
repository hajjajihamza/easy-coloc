<?php

namespace App\Exports;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExpensesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $colocation = Auth::user()->activeColocation();

        if (!$colocation) {
            return collect([]);
        }

        return $colocation->expenses()
            ->with(['payer', 'category'])
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Titre',
            'Montant (DH)',
            'Date',
            'Payeur',
            'Catégorie',
            'Créé le',
        ];
    }

    /**
    * @var Expense $expense
    */
    public function map($expense): array
    {
        return [
            $expense->id,
            $expense->title,
            number_format($expense->amount, 2),
            $expense->date_at->format('d/m/Y'),
            $expense->payer->name,
            $expense->category->name,
            $expense->created_at->format('d/m/Y H:i'),
        ];
    }
}
