@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Task</div>
                    <div class="panel-body">
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                    <form method = "POST" action = "/home/post" id = "createpost">
                        {{ csrf_field() }}

                        <label for="title">Title</label><br>
                        <input name="title" id="title" type = "text" placeholder="Input title" required><br>

                        <label for="body">Body</label><br>
                        <textarea rows="4" cols="50" name = "body" form="createpost" placeholder="Input task body" required></textarea><br>

                        <label for="date">Completion Date</label><br>
                        <input name="date" id="date" type = "datetime-local" required><br><br>

                        <input type = "submit" value = "submit">
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
