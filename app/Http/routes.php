<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('/projects/{project_id}/tasks', function($project_id) use ($app) {
    $project = \App\Models\Project::find($project_id);
    $tasks = \App\Models\Task::select('*')->where('project_id', $project_id)->get();
    return view('project_tasks', ['project' => $project, 'tasks' => $tasks]);
});

$app->post('/projects/{project_id}/tasks', function($project_id) use ($app) {
    return "creating new task";
});

$app->put('/projects/{project_id}/tasks/{task_id}', function($project_id, $task_id) use ($app) {
    return "updating task";
});
