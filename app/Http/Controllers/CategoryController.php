<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        auth()->user()->activeColocation()?->categories()->create($request->validate([
            'name' => 'required|string|max:255',
        ]));
        return back()->with('success', 'Catégorie créée avec succès');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return back()->with('success', 'Catégorie supprimée avec succès');
    }
}
