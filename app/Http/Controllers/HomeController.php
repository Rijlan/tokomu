<?php

namespace App\Http\Controllers;

use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'password'      => 'required|string',
            'role'          => 'required|integer'

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        User::create([
            'user' => $request->user
        ]);
        return redirect('/user')->with('status', 'user has created');

    }

    public function showUser($id)
    {
        $user = User::find($id);
        return view('/user.single', compact('user'));

    }

    public function editUser($id)
    {
        $users = User::find($id);
        return view('/user.edit', compact('users'));
    }

    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string',
            'email'        => 'required|string',
            'password'     => 'required|string',
            'role'         => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        User::find($id)->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password,
            'role'      => $request->role
        ]);
        return redirect('/user');
    }
    
    public function destroyUser($id)
    {
        User::find($id)->delete();
        return redirect('/user');
    }

    
}
