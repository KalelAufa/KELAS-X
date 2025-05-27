<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        $menus = Menu::paginate(3);
        return view('menu', [
            'kategoris' => $kategoris,
            'menus' => $menus,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'pelanggan' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'jeniskelamin' => 'required',
            'email' => 'required | email | unique:pelanggans',
            'password' => 'required | min:3',
        ]);
        Pelanggan::create([
            'pelanggan' => $data['pelanggan'],
            'alamat' => $data['alamat'],
            'telp' => $data['telp'],
            'jeniskelamin' => $data['jeniskelamin'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'aktif' => 1,
        ]);
        return redirect('login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategoris = Kategori::all();
        $menus = Menu::where('idkategori', $id)->paginate(3);
        return view('kategori', [
            'kategoris' => $kategoris,
            'menus' => $menus,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function register()
    {
        $kategoris = Kategori::all();
        return view('register', ['kategoris' => $kategoris]);
    }

    public function login()
    {
        $kategoris = Kategori::all();
        return view('login', ['kategoris' => $kategoris]);
    }

    public function postlogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required | email',
            'password' => 'required | min:3',
        ]);
        $pelanggan = Pelanggan::where('email', $data['email'])->where('aktif',1)->first();
        if (!$pelanggan) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        if (!Hash::check($data['password'], $pelanggan->password)) {
            return back()->with('error', 'Password salah.');
        }

        $request->session()->put('pelanggan', $pelanggan);
        return redirect('/');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
