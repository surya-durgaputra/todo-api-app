<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Priority;
use Validator;

class PriorityController extends Controller
{
    public function showPriorities( Request $request, Priority $priority )
    {
        
        $result = $priority->getAll();

        $status = 500;
        if($result['status'] == config('cust_constants.success'))
        {
            $status = 200;
        }
        return response()->json($result['result'],$status); 
    }

    public function showPriority( Request $request, Priority $priority )
    {
        $rules = [
            'id'=> 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $result = $priority->getPriority($request->input('id'));

        $status = 500;
        if($result['status'] == config('cust_constants.success'))
        {
            $data=[];
            $data['id'] = $result['result']['id'];
            $data['priority'] = $result['result']['priority'];
            $status = 200;
        }
        return response()->json($data, $status);
    }

    public function updatePriority( Request $request, Priority $priority )
    {
        $rules = [
            'id'=> 'required',
            'priority' => 'required'
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

        $result = $priority->updatePriority($request->all());

        $status = 500;
        if($result['status'] == config('cust_constants.success'))
        {
            $status = 200;
        }
        return response()->json($result['result'], $status);
    }

    public function newPriority( Request $request, Priority $priority )
    {
        $rules = [
            'priority'=> 'required',
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

        $data['priority'] = $request->input('priority');
        
        $result = $priority->createPriority($data);

        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json(config('cust_constants.server_error'),500);    
        }
        return response()->json($result['result'],201);
    }

    // public function index()
    // {
    //     return response()->json(Priority::get(),200);
    // }
    // public function store(Request $request)
    // {
    //     $priority = Priority::create($request->all());
    //     return response()->json($priority,201);
    // }
    // public function delete($id)
    // {
    //     $priority = Priority::find($id);
    //     if(is_null($priority))
    //     {
    //         return response()->json(null,404);
    //     }
    //     $priority->delete();
    //     return response()->json(null,204);
    // }

}
