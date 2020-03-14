@if ( $answersCount > 0 )
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{$answersCount ." ".str_plural('Answers',$answersCount)}}</h2>
                    </div>
                    <hr>
                    @include('layouts._messages')
                    @foreach ($answers as $answer)
                        <div class="media">
                            <div class="d-flex flex-column votes-controls">
                                <a title="This answer is useful"
                                   class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                                   onclick="event.preventDefault();document.getElementById('up-vote-answer-{{ $answer->id }}').submit();"
                                >
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <form action="/answers/{{$answer->id}}/vote" method="post" style="display: none" id="up-vote-answer-{{ $answer->id }}">
                                    @csrf
                                    <input type="hidden" name="vote" value="1">
                                </form>

                                <span class="votes-count">{{ $answer->votes_count }}</span>
                                <a title="This answer is not useful"
                                   class="votes-down {{ Auth::guest() ? 'off' : '' }}"
                                   onclick="event.preventDefault();document.getElementById('down-vote-answer-{{ $answer->id }}').submit();"
                                >
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <form action="/answers/{{$answer->id}}/vote" method="post" style="display: none" id="down-vote-answer-{{ $answer->id }}">
                                    @csrf
                                    <input type="hidden" name="vote" value="-1">
                                </form>


                            </div>
                            <div class="media-body">
                                {!! $answer->body_html !!}
                                <div class="row">
                                    <div class="col-4">
                                        @can('update',$answer)
                                            <a href="{{route('questions.answers.edit',[$question->id,$answer->id])}}"
                                               class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan

                                        @can('delete',$answer)
                                            <form class="form-delete" method="post"
                                                  action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure ?')">Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4">

                                        @include('shared._author',[
                                            'model'=>$answer,
                                            'label'=>'answered'
                                            ])
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
@endif
