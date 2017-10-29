@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @if (\Session::has('flash_message'))
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! \Session::get('flash_message') !!}
                    </div>
                </div>
            @endif

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Nieuwe reactie</div>
                    <div class="panel-body">
                        <a href="{{ url('/comments') }}" title="Terug"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Terug</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/comments') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('comments.form')

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
