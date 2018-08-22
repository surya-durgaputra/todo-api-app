<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Todo extends Model
{
    use SoftDeletes;
    protected $table = 'todo';
    protected $dates = ['deleted_at'];
    protected $fillable = ['end_date','start_date',
                            'title','description',
                            'category_id', 'user_id',
                            'priority_id'  
                        ];

    public function createTodo($request)
    {
        $data = [];
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $data['end_date'] = $request->input('end_date');
        $data['start_date'] = $request->input('start_date');
        $data['title'] = $request->input('title');
        $data['description'] = $request->input('description');
        $data['category_id'] = $request->input('category_id');
        $data['user_id'] = $request->input('user_id');
        $data['priority_id'] = $request->input('priority_id');

        $result = NULL;
        try {
            $result['result'] = $this->create($data);
            $result['status'] = config('cust_constants.success');
        }
        catch (\Exception $e) {
            $result['result'] = $e;//config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
        }

        return $result;
    }

    public function restoreTodos($request)
    {
        $user_id = $request->input('user_id');
        $ids = $request->input('ids');

        $result = [];
        try {
            $result['result'] = $this->where('user_id','=', $user_id)
                                ->whereIn('id', $ids)
                                ->restore();
            $result['status'] = config('cust_constants.success');
          }
          catch (\Exception $e) {
            $result['result']= $e;
            $result['status'] = config('cust_constants.error');
          }

        return $result;
    }

    public function deleteTodos($request)
    {
        $user_id = $request->input('user_id');
        $ids = $request->input('ids');

        $result = [];
        try {
            $result['result'] = $this->where('user_id','=', $user_id)
                                ->whereIn('id', $ids)
                                ->delete();
            $result['status'] = config('cust_constants.success');
          }
          catch (\Exception $e) {
            $result['result']= $e;
            $result['status'] = config('cust_constants.error');
          }

        return $result;
    }

    public function forceDeleteTodos($request)
    {
        $user_id = $request->input('user_id');
        $ids = $request->input('ids');

        $result = [];
        try {
            $result['result'] = $this->where('user_id','=', $user_id)
                                ->whereIn('id', $ids)
                                ->forceDelete();
            $result['status'] = config('cust_constants.success');
          }
          catch (\Exception $e) {
            $result['result']= $e;
            $result['status'] = config('cust_constants.error');
          }

        return $result;
    }

    public function updateTodo($request)
    {
        $user_id = $request->input('user_id');
        $id = $request->input('id');

        $result = NULL;
        try {
            $todo = $this->where('user_id','=', $user_id)
                            ->where('id','=', $id)
                            ->get()
                            ->first();
            if(!is_null($todo))
            {
                $todo->end_date = $request->input('end_date');
                $todo->start_date = $request->input('start_date');
                $todo->title = $request->input('title');
                $todo->description = $request->input('description');
                $todo->category_id = $request->input('category_id');
                $todo->priority_id = $request->input('priority_id');
                
                $result['result'] = $todo->save();
                $result['status'] = config('cust_constants.success');
            }
            else{
                $result['result'] = config('cust_constants.user_create_error');
                $result['status'] = config('cust_constants.error');
            }
        }
        catch (\Exception $e) {
            $result['result'] = $e;//config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
        }

        return $result;
    }

    public function showTodo($request)
    {
        $user_id = $request->input('user_id');
        $id = $request->input('id');

        $result = NULL;
        try {
            $result['result'] = $this->where('user_id','=', $user_id)
                                ->where('id','=', $id)
                                ->get();
            $result['status'] = config('cust_constants.success');
        }
        catch (\Exception $e) {
            $result['result'] = $e;//config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
        }

        return $result;
    }

    public function showTrashedTodos($request)
    {

        $user_id = $request->input('user_id');
        $sort_by =is_null($request->input('sort_by')) ? 'end_date' : $request->input('sort_by');

        $result = NULL;
        try {
            $result['result'] = $this->where('user_id','=', $user_id)
                                ->onlyTrashed()
                                ->orderBy($sort_by,'desc')
                                ->get();
            $result['status'] = config('cust_constants.success');
        }
        catch (\Exception $e) {
            $result['result'] = $e;//config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
        }

        return $result;
    }

    public function searchTitleTodos($request)
    {
        $user_id = $request->input('user_id');
        $search_text = '%' . $request->input('search_text') . '%';

        $sort_by =is_null($request->input('sort_by')) ? 'end_date' : $request->input('sort_by');

        $result = NULL;
        try {
            $result['result'] = $this->where('user_id','=', $user_id)
                                ->where('title','LIKE', $search_text)
                                ->orderBy($sort_by,'desc')
                                ->get();
            $result['status'] = config('cust_constants.success');
        }
        catch (\Exception $e) {
            $result['result'] = $e;//config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
        }

        return $result;
    }

    public function showAllTodos($request)
    {

        $user_id = $request->input('user_id');
        $sort_by =is_null($request->input('sort_by')) ? 'end_date' : $request->input('sort_by');

        $result = NULL;
        try {
            $result['result'] = $this->where('user_id','=', $user_id)
                                ->orderBy($sort_by,'desc')
                                ->get();
            $result['status'] = config('cust_constants.success');
        }
        catch (\Exception $e) {
            $result['result'] = $e;//config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
        }

        return $result;
    }

    public function showPendingTodos($request)
    {

        $user_id = $request->input('user_id');
        $sort_by =is_null($request->input('sort_by')) ? 'end_date' : $request->input('sort_by');
        $result = NULL;
        try {
            $result['result'] = $this->where('user_id','=', $user_id)
                                ->where('end_date','>',Carbon::today()->format('Y-m-d'))
                                ->orderBy($sort_by,'desc')
                                ->get();
            $result['status'] = config('cust_constants.success');
        }
        catch (\Exception $e) {
            $result['result'] = $e;//config('cust_constants.server_error');
            $result['status'] = config('cust_constants.error');
        }

        return $result;
    }
}
