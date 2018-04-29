@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Task</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($task != null)
                        <form method = "POST" id = "editpost" action = "/home/edit">
                            {{ csrf_field() }}
                            <input type = "hidden" name = "taskid" value = "{{$task->id}}">
                            <table class="table table-striped">
                                <tr>
                                    <th>Date added</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Date to Complete</th>
                                    <th>Completed</th>    
                                    <th>Save</th>     
                                </tr>
                                <tr>
                                    <td> {{$task->created_at}} </td>
                                    <td contenteditable='true'><input name="title" id="title" type = "text" value="{{$task->title}}" required></td>
                                    <td contenteditable='true'>
                                        <textarea rows="4" cols="50" name = "body" form="editpost" required>{{$task->body}}</textarea>
                                    </td>
                                    <td><input name="date" id="date" type = "datetime-local" value = "{{ date("Y-m-d\TH:i:s", strtotime($task->complete_date)) }}" required></td>
                                    <td> <input type="checkbox" name="completecb" value="checked" {{$task->complete == 0 ? '' : 'checked'}} > </td>
                                    <td> 
                                    <input type = "submit" value = "save">
                                </tr>
                            </table>
                        </form>   
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
