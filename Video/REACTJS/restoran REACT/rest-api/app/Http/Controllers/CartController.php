<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $cartItems = Cart::with('menu')->where('idpelanggan', $user->idpelanggan)->get();

            return response()->json([
                'success' => true,
                'data' => $cartItems,
                'count' => $cartItems->count(),
                'message' => $cartItems->isEmpty() ? 'Keranjang kosong' : 'Item keranjang berhasil diambil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil item keranjang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idmenu' => 'required|exists:menus,idmenu',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = $request->user();
            $menu = Menu::findOrFail($request->idmenu);

            if ($menu->status !== 'tersedia') {
                return response()->json([
                    'success' => false,
                    'message' => 'Menu tidak tersedia untuk dipesan'
                ], 400);
            }

            $existingCart = Cart::where('idpelanggan', $user->idpelanggan)
                ->where('idmenu', $request->idmenu)
                ->first();

            if ($existingCart) {
                $existingCart->jumlah += $request->jumlah;
                $existingCart->catatan = $request->catatan ?? $existingCart->catatan;
                $existingCart->save();
                $cartItem = $existingCart;
            } else {
                $cartItem = Cart::create([
                    'idpelanggan' => $user->idpelanggan,
                    'idmenu' => $request->idmenu,
                    'jumlah' => $request->jumlah,
                    'catatan' => $request->catatan
                ]);
            }

            $cartItem->load('menu');

            return response()->json([
                'success' => true,
                'data' => $cartItem,
                'message' => 'Item berhasil ditambahkan ke keranjang'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan item ke keranjang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jumlah' => 'sometimes|integer|min:1',
            'catatan' => 'sometimes|nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = $request->user();
            $cartItem = Cart::where('idpelanggan', $user->idpelanggan)
                ->findOrFail($id);

            $updateData = [];
            if ($request->has('jumlah')) {
                $updateData['jumlah'] = $request->jumlah;
            }
            if ($request->has('catatan')) {
                $updateData['catatan'] = $request->catatan;
            }

            $cartItem->update($updateData);
            $cartItem->load('menu');

            return response()->json([
                'success' => true,
                'data' => $cartItem,
                'message' => 'Item keranjang berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui item keranjang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $user = $request->user();
            $cartItem = Cart::where('idpelanggan', $user->idpelanggan)
                ->findOrFail($id);
            $cartItem->delete();

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus item dari keranjang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function clear(Request $request)
    {
        try {
            $user = $request->user();
            Cart::where('idpelanggan', $user->idpelanggan)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil dikosongkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengosongkan keranjang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = $request->user();
            $cartItems = Cart::with('menu')->where('idpelanggan', $user->idpelanggan)->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Keranjang kosong, tidak bisa checkout'
                ], 400);
            }

            $total = 0;
            $orderDetails = [];

            foreach ($cartItems as $item) {
                if ($item->menu->status !== 'tersedia') {
                    return response()->json([
                        'success' => false,
                        'message' => 'Menu ' . $item->menu->menu . ' tidak tersedia'
                    ], 400);
                }

                $subtotal = $item->menu->harga * $item->jumlah;
                $total += $subtotal;

                $orderDetails[] = [
                    'menu' => $item->menu->menu,
                    'harga' => $item->menu->harga,
                    'jumlah' => $item->jumlah,
                    'subtotal' => $subtotal,
                    'catatan' => $item->catatan
                ];
            }

            $order = Order::create([
                'idpelanggan' => $user->idpelanggan,
                'total' => $total,
                'status' => 'menunggu',
                'catatan' => $request->catatan
            ]);

            foreach ($orderDetails as $detail) {
                OrderDetail::create([
                    'idorder' => $order->idorder,
                    'menu' => $detail['menu'],
                    'harga' => $detail['harga'],
                    'jumlah' => $detail['jumlah'],
                    'subtotal' => $detail['subtotal'],
                    'catatan' => $detail['catatan']
                ]);
            }

            Cart::where('idpelanggan', $user->idpelanggan)->delete();

            return response()->json([
                'success' => true,
                'data' => $order->load(['pelanggan', 'details']),
                'message' => 'Checkout berhasil, order telah dibuat'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal checkout',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
