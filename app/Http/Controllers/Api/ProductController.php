<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
class ProductController extends Controller
{
    //

    public function index()
{
        $products = Product::all();
        return response()->json([
        "success" => true,
        "message" => "Product List",
        "data" => $products
        ]);
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
    $input = $request->all();
    $validator = Validator::make($input, [
    'name' => 'required',
    'detail' => 'required'
    ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
            $product =Product::create([
                    "name" => $request->name,
                    "detail" => $request->detail,
                ]);
            return response()->json([
            "success" => true,
            "message" => "Product created successfully.",
            "data" => $product
            ]);
} 
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
        $product = Product::find($id);
        if (is_null($product)) {
             return $this->sendError('Product not found.');
        }
            return response()->json([
            "success" => true,
            "message" => "Product retrieved successfully.",
            "data" => $product
        ]);
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, Product $product)
{
    $input = $request->all();
    $validator = Validator::make($input, [
    'name' => 'required',
    'detail' => 'required'
    ]);
    if($validator->fails()){
        //  return $this->sendError('Validation Error.', $validator->errors());     
         return response()->json($validator->errors()->toJson(), 400);  
    }
        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();
        return response()->json([
        "success" => true,
        "message" => "Product updated successfully.",
        "data" => $product
        ]);
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy(Product $product)
{
        $product->delete();
        return response()->json([
        "success" => true,
        "message" => "Product deleted successfully.",
        "data" => $product
        ]);
}
}
