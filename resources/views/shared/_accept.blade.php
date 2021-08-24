@can('accept', $model)
    <a title="Mark this answer as best answer" 
    class="{{ $model->status }} mt-2"
    onclick="event.preventDefault();document.getElementById('answer-accept-{{$model->id}}').submit();"
    >
        <i class="fas fa-check fa-2x"></i>
    </a>
    <form id="answer-accept-{{$model->id}}" action="{{ route('answers.accept',$model->id) }}" method="POST" style="display: none">
        @csrf

    </form>
@else
    @if ($model->is_best)
        <a title="This answer has accepted" class="{{ $model->status }} mt-2">
            <i class="fas fa-check fa-2x"></i>
        </a>
    @endif
@endcan