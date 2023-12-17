<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    function addProduct(Request $req)
    {
        $product = new Product;
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');
        $product->file_path = $req->file('file')->store('product');
        $product->save();

        return $product;

    }

    function list()
    {
        return Product::all();
    }

    function delete($id)
    {
        $result = Product::where('id', $id)->delete();
        if ($result) {
            return ['Product has been deleted'];
        } else {
            return ['Operation failed'];
        }
    }

    function getProduct($id)
    {
        $result = Product::find($id);
        return $result;
    }

    function update($id, Request $req)
    {
        $product = Product::find($id);
    
        if ($req->input('name')) {
            $product->name = $req->input('name');
        }
    
        if ($req->input('price')) {
            $product->price = $req->input('price');
        }
    
        if ($req->input('description')) {
            $product->description = $req->input('description');
        }
    
        if ($req->file('file')) {
            $product->file_path = $req->file('file')->store('product');
        }
    
        $product->save();
    
        return $product;
    }

    function search($key)
    {
        return Product::where('name','LIKE',"%$key%")->get();
    }
    
}
