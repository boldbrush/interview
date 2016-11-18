<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class taskController extends BaseController
{
    
    public function index()
    {
        $data['tasks'] = TASK::find($id);
        return view('project_tasks')->with($data);
    }
    
    
    public function addTask(Request $request)
    {
        $task = new Task;
        $task->name = $request->get('name');
        $task->save();
    
        $request->session()->flash('SUCCESS_MESSAGE', 'Task was saved successfully');
        return redirect()->action('taskController@index');
    }
}