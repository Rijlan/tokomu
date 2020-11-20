<?php

namespace App\Http\Controllers;

use App\Product;
use App\Shop;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $products = Product::whereRaw('LOWER(product_name) LIKE ?', ['%' . strtolower($keyword) . '%'])->get();
        $shops = Shop::whereRaw('LOWER(shop_name) LIKE ?', ['%' . strtolower($keyword) . '%'])->get();

        if ($products->isEmpty() && $shops->isEmpty()) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Data Berhasil Diambil', compact('products', 'shops'), 404);
    }
}
