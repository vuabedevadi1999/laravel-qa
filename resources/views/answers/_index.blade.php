<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " ". str_plural('Answer',$answersCount) }}</h2>
                </div>
                <hr>
                @include('layouts._messages')
                @foreach ($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a href="" title="This answer is usefull" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1230</span>
                            <a title="This answer is not useful" class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Mark this answer as best answer" 
                            class="{{ $answer->status }} mt-2"
                            onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit()"
                            >
                                <i class="fas fa-check fa-2x"></i>
                            </a>
                            <form id="accept-answer-{{ $answer->id }}"  method="POST" style="display: none">
                                @csrf

                            </form>
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update',$answer){{--nếu dùng cách 2 đổi update-question bằng update(tên hàm để authorization việc cập nhật)--}}
                                            <a href="{{ route('questions.answers.edit', ['question'=>$question->id,'answer' => $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan

                                        @can('delete',$answer){{--nếu dùng cách 2 đổi delete-question bằng delete(tên hàm để authorization việc xóa)--}}
                                            <form class="form-delete" action="{{ route('questions.answers.destroy',[$question->id,$answer->id]) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure ?');">Delete</button>
                                            </form>  
                                        @endcan     
                                    </div>  
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <span class="text-muted">
                                        Answered {{ $answer->create_date }}
                                    </span>
                                    <div class="media mt-2">
                                        <a href="{{ $answer->user->url }}">
                                            <img src="{{ $answer->user->avatar }}" alt="">
                                        </a>
                                        <div class="media-body mt-1 ml-1">
                                            <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>