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
                            <br/>
                            <a href = "/advancedsearch"/>Advanced Search</a>
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
                                <th><a href = "/home/added"/>Date added</a></th>  
                                <th>Title</th>
                                <th>Body</th>
                                <th><a href = "/home/importance"/>Importance</a></th>   
                                <th><a href = "/home/completed"/>Date to Complete</a></th>
                                <th><a href = "/home/complete"/>Completed</a></th> 
                                <th>Edit</th>
                                <th>Delete</th>        
                            </tr>
                        @foreach($tasks as $task)
                            <tr>
                                <?php
                                    //Highlight completion dates past their time
                                    if($task->complete_date < date("Y-m-d H:i:s") && !$task->complete)
                                    {
                                        $task->complete_date = "<font color = red>" . $task->complete_date . "</font>";
                                    }
                                ?>
                                <td> {{$task->created_at}} </td>
                                <td> {{$task->title}} </td>
                                <td> {{$task->body}} </td>
                                <td> {{$task->importanceid}} ({{$task->importance}}) </td>
                                <td> <?php print $task->complete_date ?> </td>
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
                    <div class="links">
                        <a href = "/home/create">Create task</a>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
