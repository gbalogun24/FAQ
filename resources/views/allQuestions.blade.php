@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Questions
                        <div class="card-body">
                            <a class="btn btn-primary float-right" href="{{route('question.create')}}">
                                Create a question
                            </a>
                            <div class="card-deck">
                                @forelse($allQuestions as $question)
                                    <div class="col-sm-4 d-flex align-items-stretch">
                                        <div class="card mb-3 ">
                                            <div class="card-header">
                                                <small class="text-muted">
                                                    Updated: {{ $question->created_at->diffForHumans() }}
                                                    Answers: {{ $question->answers()->count() }}

                                                </small>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{$question->body}}</p>
                                            </div>
                                            <div class="card-footer">
                                                <p class="card-text">

                                                    <a class="btn btn-primary float-right" href="{{route('question.show',['id'=>$question->id])}}">
                                                        View
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    There are no questions available, please create a question.
                                @endforelse

                            </div>
                        </div>
                        <div class="card-footer">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection