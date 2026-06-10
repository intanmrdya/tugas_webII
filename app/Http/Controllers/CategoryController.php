<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi disesuaikan dengan nama kolom asli di database (categories,nama_kategori)
        $request->validate([
            'kode_kategori' => 'required|unique:categories,kode_kategori',
            'nama'          => 'required|unique:categories,nama_kategori',
            'deskripsi'     => 'nullable',
        ]);

        // 2. Proses simpan disesuaikan: bagian kiri adalah kolom DB, bagian kanan adalah input form
        Category::create([
            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
}