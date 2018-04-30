@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Settings</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div align = "center">
                        <div class="links">
                            <a href = "/settings/avatar">Upload an avatar</a>
                            <br/><br/>
                            <a href = "/settings/statistics">View task statistics</a>
                            <br/><br/>
                        </div>    
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
