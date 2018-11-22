@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                        @if($edit === FALSE)
                        <div class="card-header">Create Profile</div>
                        <div class="card-body">
                            {!! Form::model($profile, ['route' => ['profile.store', Auth::user()->id], 'method' => 'post']) !!}
                        @else()
                                <div class="card-header">Update Profile</div>
                                <div class="card-body">
                            {!! Form::model($profile, ['route' => ['profile.update', Auth::user()->id, $profile->id], 'method' => 'patch']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', $profile->fname, ['class' => 'form-control','required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('lname', 'Last Name') !!}
                            {!! Form::text('lname', $profile->lname, ['class' => 'form-control','required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('body', 'Body') !!}
                            {!! Form::text('body', $profile->body, ['class' => 'form-control','required' => 'required']) !!}
                        </div>
                        <button class="btn btn-success float-right" value="submit" type="submit" id="submit">Save
                        </button>
                        {!! Form::close() !!}
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection