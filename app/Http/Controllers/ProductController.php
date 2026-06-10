<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; // Memastikan model Category ter-import untuk relasi
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua data produk beserta relasi kategorinya agar lebih optimal
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        // Mengambil semua data kategori untuk ditampilkan sebagai pilihan dropdown di form
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi data input, termasuk memastikan category_id yang dipilih valid dan ada di tabel categories
        $request->validate([
            'category_id' => 'required|exists:categories,id', // Validasi kategori wajib dipilih
            'kode_barang' => 'required|unique:products,kode_barang',
            'nama_barang' => 'required',
            'satuan'      => 'required',
            'harga'       => 'required|numeric',
        ]);

        // Menyimpan data produk baru beserta category_id yang dipilih
        Product::create([
            'category_id' => $request->category_id, // Simpan ID kategori relasi
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'satuan'      => $request->satuan,
            'harga'       => $request->harga,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
}