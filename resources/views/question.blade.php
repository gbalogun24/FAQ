@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row ">
            <div class="col-md-8">
                @if (Auth::user()->id == $question->user_id)
                <div class="card">
                    <div class="card-header">Question <img src="{{$user->avatar}}" align="right"></div>
                    <div class="card-body">
                        {{$question->body}}
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary float-right"
                           href="{{ route('question.edit',['id'=> $question->id])}}">
                            Edit Question
                        </a>
                        {{ Form::open(['method' => 'DELETE', 'route' => ['question.destroy', $question->id]])}}
                        <button class="btn btn-danger float-right mr-2" value="sumit" id="sumit">Delete
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
                    @else
                    <div class="card">
                        <div class="card-header">Question <img src="{{$user->avatar}}" align="right"></div>
                        <div class="card-body">
                            {{$question->body}}
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Answers<a class="btn btn-primary float-right" href="{{ route('answer.create', ['question_id'=> $question->id]) }}">
                            Answer Question</a>
                    </div>

                    <div class="card-body">
                        @forelse($question->answers as $answer)
                            <div class="card">
                                <div class="card-body">{{$answer->body}}</div>
                                <div class="card-footer">
                                    <a class="btn btn-primary float-right"
                                       href="{{ route('answer.show', ['question_id'=> $question->id,'answer_id' => $answer->id]) }}">
                                        View
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="card">
                                <div class="card-body"> No Answers</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection