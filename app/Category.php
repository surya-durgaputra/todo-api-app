<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;
    protected $table = 'category';
    protected $dates = ['deleted_at'];
    protected $fillable = ['category'];

    public function createCategory($data)
    { 
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

    public function getCategory($id)
    {
        $result = NULL;
        try {
            $result['result'] = $this->find($id);
            $result['status'] = config('cust_constants.success');
        }
        catch (\Exception $e) {
            $result['result'] = config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
        }

        return $result;
    }

    public function updateCategory($data)
    {
        $result = NULL;
        try {
            $category = $this->find($data['id']);
            $category->category = $data['category'];
            $result['result'] = $category->save();;
            $result['status'] = config('cust_constants.success');
        }
        catch (\Exception $e) {
            $result['result'] = config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
        }

        return $result;
    }

    public function getAll()
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
    
}
