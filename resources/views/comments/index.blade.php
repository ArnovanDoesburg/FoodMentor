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
                    <div class="panel-heading">Reacties</div>
                    <div class="panel-body">

                        <form method="GET" action="{{ url('/comments') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Zoeken..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Omschrijving</th><th>Acties</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->content }}</td>
                                        <td>
                                            <a href="{{ url('/comments/' . $item->id) }}" title="View Comment"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Toon</button></a>
                                            <a href="{{ url('/comments/' . $item->id . '/edit') }}" title="Reactie aanpassen"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Pas aan</button></a>

                                            <form method="POST" action="{{ url('/comments' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Reactie verwijderen" onclick="return confirm(&quot;Weet je het zeker?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Verwijder</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $comments->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
