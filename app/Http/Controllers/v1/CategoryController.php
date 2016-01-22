<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;

use App\Category;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    
    
    
    /**
     * The list of all categories
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function all(Request $request) {
        
        $sort = $request->input('sort');
        
        $categories = Category::all();
        
        if($sort == 'ASC') {
            
            $categories = $categories->sortBy(function($item){
                return $item->name;
            });
            
        }
        
        if($sort == 'DESC') {
            
            $categories = $categories->sortByDesc(function($item){
                return $item->name;
            });
            
        }
        
        return response()->json(['data' => $categories]);
    }
    
    /**
     * Show category by {id}
     * 
     * @param type $id
     * @return Illuminate\Http\JsonResponse
     */
    public function show($id) {
        
        $category = Category::find($id);
        
        if ($category) {

            return response()->json(['data' => $category]);
            
        } else {
            
            abort(404);
        }
    }
    
    /**
     * 
     * Create new category
     * 
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function add(Request $request) {
        
        $v = Validator::make($request->all(), [
                    'name' => 'required'
        ]);
        
        if($v->fails()) {
            
            abort(400);
            
        }
        
        $data = [
            'name' => $request->input('name')
        ];
        
        try {
            
            $id = Category::addGetId($data);
            
        } catch (\Illuminate\Database\QueryException $e) {
            
            abort(400);
            
        }
        
        $newCategory = Category::find($id);
        
        if($newCategory) {
        
            return response()->json(['data' => $newCategory]);
        
        } else {
            
            abort(404);
        }
        
    }
    
    
    /**
     * 
     * Change category
     * 
     * @param Request $request
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        
        $category = Category::find($id);
        
        if($category) {
           
            $v = Validator::make($request->all(), [
                        'name' => 'required|min:3'
            ]);

            if ($v->fails()) {

                abort(400);
            }
            
            $category->name = $request->input('name');
            
            try {
                
                $category->save();
                
            } catch (Exception $ex) {
                
                abort(400);
                
            }
            
            return response()->json(['data' => $category]);
        } 
        
        abort(404);
        
    }
    
    /**
     * Delete category
     * 
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function delete($id) {
        
        $category = Category::find($id);
        
        if($category) {
            
            try {
                
                $category->delete();
                
                return response()->json(['status' => 'ok']);
                
            } catch (Exception $e) {
                
                return response()->json(['status' => 'error']);
            }
        }
        
        abort(404);
    }
}
