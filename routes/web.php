<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->version();
});

$router->get('/projects/{project_id}/tasks', function($project_id) use ($router) {
    $project = \App\Models\Project::find($project_id);
    $tasks = \App\Models\Task::select('*')->where('project_id', $project_id)->get();
    return view('project_tasks', ['project' => $project, 'tasks' => $tasks]);
});

$router->post('/projects/{project_id}/tasks', function($project_id) use ($router) {
    return "creating new task";
});

$router->put('/projects/{project_id}/tasks/{task_id}', function($project_id, $task_id) use ($router) {
    return "updating task";
});
