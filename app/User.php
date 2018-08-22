<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 
        'token', 'expires_on', 'last_name', 'is_admin'
    ];


    protected $dates = ['deleted_at'];

    protected $table = 'user';

    public function findByEmail($email){
        $result = [];
        try {
            $result['result'] = $this->where('email', '=',$email)->first();
            $result['status'] = config('cust_constants.success');
          }
          catch (\Exception $e) {
            $result['result']=config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
          }

        return $result;
    }

    public function getAllUsers()
    {
        $result = [];
        try {
            $result['result'] = $this->all();
            $result['status'] = config('cust_constants.success');
          }
          catch (\Exception $e) {
            $result['result']=config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
          }

        return $result;
    }

    public function updateUser($user)
    {
        $result = [];
        try {
            $result['result'] = $user->save();
            $result['status'] = config('cust_constants.success');
          }
          catch (\Exception $e) {
            $result['result']= $e;
            $result['status'] = config('cust_constants.error');
          }

        return $result;
    }

    public function updateUserSettings($request)
    {
        $id = $request->input('id');

        $result = [];
        try {
            $user = $this->where('id','=',$id)->get()->first();
            if(!is_null($user))
            {
                $user->name = $request->input('name');
                $user->last_name =$request->input('last_name');
                $result['result'] = $user->save();
                $result['status'] = config('cust_constants.success');
            }
            else
            {
                $result['result'] = config('cust_constants.user_create_error');;
                $result['status'] = config('cust_constants.error');
            }
            
          }
          catch (\Exception $e) {
            $result['result']= $e;
            $result['status'] = config('cust_constants.error');
          }

        return $result;
    }

    public function deleteUsers($ids)
    {
        $result = [];
        try {
            $result['result'] = $this->destroy($ids);
            $result['status'] = config('cust_constants.success');
          }
          catch (\Exception $e) {
            $result['result']= $e;
            $result['status'] = config('cust_constants.error');
          }

        return $result;
    }

    public function userLogin($email, $password){
        /*
        Here we will make an api call to the external login service 
        provider and will be returned a token for successful login
        that we will cache in local db
        */

        return $this->findByEmail($email);    
    }

    public function createUser($data)
    {
        /*
        Here we will make an api call to the external login service 
        provider and register user and will be returned a token.
        We also store the user email in the local db.
        */
        $data['token'] = config('cust_constants.user_token');
        
        if($data['is_admin']=='1')
        {
            $data['token'] = config('cust_constants.admin_token');
        }
        
        $result = NULL;
        try {
            $result['result'] = $this->create($data);
            $result['status'] = config('cust_constants.success');
        }
        catch (\Exception $e) {
            $result['result'] = config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
        }

        return $result;
    }
    
}
