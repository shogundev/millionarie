@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center mb-5">MILLIONARIE</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card  card-frame mb-3 mb-lg-0">
                    <a href="{{route('quiz.start')}}">
                        <div class="card-body p-5">
                            <p class="text-center text-decoration-none">PLAY</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card   card-frame mb-3 mb-lg-0">
                    <a href="{{route('quiz.leaderboard')}}">
                        <div class="card-body p-5">
                            <p class="text-center te">LEADERBOARD</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection