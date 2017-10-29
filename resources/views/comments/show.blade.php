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
                    <div class="panel-heading">Reactie {{ $comment->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/comments') }}" title="Terug"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Terug</button></a>
                        <a href="{{ url('/comments/' . $comment->id . '/edit') }}" title="Reactie aanpassen"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Pas aan</button></a>

                        <form method="POST" action="{{ url('comments' . '/' . $comment->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Verwijder reactie" onclick="return confirm(&quot;Weet je het zeker?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Verwijder</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $comment->id }}</td>
                                    </tr>
                                    <tr><th> Content </th><td> {{ $comment->content }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
