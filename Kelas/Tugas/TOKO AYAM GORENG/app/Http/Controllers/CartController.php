<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $addresses = Auth::check() ? Alamat::where('user_id', Auth::id())->get() : [];
        $cartItems = Cart::where('session_id', session()->getId())->with('menu')->get();
        return view('cart', compact('cartItems', 'addresses'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $menu = Menu::findOrFail($request->menu_id);
        $cartItem = Cart::firstOrNew([
            'session_id' => session()->getId(),
            'menu_id' => $menu->id
        ]);
        $cartItem->quantity = ($cartItem->quantity ?? 0) + $request->quantity;
        $cartItem->save();

        return redirect('cart')->with('success', 'Menu berhasil ditambahkan ke keranjang');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::findOrFail($request->cart_id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->back()->with('success', 'Keranjang diperbarui');
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item dihapus dari keranjang');
    }

    public function checkout(Request $request)
    {
        // Cek apakah keranjang kosong
        $cartItems = Cart::where('session_id', session()->getId())->with('menu')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang belanja Anda kosong');
        }

        // Hitung subtotal
        $subtotal = $cartItems->sum(function ($item) {
            return $item->menu->price * $item->quantity;
        });

        // Tambahkan biaya pengiriman dan pajak (sesuai cart.blade.php)
        $shippingCost = 10000; // Rp 10.000
        $tax = $subtotal * 0.1; // Pajak 10%
        $total = $subtotal + $shippingCost + $tax;

        // Ambil user yang sedang login (jika ada autentikasi)
        $user = Auth::user();

        // Validasi alamat pengiriman (hanya jika user sudah login)
        $alamatPengiriman = null;
        if (Auth::check()) {
            $addressId = $request->address_id;
            if (empty($addressId)) {
                return redirect()->back()->with('error', 'Silakan pilih alamat pengiriman');
            }

            $address = Alamat::findOrFail($addressId);
            if ($address->user_id !== Auth::id()) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses ke alamat ini');
            }
            $alamatPengiriman = $address->alamat;
        } else {
            // User belum login, redirect ke halaman login
            return redirect('login')->with('info', 'Silakan login terlebih dahulu untuk melanjutkan checkout');
        }
        $order = Order::create([
            'user_id' => $user->id, // User sudah pasti login di tahap ini
            'total' => $total,
            'status' => 'pending',
            'alamat' => $alamatPengiriman
        ]);

        // Simpan detail item pesanan
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $cartItem->menu_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->menu->price,
            ]);
        }

        // Hapus item dari keranjang setelah checkout
        Cart::where('session_id', session()->getId())->delete();

        // Redirect ke halaman konfirmasi pesanan (bisa dibuat terpisah)
        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Pesanan Anda telah dibuat');
    }
}
