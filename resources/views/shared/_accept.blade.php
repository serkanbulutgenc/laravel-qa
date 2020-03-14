@can('accept',$model)
    <a title="Mark this answer as best answer" class="{{$model->status}} mt-2 " onclick="event.preventDefault();document.getElementById('accept-answer-{{ $model->id }}').submit();">
        <i class="fas fa-check fa-2x"></i>
        <span class="favorites-count">123 </span>
    </a>
    <form action="{{route('answers.accept',$model->id)}}" method="post" style="display: none" id="accept-answer-{{ $model->id }}">
        @csrf
        @method('post')
    </form>
@else
    @if ($model->is_best)
        <a title="The question answer accepted this answer as best answer"
           class="{{$model->status}} mt-2 "
        >
            <i class="fas fa-check fa-2x"></i>
            <span class="favorites-count">123 </span>
        </a>
    @endif
@endcan
