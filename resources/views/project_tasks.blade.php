@extends('layouts.master')

@section('content')

    <h1>Project: {{ $project->name }}</h1>
    <h1>Hello world</h1>
    <h2>Taks:</h2>
    
    <div class="form-group">
        <label for="">Add New</label>
        <input type="text" name="" id="task-field"/>
        <button id="task-button">Add</button>
    </div>
    
    <ul>
    @foreach ($tasks as $task)
        <li class="task-name">
            {{ $task->name }}
            <button class="complete-button" id="task-{{ $task->id }}">Complete</button>
        </li>
    @endforeach
    </ul>

@endsection

@section('js')
<script type="text/javascript">
/* global $ */
$('#task-button').click(function(){
    $.ajax({
        url: '/projects/1/tasks',
        method: 'POST',
        data: { 
            name: ''
        }
    });
});
$('.complete-button').click(function(){
    alert("task complete");
    $(this).parent().remove();
    // add function to remove from list
})
</script>
@endsection
