<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;

use App\Product;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;



class ProductController extends Controller
{
    
    
    
    /**
     * The list of all products
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function all() {
        
        $products = Product::all();
        
        return response()->json(['data' => $products]);
    }
    
    /**
     * Products by category
     * 
     * @param integer $id
     * @return Illuminate\Http\JsonResponse
     */
    public function showByCategory($id) {
        
        try {
            
            $products = Product::where('category_id', $id)->get();
            
        } catch (Exception $ex) {
            
            abort(404);
        }
        
        return response()->json(['data' => $products]);
    }
    
    /**
     * Show product by {id}
     * 
     * @param type $id
     * @return Illuminate\Http\JsonResponse
     */
    public function show($id) {
        
        $product = Product::find($id);
        
        if ($product) {

            return response()->json(['data' => $product]);
            
        } else {
            
            abort(404);
        }
    }
    
    /**
     * 
     * Create new product
     * 
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function add(Request $request) {
        
        $v = Validator::make($request->all(), [
                    'name' => 'required|min:3',
                    'category_id' => 'required|integer',
        ]);
        
        if($v->fails()) {
            
            abort(400);
            
        }
        
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id')
        ];
        
        try {
            
            $id = Product::addGetId($data);
            
        } catch (\Illuminate\Database\QueryException $e) {
            
            abort(400);
            
        }
        
        $newProduct = Product::find($id);
        
        if($newProduct) {
        
            return response()->json(['data' => $newProduct]);
        
        } else {
            
            abort(404);
        }
        
    }
    
    
    /**
     * 
     * Change product
     * 
     * @param Request $request
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        
        $product = Product::find($id);
        
        if($product) {
           
            $v = Validator::make($request->all(), [
                        'name' => 'min:3',
                        'category_id' => 'integer|exists:categories,id'
            ]);

            if ($v->fails()) {

                abort(400);
            }
            
            $name = $request->input('name');
            $description = $request->input('description');
            $category_id = $request->input('category_id');
            
            if(isset($name)) {
                $product->name = $name;
            }
            
            if(isset($description)) {
                $product->description = $description;
            }
            
            if(isset($category_id)) {
                $product->category_id = $category_id;
            }
            
            try {
                
                $product->save();
                
            } catch (Exception $ex) {
                
                abort(400);
                
            }
            
            return response()->json(['data' => $product]);
        } 
        
        abort(404);
        
    }
    
    /**
     * Delete product
     * 
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function delete($id) {
        
        $product = Product::find($id);
        
        if($product) {
            
            try {
                
                $product->delete();
                
                return response()->json(['status' => 'ok']);
                
            } catch (Exception $e) {
                
                return response()->json(['status' => 'error']);
            }
        }
        
        abort(404);
    }
}
