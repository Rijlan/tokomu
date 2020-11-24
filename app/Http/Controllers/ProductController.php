<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        // // $products = Product::with('shop', 'category')->get();
        // $products = Product::with(['category' => function($query) {
        //     $query->select('id', 'category');
        // }, 'shop' => function($query) {
        //     $query->select('id', 'shop_name', 'image');
        // }])->get();
        $products = Product::select(['id', 'product_name', 'price', 'stock', 'image'])->get();
        
        if ($products->isEmpty()) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Data Berhasil Diambil', $products, 200);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        $product = Product::where('id', $id)->with(['category' => function($query) {
            $query->select('id', 'category');
        }, 'shop' => function($query) {
            $query->select('id', 'shop_name', 'image', 'user_id');
        }])->first();
        return $this->sendResponse('success', 'Data Berhasil Diambil', $product, 200);
    }

    public function store(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category_id' => '',
            'shop_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        if ($request->hasFile('image')) {
            // $file = $request->file('image');
            // $image = Str::slug($file->getClientOriginalName(), '-') . time() . '.' . $file->getClientOriginalExtension();
            
            // $file->move(public_path('uploads/products'), $image);

            // $product->image = $image;

            $file = base64_encode(file_get_contents($request->image));

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
                'form_params' => [
                    'key' => '6d207e02198a847aa98d0a2a901485a5',
                    'action' => 'upload',
                    'source' => $file,
                    'format' => 'json'
                ]
            ]);

            $data = $response->getBody()->getContents();
            $data = json_decode($data);
            $image = $data->image->url;

            $product->image = $image;
        }
        $product->category_id = $request->category_id;
        $product->shop_id = $request->shop_id;
        
        try {
            $product->save();
            
            return $this->sendResponse('success', 'Produk Berhasil Ditambah', compact('product'), 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Produk Gagal Ditambah', $th->getMessage(), 500);
        }
    }

    public function update(Request $request ,$id)
    {
        $product = Product::find($id);

        $data = $request->except(['image']);

        $result = array_filter($data);

        if ($request->hasFile('image')) {

            $file = base64_encode(file_get_contents($request->image));

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
                'form_params' => [
                    'key' => '6d207e02198a847aa98d0a2a901485a5',
                    'action' => 'upload',
                    'source' => $file,
                    'format' => 'json'
                ]
            ]);

            $data = $response->getBody()->getContents();
            $data = json_decode($data);
            $image = $data->image->url;

            $product->image = $image;
        }

        try {
            $product->update($result);
            
            return $this->sendResponse('success', 'Produk Berhasil Diupdate', compact('product'), 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Produk Gagal Diupdate', $th->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        try {
            $product->delete();

            return $this->sendResponse('success', 'Produk Dihapus', null, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Produk Gagal Dihapus', null, 404);
        }
    }

    public function getProductByCategory($id)
    {
        // $products = Product::where('category_id', $id)->with(['category' => function($query) {
        //     $query->select('id', 'category');
        // }, 'shop' => function($query) {
        //     $query->select('id', 'shop_name', 'image');
        // }])->get();
        $products = Product::select(['id', 'product_name', 'price', 'stock', 'image'])->where('category_id', $id)->get();
        
        if ($products->isEmpty()) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Data Berhasil Diambil', $products, 200);
    }
}
