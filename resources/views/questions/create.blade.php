@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>Ask Question</h2>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">Back to all Question</a>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <form action="{{route('questions.store')}}", method="POST">
                            @method('Post')
                            @csrf
                            <div class="form-group">
                                <label for="question-title">Question Title</label>
                                <input type="text" id="question-title" value="{{old('title')}}" class="form-control {{ $errors->has('title')? 'is-invalid':'' }}" name="title" >
                                @if ( $errors->has('title'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('title')  }}</strong>
                                    </div>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="question-body">Question Title</label>
                                <textarea id="question-body" rows="10" class="form-control {{ $errors->has('body')? 'is-invalid':'' }}" name="body">{{old('body')}}"</textarea>
                                @if ( $errors->has('body'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('body')  }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">

                                <button type="submit" class="btn btn-outline-primary btn-lg">Ask this question</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
