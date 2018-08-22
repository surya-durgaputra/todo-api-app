<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Priority extends Model
{
    use SoftDeletes;
    protected $table = 'priority';
    protected $dates = ['deleted_at'];
    protected $fillable = ['priority'];
    //

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

    public function getPriority($id)
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

    public function createPriority($data)
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

    public function updatePriority($data)
    {
        $result = NULL;
        try {
            $priority = $this->find($data['id']);
            $priority->priority = $data['priority'];
            $result['result'] = $priority->save();;
            $result['status'] = config('cust_constants.success');
        }
        catch (\Exception $e) {
            $result['result'] = config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
        }

        return $result;
    }
}
