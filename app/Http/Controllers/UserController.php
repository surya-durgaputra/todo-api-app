<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Validator;

class UserController extends Controller
{
    private function populateUser($old_user, $new_user)
    {
        $old_user->name = $new_user['name'];
        $old_user->email = $new_user['email'];
        $old_user->last_name = $new_user['last_name'];
        $old_user->token = config('cust_constants.user_token');
        if($new_user['is_admin'] == 1)
        {
            $old_user->token = config('cust_constants.admin_token');
        }
        return $old_user;
    }

    public function showUser( Request $request, User $user )
    {

        $rules = [
            'email'=> 'required',
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

        $email = $request->input('email');

        $result = $user->findByEmail($email);

        $status = 500;
        if($result['status'] == config('cust_constants.success'))
        {
            $status = 200;
        } 
        if(is_null($result['result'])) {
            $status = 400;
            $result['result'] = config('cust_constants.user_exit_error');
        }

        return response()->json($result['result'],$status); 
    }

    public function updateSettingsUser( Request $request, User $user )
    {

        $rules = [
            'name' => 'required',
            'id' =>'required',
            'last_name'=> 'required',
            'token' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }

        $token = $request->input('token');

        if($token != config('cust_constants.admin_token'))
        {
            if($token != config('cust_constants.user_token'))
            {
                return response()->json(config('cust_constants.authorization_error'),500);
            }
        }

        $result = $user->updateUserSettings($request);

        if($result['status'] == config('cust_constants.error'))
        {
            return response()->json($result['result'],500);       
        }
        return response()->json($result['result'],200);
    }

    public function updateUser( Request $request, User $user )
    {

        $rules = [
            'email'=> 'required',
            'name' => 'required',
            'is_admin' => 'required',
            'last_name'=> 'required',
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

        $email = $request->input('email');

        //first check if record exists
        $result = $user->findByEmail($email);

        $status = 500;
        if($result['status'] == config('cust_constants.success'))
        {
            $status = 200;
        } 
        if(is_null($result['result'])) {
            $status = 400;
            $result['result'] = config('cust_constants.user_exit_error');
        }

        if($status != 200)
        {
            return response()->json($result['result'],$status);
        }

        //now do the update
        $old_record = $result['result'];
        $new_record = $request->all();
        //reset result array
        $result = [];
        $status = 500;
        
        $result = $user->updateUser($this->populateUser($old_record, $new_record));
        if($result['status'] == config('cust_constants.success'))
        {
            $status = 200;
        }
        return response()->json($result['result'],$status); 
    }

    public function showUsers( Request $request, User $user )
    {
        $token = $request->input('token');

        if($token != config('cust_constants.admin_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        $result = $user->getAllUsers();

        $status = 500;
        if($result['status'] == config('cust_constants.success'))
        {
            $status = 200;
        }
        return response()->json($result['result'],$status); 
    }

    public function newUser( Request $request, User $user )
    {
        $rules = [
            'email'=> 'required',
            'name' => 'required',
            'last_name'=> 'required',
            'password'=>'required',
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

        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['email'] = $request->input('email');
        $data['is_admin'] = 0;
        if($request->input('is_admin')=='1')
        {
            $data['is_admin'] = 1;
        }
        
        $result = $user->createUser($data);

        $person = $result['result'];
        $status = $result['status'];

        if($status == config('cust_constants.error'))
        {
            return response()->json(config('cust_constants.server_error'),500);    
        }
        return response()->json($person,201);
    }

    public function deleteUsers(Request $request, User $user)
    {
        $token = $request->input('token');

        if($token != config('cust_constants.admin_token'))
        {
            return response()->json(config('cust_constants.authorization_error'),500);
        }

        $result = [];
        $result = $user->deleteUsers($request->input('ids'));

        $status = 500;
        if($result['status'] == config('cust_constants.success'))
        {
            $status = 200;
        }
        if($result['result'] == 0)
        {
            $status = 400;
        }

        return response()->json($result['result'],$status);
    }

    public function login(Request $request, User $user)
    {
        $rules = [
            'email'=> 'required|min:3',
            'password' => 'required|min:5'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return response()->json($validator->errors(),500);
        }
        $email = $request->input('email');
        $password = $request->input('password');

        $result = $user->userLogin($email, $password);
        $person = $result['result'];
        $status = $result['status'];

        if(is_null($person))
        {
            return response()->json(config('cust_constants.user_exit_error'),400);    
        } elseif($status==config('cust_constants.error')) {
            return response()->json(config('cust_constants.server_error'),500);
        } 
        
        $data = [];
        $data['name'] = $person->name;
        $data['last_name'] = $person->last_name;
        $data['token'] = $person->token;
        $data['email'] = $person->email;
        
        return response()->json($data,200);
    }
}
