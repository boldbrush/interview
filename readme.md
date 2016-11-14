## BoldBrush ToDo App

One of our developers has moved to Timbuktu and has left unfinished a very 
important project. You have inherited this application and is now your 
oportunity to shine by implemeting some very important missing features.

The app is available in this URL: https://boldbrush-interview-app-rickycheers1.c9users.io

### Backend Features Needed

First of all, we need to be able to filter project tasks by status 
(completed or uncompleted) when a parameter is passed in the URL.

For example:

- `/projects/1/tasks?status=completed`
- `/projects/1/tasks?status=uncompleted`

If no `status` parameter is passed in the URL, then we should 
display all the tasks associated with a given project no matter their status.

To achieve that, we want to refactor the code in the route controller to be
a little more reusable. We would like to be able to write the following code in 
order to retrieve the appropriate tasks: `Task::byProjectId($project_id, $completed)`

> Hint: Implement in the following file `app/Models/Task.php`

The application also needs to be able to receive POST requests in order to create
new project taks. (`POST /projects/1/tasks name=The task name`)

We also need to provide the application with a way for updating tasks.
Specifically, we want to mark a given task as completed. (`PUT /projects/1/tasks/1 completed=true`)

> Hint: Implement in the following file `app\Http\routes.php`

## Front-end Features Needed

The front-end code will also need to be updated with the following features.

Since now we're going to be able to filter tasks by 'status', we need to show
that in the user interface. Add some kind of label to the template to let the 
user know about it.

> File: app\resources\views\project_tasks.blade.php

The user interface has a field to create tasks, but as you may already imagine by now, 
it doesn't do anything... (sigh) 

Let's write the needed JS code in order to create tasks via AJAX requests.
It would be nice if when a user clicks on the 'Add' button, the field clears out
and a task is automatically appended to the list of tasks.

Finally, we need to be able to complete tasks via the user interface. For that, 
execute an AJAX call to the `PUT` endpoint every time the user clicks on the
'complete' button of each task. When the button is clicked, the task should be
removed from the list as well.
