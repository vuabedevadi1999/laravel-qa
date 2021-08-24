@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{ $question->title }}</h2>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all question</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a href="" title="This question is usefull" 
                            class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault();document.getElementById('up-votes-question-{{$question->id}}').submit();"
                            >
                            <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form id="up-votes-question-{{$question->id}}" action="/questions/{{ $question->id }}/vote" method="POST" style="display: none">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count">{{ $question->votes_count }}</span>
                            <a title="This questio is not useful" 
                            class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault();document.getElementById('down-votes-question-{{$question->id}}').submit();"
                            >
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form id="down-votes-question-{{$question->id}}" action="/questions/{{ $question->id }}/vote" method="POST" style="display: none">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            <a title="Click to mark as favorite question"
                             class="favorite {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }}"
                             onclick="event.preventDefault();document.getElementById('favorite-question-{{$question->id}}').submit();"
                             >
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">{{ $question->favorites_count }}</span>
                            </a>
                            <form id="favorite-question-{{$question->id}}" action="/questions/{{ $question->id }}/favorites" method="POST" style="display: none">
                                @csrf
                                @if ($question->is_favorited)
                                    @method('DELETE')
                                @endif
                            </form>
                        </div>
                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">
                                    Answered {{ $question->create_date }}
                                </span>
                                <div class="media mt-2">
                                    <a href="{{ $question->user->url }}">
                                        <img src="{{ $question->user->avatar }}" alt="">
                                    </a>
                                    <div class="media-body mt-1 ml-1">
                                        <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._index',[
        'answersCount'=>$question->answers_count,
        'answers'=> $question->answers
        ])
    @include('answers._create')
</div>
@endsection
