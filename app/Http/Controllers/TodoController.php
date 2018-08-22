<?php

namespace App\Http\Controllers;
use App\Todo;
use Validator;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function newTodo( Request $request, Todo $todo )
    {
        $rules = [
            'end_date'=> 'required',
            'start_date'=> 'required',
            'title'=> 'required|min:5',
            'description'=> 'required|min:10',
            'category_id'=> 'required',
            'priority_id'=> 'required',
            'user_id'=> 'required',
            'token' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $token = $request->input('token');

        if($token != config('cust_constants.user_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }
        
        $result = $todo->createTodo($request);

        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json($result['result'],500);   
            //return response()->json(config('cust_constants.server_error'),500);    
        }
        return response()->json($result['result'],201);
    }

    public function showTrashedTodos(Request $request, Todo $todo)
    {
        $rules = [
            'user_id'=> 'required',
            'token' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $token = $request->input('token');

        if($token != config('cust_constants.user_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        $result = $todo->showTrashedTodos($request);

        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json($result['result'],500);       
        }
        return response()->json($result['result'],200);
    }

    public function searchTitleTodos(Request $request, Todo $todo)
    {
        $rules = [
            'user_id'=> 'required',
            'search_text' => 'required',
            'token' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $token = $request->input('token');

        if($token != config('cust_constants.user_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        $result = $todo->searchTitleTodos($request);

        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json($result['result'],500);       
        }
        return response()->json($result['result'],200);
    }

    public function showTodo(Request $request, Todo $todo)
    {
        $rules = [
            'id' => 'required',
            'user_id'=> 'required',
            'token' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $token = $request->input('token');

        if($token != config('cust_constants.user_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        $result = $todo->showTodo($request);

        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json($result['result'],500);       
        }
        return response()->json($result['result'],200);
    }

    public function restoreTodos(Request $request, Todo $todo)
    {
        $rules = [
            'ids' => 'required',
            'user_id'=> 'required',
            'token' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $token = $request->input('token');

        if($token != config('cust_constants.user_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        $result = $todo->restoreTodos($request);

        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json($result['result'],500);       
        }
        return response()->json($result['result'],200);
    }

    public function deleteTodos(Request $request, Todo $todo)
    {
        $rules = [
            'ids' => 'required',
            'user_id'=> 'required',
            'token' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $token = $request->input('token');

        if($token != config('cust_constants.user_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        $result = $todo->deleteTodos($request);

        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json($result['result'],500);       
        }
        return response()->json($result['result'],200);
    }

    public function forceDeleteTodos(Request $request, Todo $todo)
    {
        $rules = [
            'ids' => 'required',
            'user_id'=> 'required',
            'token' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $token = $request->input('token');

        if($token != config('cust_constants.user_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        $result = $todo->forceDeleteTodos($request);

        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json($result['result'],500);       
        }
        return response()->json($result['result'],200);
    }

    public function updateTodo(Request $request, Todo $todo)
    {
        $rules = [
            'id' => 'required',
            'end_date'=> 'required',
            'start_date'=> 'required',
            'title'=> 'required|min:5',
            'description'=> 'required|min:10',
            'category_id'=> 'required',
            'priority_id'=> 'required',
            'user_id'=> 'required',
            'token' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $token = $request->input('token');

        if($token != config('cust_constants.user_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        $result = $todo->updateTodo($request);

        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json($result['result'],500);       
        }
        return response()->json($result['result'],200);
    }

    public function showAllTodos(Request $request, Todo $todo)
    {
        $rules = [
            'user_id'=> 'required',
            'token' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $token = $request->input('token');

        if($token != config('cust_constants.user_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        $result = $todo->showAllTodos($request);

        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json($result['result'],500);   
            //return response()->json(config('cust_constants.server_error'),500);    
        }
        return response()->json($result['result'],200);
    }

    public function showPendingTodos(Request $request, Todo $todo)
    {
        $rules = [
            'user_id'=> 'required',
            'token' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $token = $request->input('token');

        if($token != config('cust_constants.user_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        $result = $todo->showPendingTodos($request);
        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json($result['result'],500);   
        }
        return response()->json($result['result'],200);
    }
}
