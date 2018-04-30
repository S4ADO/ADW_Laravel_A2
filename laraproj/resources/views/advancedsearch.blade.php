@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Advanced Search</div>
                    <div class="panel-body">
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($post == "no")
                            <form method = "POST" action = "/advancedsearchpost" id = "createpost">
                                {{ csrf_field() }}

                                <label for="added">Date added</label><br>
                                <input name="added" id="added" type = "datetime-local">
                                <select name="addedexact">
                                    <option value="exact">Exact</option>
                                    <option value="more">Greater than</option>
                                    <option value="less">Less than</option>
                                </select><br/>

                                <label for="title">Title</label><br>
                                <input name="title" id="title" type = "text" placeholder="Search title"> Search exact <input type="checkbox" name="titleexact" value="checked"><br/>

                                <label for="body">Body</label><br>
                                <textarea rows="4" cols="50" name = "body" form="createpost" placeholder="Input task body"></textarea>Search exact <input type="checkbox" name="bodyexact" value="checked"><br>

                                <label for="importance">Importance (1-5)</label><br>
                                <input name="importance" id="importance" type = "number" min="1" max="5">
                                <select name="importanceexact">
                                    <option value="exact">Exact</option>
                                    <option value="more">Greater than</option>
                                    <option value="less">Less than</option>
                                </select><br>

                                <label for="completed">Completed</label><br>
                                <input name="completed" id="completed" type = "checkbox">
                                <select name="completedexact">
                                    <option value="noearch">Dont search</option>
                                    <option value="search">Search</option>
                                </select><br/>

                                <label for="done">Completion Date</label><br>
                                <input name="done" id="date" type = "datetime-local">
                                <select name="doneexact">
                                    <option value="exact">Exact</option>
                                    <option value="more">Greater than</option>
                                    <option value="less">Less than</option>
                                </select><br><br>

                                <input type = "submit" value = "submit">
                            </form>  
                        @else
                            @if (sizeof($tasks) != 0 )
                            <table class="table table-striped">
                                    <tr>
                                        <th>Date added</th>  
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Importance</th>   
                                        <th>Date to Complete</th>
                                        <th>Completed</th> 
                                        <th>Edit</th>
                                        <th>Delete</th>         
                                    </tr>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td> {{$task->created_at}} </td>
                                        <td> {{$task->title}} </td>
                                        <td> <?php print $task->body ?> </td>
                                        <td> {{$task->importanceid}} ({{$task->importance}}) </td>
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
                                <p>No tasks where found</p>    
                            @endif
                        @endif      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
