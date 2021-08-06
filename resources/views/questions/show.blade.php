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
                            <a href="" title="This question is usefull" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1230</span>
                            <a title="This questio is not useful" class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Click to mark as favorite question" class="favorite favorited">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count"></span>
                            </a>
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
