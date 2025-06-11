<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Menyimpan kategori baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit kategori
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Mengupdate kategori di database
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
        ]);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Menghapus kategori dari database
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Cek apakah kategori memiliki menu terkait
        if ($category->menus()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki menu terkait');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
