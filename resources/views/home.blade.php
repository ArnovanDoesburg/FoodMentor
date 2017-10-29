@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (\Session::has('flash_message'))
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {!! \Session::get('flash_message') !!}
                        </div>
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">Uitgelicht</div>

                    <div class="panel-body cards-highlight">
                        @foreach ($highlights as $highlight)
                            <div class="card col-md-4">
                                <div class="card-block">
                                    <h4 class="card-title">{{ $highlight->title }}</h4>
                                    <p class="card-text">{{ \App\Helpers::limitString($highlight->body, 100) }}</p>
                                    <i>door {{\App\Helpers::getUserNameById($highlight->user_id)}}
                                        op {{ App\Helpers::formatDate($highlight->created_at) }}</i>
                                    <p></p>
                                    <a href="{{ url('/foodlists/' . $highlight->id) }}" class="btn btn-primary">Toon</a>
                                    <p></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-12 block-categories">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn @if(!isset($_GET["category"])) btn-primary @else btn-default @endif"><a href="/home">Toon alles</a></button>
                            @foreach($categories as $category)
                                <button type="button" class="btn @if(\App\Helpers::isCurrentCategory($category->id)) btn-primary @else btn-default @endif">
                                    <a href="/home/?category={{ $category->id }}">{{ $category->description }}</a>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="panel-body cards-normal">
                        @foreach ($foodlists as $foodlist)
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title">{{ $foodlist->title }}</h4>
                                    <p class="card-text">{{ $foodlist->body }}</p>
                                    <p class="card-text">{{ $foodlist->name }}</p>
                                    <i>door {{\App\Helpers::getUserNameById($foodlist->user_id)}}
                                        op {{ App\Helpers::formatDate($foodlist->created_at) }} </i>
                                    <p></p>
                                    <a href="{{ url('/foodlists/' . $foodlist->id) }}" class="btn btn-primary">Toon</a>
                                    <p></p>
                                    <hr>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
