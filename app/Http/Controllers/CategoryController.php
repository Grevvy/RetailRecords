<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', ['categories' => Category::all()]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        Category::create($request->only(['name', 'description']));
        return redirect()->route('categories.index');
    }

    public function edit($category_id)
    {
        return view('categories.edit', ['category' => Category::find($category_id)]);
    }

    public function update(Request $request, $category_id)
    {
        $category = Category::find($category_id);
        $category->update($request->only(['name', 'description']));
        return redirect()->route('categories.index');
    }

    public function destroy($category_id)
    {
        Category::destroy($category_id);
        return redirect()->route('categories.index');
    }
}
