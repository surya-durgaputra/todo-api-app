<?php

namespace App\Http\Controllers;

use App\Category;
use Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategories( Request $request, Category $category )
    {
        
        $result = $category->getAll();

        $status = 500;
        if($result['status'] == config('cust_constants.success'))
        {
            $status = 200;
        }
        return response()->json($result['result'],$status); 
    }

    public function showCategory( Request $request, Category $category )
    {
        $rules = [
            'id'=> 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $result = $category->getCategory($request->input('id'));

        $status = 500;
        if($result['status'] == config('cust_constants.success'))
        {
            $data=[];
            $data['id'] = $result['result']['id'];
            $data['category'] = $result['result']['category'];
            $status = 200;
        }
        return response()->json($data, $status);
    }

    public function updateCategory( Request $request, Category $category )
    {
        $rules = [
            'id'=> 'required',
            'category' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        $token = $request->input('token');

        if($token != config('cust_constants.admin_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $result = $category->updateCategory($request->all());

        $status = 500;
        if($result['status'] == config('cust_constants.success'))
        {
            $status = 200;
        }
        return response()->json($result['result'], $status);
    }

    public function newCategory( Request $request, Category $category )
    {
        $rules = [
            'category'=> 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $token = $request->input('token');

        if($token != config('cust_constants.admin_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        $data = [];

        $data['category'] = $request->input('category');
        
        $result = $category->createCategory($data);

        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json(config('cust_constants.server_error'),500);    
        }
        return response()->json($result['result'],201);
    }

    // public function index()
    // {
    //     return response()->json(Category::get(),200);
    // }
    // public function store(Request $request)
    // {
    //     // $categoryText = $request->input('category');
    //     // dd($categoryText);
    //     $category = Category::create($request->all());
    //     return response()->json($category,201);
    // }
    // public function show($id)
    // {
    //     $category = Category::find($id);
    //     if(is_null($category))
    //     {
    //         return response()->json(null,404);
    //     }
    //     return response()->json($category,200);
    // }
    // public function delete($id)
    // {
    //     $category = Category::find($id);
    //     if(is_null($category))
    //     {
    //         return response()->json(null,404);
    //     }
    //     $category->delete();
    //     return response()->json(null,204);
    // }
    
}
