<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        DB::transaction(function () use ($request) {

            // kunci data terakhir (biar ga dobel)
            $lastCategory = Category::lockForUpdate()
                ->orderBy('id', 'desc')
                ->first();

            if ($lastCategory) {
                $lastNumber = (int) substr($lastCategory->category_code, 4);
                $newNumber  = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $categoryCode = 'SFT-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            Category::create([
                'category_code' => $categoryCode,
                'category_name' => $request->category_name,
            ]);
        });

        return redirect()->route('admin.category.index')
            ->with('success', 'Category berhasil ditambahkan');
    }
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_code' => 'required|unique:categories,category_code,' . $category->id,
            'category_name' => 'required',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.category.index')
            ->with('success', 'Category berhasil diupdate');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Category berhasil dihapus');
    }
}