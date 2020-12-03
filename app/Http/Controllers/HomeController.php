<?php

namespace App\Http\Controllers;

use App\Product;
use App\Shop;
use App\User;
use App\Cart;
use App\Category;
use App\Invoice;
use App\PaymentProof;
use App\ShopDetail;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Builder\Function_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    //controllerUsers

    public function getUser()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function createUser()
    {
        return view('user.create');
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string',
            'email'         => 'required|string',
            'password'      => 'required',
            'role'          => 'required|integer'

        ]);

        // $validator->validate();
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        return redirect('/user')->with('status', 'user has created');

    }

    public function editUser($id)
    {
        $users = User::find($id);
        return view('/user.edit', compact('users'));
    }

    public function updateUser(Request $request, $id)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string',
            'email'        => 'required|string'
        ]);

        // $validator->validate();
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        User::find($id)->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'password' => Hash::make($request->password),
            'role'      => $request->role
        ]);
        return redirect('/user');
    }
    
    public function destroyUser($id)
    {
        User::find($id)->delete();
        return redirect('/user');
    }

    //controllerShops

    public function getShop()
    {
        $shops = Shop::all();
        return view('shop.index', compact('shops'));
    }

    public function detailShop($id)
    {
        $shop = Shop::where('id', $id)->with('owner', 'products')->first();
        return view('shop.detail', compact('shop'));
    }

    public function destroyShop($id)
    {
        Shop::find($id)->delete();
        return redirect('/shop');
    }

    //controllerProducts

    public function getProduct()
    {
        $products = Product::with('category', 'shop')->get();
        return view('product.index', compact('products'));
    }

    public function detailProduct($id)
    {
        $product = Product::where('id', $id)->with('category', 'shop')->first();
        return view('product.detail', compact('product'));
    }

    public function destroyProduct($id)
    {
        Product::find($id)->delete();
        return redirect('/product');
    }

    //controllerTransactions

    public function getTransaction()
    {
        $transactions = Transaction::with('product', 'buying', 'buyer')->get();
        return view('transaction.index', compact('transactions'));
    }

    public function destroyTransaction($id)
    {
        Transaction::find($id)->delete();
        return redirect('/transaction');
    }

    //controllerCarts

    public function getCart()
    {
        $carts = Cart::with('product', 'user')->get();
        return view('/cart.index', compact('carts'));
    }

    public function destroyCart($id)
    {
        Cart::find($id)->delete();
        return redirect('/cart');
    }

    public function getShopdetail()
    {
        $shopDetails = ShopDetail::select('shop_id', 'nama_rekening', 'no_rekening', 'nama_bank','kode_bank')->get();
        return view('/shopDetail.index', compact('shopDetails'));
    }

    public function destroyShopDetail($id)
    {
        ShopDetail::find($id)->delete();
        return redirect('/shopDetail');
    }
    
    public function getPaymentproof()
    {
        $paymentProofs = PaymentProof::with('transaction')->get();
        return view('/paymentProof.index', compact('paymentProofs'));
    }

    public function destroyPaymentproof($id)
    {
        PaymentProof::find($id);
        redirect('/paymentProof');
    }

    public function getInvoice()
    {
        $invoices = Invoice::with('transaction')->get();
        return view('/invoice.index', compact('invoices'));
    }

    public function destroyInvoice($id)
    {
        Invoice::find($id)->delete();
        return redirect('/Invoice');
    }


}
