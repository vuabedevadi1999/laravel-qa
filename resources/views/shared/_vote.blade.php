@if($model instanceof App\Models\Question)
    @php
        $name = 'question';
        $firstURIsegment = 'questions';    
    @endphp
@elseif($model instanceof App\Models\Answer)
        @php
        $name = 'answer';
        $firstURIsegment = 'answers';    
        @endphp
@endif
@php
  $formID =  $name . '-' . $model->id;
  $formAction = "/{$firstURIsegment}/{$model->id}/vote";   
@endphp
<div class="d-flex flex-column vote-controls">
    <a href="" title="This {{ $name }} is usefull" 
    class="vote-up {{ Auth::guest() ? 'off' : '' }}"
    onclick="event.preventDefault();document.getElementById('up-votes-{{ $formID }}').submit();"
    >
    <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <form id="up-votes-{{ $formID }}" action="{{ $formAction }}" method="POST" style="display: none">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-count">{{ $model->votes_count }}</span>
    <a title="This {{ $name }} is not useful" 
    class="vote-down {{ Auth::guest() ? 'off' : '' }}"
    onclick="event.preventDefault();document.getElementById('down-votes-{{ $formID }}').submit();"
    >
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form id="down-votes-{{ $formID }}" action="{{ $formAction }}" method="POST" style="display: none">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
    @if($model instanceof App\Models\Question)
        <favorite :question = "{{ $model }}"></favorite>
    @elseif ($model instanceof App\Models\Answer)
        <accept :answer="{{ $model }}"></accept> 
    @endif
</div>