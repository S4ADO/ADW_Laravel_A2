@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><a href = "/settings">Settings</a> - Avatar</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div align = "center">
                        <label for="imageInput">Current avatar:</label><br/>
                        @if(Auth::user()->avatar == "")
                            <img src = "{{ asset('images/default_avatar.png') }}" height = "70" width = "70"/>
                        @else
                            <img src = "/avatars/{{Auth::user()->avatar}}"  height = "100" width = "100"/>
                        @endif
                        <br/><br/>
                        <form enctype="multipart/form-data" method="post" action="/settings/avatar/post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="imageInput">Upload an avatar</label>
                                <input data-preview="#preview" name="avatarin" type="file" id="avatarin" accept="image/x-png,image/gif,image/jpeg">
                            </div>
                            <input type = "submit" value = "submit">
                        </form>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
