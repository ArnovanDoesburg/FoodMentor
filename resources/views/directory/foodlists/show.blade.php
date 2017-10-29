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
                    <div class="panel-heading"><h2>{{ $foodlist->title }}</h2></div>
                    <div class="panel-body">

                        <a href="{{ url('/home') }}" title="Back">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Terug
                            </button>
                        </a>

                        @if(\App\Helpers::isAuthorsFoodlist($foodlist, Auth::user()) || \App\Helpers::checkRole(Auth::user(), array("Admin")))
                        <a href="{{ url('/foodlists/' . $foodlist->id . '/edit')}}" title="Edit foodlist">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Pas aan
                            </button>
                        </a>
                        @endif

                        @if(\App\Helpers::checkRole(Auth::user(), array("Admin", "Foodmentor")))
                            <form class="pull-right" method="get"
                                  action="{{ route('foodlist.highlight', $foodlist->id) }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary btn-xs">
                                    @if ($foodlist->highlighted == 0)
                                        Uitlichten
                                    @else
                                        Niet meer uitlichten
                                    @endif
                                </button>
                            </form>
                        @endif


                        @if(\App\Helpers::checkRole(Auth::user(), array('Admin')))
                        <form method="POST" action="{{ url('foodlists' . '/' . $foodlist->id) }}" accept-charset="UTF-8"
                              style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete foodlist"
                                    onclick="return confirm(&quot;Weet je het zeker?&quot;)"><i class="fa fa-trash-o"
                                                                                                aria-hidden="true"></i>
                                Verwijder
                            </button>
                        </form>
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <p>{{ $foodlist->body }}</p>
                            <p><i>Geschreven door {{ \App\Helpers::getUserNameById($foodlist->user_id) }}</i></p>
                        </div>

                        <div>
                            <form method="post" action="{{ route('comments.store') }}">
                                {{ csrf_field() }}
                                <div class="form-group">

                                    <input type="hidden" id="comment-name" name="name"
                                           value="{{ Auth::user()->name }}"/>
                                    <input type="hidden" id="comment-commentableid" name="commentable_id"
                                           value="{{ $foodlist->id }}"/>
                                    <input type="hidden" id="comment-userid" name="user_id"
                                           value="{{ Auth::user()->id }}"/>

                                    <textarea placeholder="Plaats hier jouw reactie..."
                                              style="resize: vertical"
                                              id="comment-content"
                                              name="content"
                                              rows="5" spellcheck="false"
                                              class="form-control autosize-target text-left">
                                    </textarea>
                                    <p></p>
                                    <button type="submit" class="btn btn-primary">
                                        Plaats
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div>
                            @foreach ($comments as $comment)
                                <div>
                                    <p>{{ $comment->content }}</p>
                                    <i>door {{ \App\Helpers::getUserNameById($comment->user_id) }}
                                        op {{ \App\Helpers::toDutchString($comment->created_at) }}</i>
                                    <hr/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
