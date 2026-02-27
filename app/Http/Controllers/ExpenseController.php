<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expense\ExpenseRequest;
use App\Models\Expense;
use App\Models\Category;
use Carbon\Carbon;
use Fruitcake\LaravelDebugbar\Facades\Debugbar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $start = $request->query('start');
        $end = $request->query('end');

        $colocation = Auth::user()->activeColocation();

        if (!$colocation) {
            return response()->json(['events' => [], 'total' => 0]);
        }

        $expensesQuery = $colocation->expenses()
            ->with(['payer', 'category']);

        if ($start && $end) {
            $expensesQuery->whereBetween('date_at', [$start, $end]);
        }

        $expenses = $expensesQuery->get();

        $events = $expenses->map(function ($expense) {
            return [
                'id' => $expense->id,
                'title' => $expense->title . ' (' . number_format($expense->amount, 2) . ' DH)',
                'start' => $expense->date_at->toDateString(),
                'allDay' => true,
                'extendedProps' => [
                    'amount' => $expense->amount,
                    'payer_id' => $expense->user_id,
                    'payer_name' => $expense->payer->name,
                    'category_name' => $expense->category->name,
                    'can_delete' => Auth::id() === $expense->user_id,
                ],
                'backgroundColor' => '#3b82f6', // blue-500
                'borderColor' => '#2563eb', // blue-600
            ];
        });

        $total = $expenses->sum('amount');

        return response()->json([
            'events' => $events,
            'total' => $total,
        ]);
    }

    public function store(ExpenseRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $colocation = Auth::user()->activeColocation();
        $category = Category::find($validated['category_id']);
        if (!$colocation || $category->colocation_id !== $colocation->id) {
            return redirect()->back()->with(['error' => 'Catégorie non autorisée ou absence de colocation active.']);
        }

         $category->expenses()->create(
            [
                'title' => $validated['title'],
                'amount' => $validated['amount'],
                'date_at' => Carbon::createFromFormat('d/m/Y', $validated['date_at']),
                'user_id' => Auth::id()
            ]
        );

        Debugbar::info('created suceee ss');

        return redirect()->back()->with(['success' => 'Dépense créée avec succès.']);
    }

    public function destroy(Expense $expense): JsonResponse
    {
        if (Auth::id() !== $expense->user_id) {
            return response()->json(['message' => 'Unauthorized. Only the payer can delete this expense.'], 403);
        }

        $expense->delete();

        return response()->json(['message' => 'Expense deleted successfully']);
    }
}
