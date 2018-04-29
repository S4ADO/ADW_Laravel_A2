@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tasks
                    <div align = "center">
                        <form action = "/home/search" method = "POST">
                            {{ csrf_field() }}
                            <input type = "text" name = "search" placeholder = "Search task bodies">
                            <input type="image" height = "15" width = "15" src="https://www.alrightnow.com/wp-content/themes/alright/img/search-icon.png" alt="Submit Form" />
                        </form>
                    </div>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (sizeof($tasks) != 0 )
                    <table class="table table-striped">
                            <tr>
                                <th>Date added</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Date to Complete</th>
                                <th>Completed</th>    
                                <th>Edit</th>
                                <th>Delete</th>        
                            </tr>
                        @foreach($tasks as $task)
                            <tr>
                                <td> {{$task->created_at}} </td>
                                <td> {{$task->title}} </td>
                                <td> {{$task->body}} </td>
                                <td> {{$task->complete_date}} </td>
                                <td> {{$task->complete == 0 ? 'No' : 'Yes'}} </td>
                                <td> <a href = "/home/edit/{{$task->id}}">Edit</a> </td>
                                <td> 
                                    <form action = "/home/delete" method = "POST">
                                        {{ csrf_field() }}
                                        <input type = "hidden" name = "taskid" value = "{{$task->id}}">
                                        <input type = "Submit" value = "Delete">
                                    </form> 
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                        <p>You have no current tasks</p>    
                    @endif
                    <a href = "/home/create">create task</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
