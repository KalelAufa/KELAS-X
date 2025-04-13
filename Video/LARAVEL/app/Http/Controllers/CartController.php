<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\OrderDetail;
use App\Models\Order;

class CartController extends Controller
{

    function beli($idmenu)
    {
        if (session()->missing('pelanggan')) {
            return redirect('/login')->with('error', 'Silahkan login terlebih dahulu');
        }

        $menu = Menu::where('idmenu', $idmenu)->first();

        $cart = session()->get('cart', []);

        if (isset($cart[$idmenu])) {
            // Make sure quantity exists before incrementing
            $cart[$idmenu]['quantity']++;
        } else {
            $cart[$idmenu] = [
                'idmenu' => $menu->idmenu,
                'menu' => $menu->menu,
                'harga' => $menu->harga,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Menu item added to cart');
        return redirect('/');
    }
    function cart()
    {
        $kategoris = Kategori::all();
        return view('cart', ['kategoris' => $kategoris]);
    }
    function hapus($idmenu)
    {
        $cart = session()->get('cart');

        if (isset($cart[$idmenu])) {
            unset($cart[$idmenu]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Menu item removed from cart');
    }
    function batal()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared');
    }
    function tambah($idmenu)
    {
        $cart = session()->get('cart');
        $cart[$idmenu]['quantity']++;
        session()->put('cart', $cart);
        return redirect('cart');
    }
    function kurang($idmenu)
    {
        $cart = session()->get('cart');

        if ($cart[$idmenu]['quantity'] == 1) {
            unset($cart[$idmenu]);
        } else {
            $cart[$idmenu]['quantity']--;
        }

        session()->put('cart', $cart);
        return redirect('cart');
    }
    function checkout()
    {
        $idorder = date('YmdHms');
        $total = 0;

        foreach (session('cart') as $key => $value) {
            $data = [
                'idorder' => $idorder,
                'idmenu' => $value['idmenu'], // Ensure idmenu is included
                'jumlah' => $value['quantity'],
                'hargajual' => $value['harga']
            ];
            $total = $total + ($value['quantity'] * $value['harga']);
            OrderDetail::create($data); // Create OrderDetail with all required fields
        }
        $tanggal = date('Y-m-d');
        $data = [
            'idorder' => $idorder,
            'idpelanggan' => session('pelanggan')['idpelanggan'],
            'tglorder' => $tanggal,
            'total' => $total,
            'bayar' => 0,
            'kembali' => 0
        ];
        Order::create($data);
        session()->forget('cart');
        return redirect('cart')->with('success', 'Pesanan berhasil diproses');
    }
}
