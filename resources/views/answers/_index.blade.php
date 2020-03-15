@if ( $answersCount > 0 )
    <div class="row mt-4" v-cloack>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{$answersCount ." ".str_plural('Answers',$answersCount)}}</h2>
                    </div>
                    <hr>
                    @include('layouts._messages')
                    @foreach ($answers as $answer)
                        @include('answers.answer')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

