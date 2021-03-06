@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (Auth::user()->id == $answer->user_id)
                <div class="card">
                    <div class="card-header">Answer <img src="{{$answerUser->avatar}}" align="right"></div>
                    <div class="card-body">
                        {{$answer->body}}
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary float-right"
                           href="{{route('answer.edit',['question_id'=> $question, 'answer_id'=> $answer->id])}}">
                            Edit
                        </a>
                        {{ Form::open(['method' => 'DELETE', 'route' => ['answer.destroy', 'question_id'=> $question, 'answer_id'=> $answer->id]])}}
                        <button class="btn btn-danger float-right mr-2" value="sumit" id="sumit">Delete
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
                @else
                    <div class="card">
                        <div class="card-header">Answer <img src="{{$answerUser->avatar}}" align="right"></div>
                        <div class="card-body">
                            {{$answer->body}}
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
            </div>
            @endif
        </div>
    </div>
@endsection