<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category'         => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Category::create([
            'category' => $request->category
        ]);
        return redirect('/category')->with('status', 'category has created');

    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('category.single', compact('category'));
    }
    
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category'         => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        Category::find($id)->update([
            'category' => $request->category
        ]);
        return redirect('/category');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect('/category');
    }

    public function getCategories()
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Data Berhasil Diambil', $categories, 200);
    }
}
