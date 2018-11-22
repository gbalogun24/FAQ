@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">My Profile</div>
                    <div class="card-body ">
                        <p>{{{$message}}}</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-success float-right" href="{{ route('profile.show', ['user_id' => Auth::user()->id,'profile_id' => Auth::user()->profile->id]) }}">
                            Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection