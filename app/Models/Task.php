<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    protected $table = 'tasks';
    
    public static function byProjectId($project_id, $completed = NULL) {
        
        if ($completed == true) {
            tasks = DB::table('tasks')
            ->where('project_id', $project_id)
            ->where('completed', 'true')
            ->orderBy('created_at', 'asc')
            ->get();
            
            return tasks;
        }else if($completed == false){
            
            tasks = DB::table('tasks')
            ->where('project_id', $project_id)
            ->where('completed', 'false')
            ->orderBy('created_at', 'asc')
            ->get();
            
            return tasks;
        }else {
            tasks = DB::table('tasks')
            ->where('project_id', $project_id)
            ->orderBy('created_at', 'asc')
            ->get();
            
            return tasks;
        }
        
    }
    
    public function store(Request $request)
    {

        $request->session()->flash('ERROR_MESSAGE', 'Recipe was not saved.');
        $this->validate($request, Recipe::$rules);
        $request->session()->forget('ERROR_MESSAGE');

        $task = new Task();
        $task->project_id = $request->project_id;
        $task->name = $request->name;
        $task->slug = $request->slug;
        $task->description = $request->description;
        $task->save();
        $data['task'] = $task;

        $request->session()->flash('SUCCESS_MESSAGE', 'Recipe was SAVED successfully');


        return redirect("recipes/".$recipe->id."/edit")->with($data);
    }

}