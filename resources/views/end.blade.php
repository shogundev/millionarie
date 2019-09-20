@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card  mb-3 mb-lg-0 text-center">
                    <div class="card-body p-5">
                        <p class="text-center text-decoration-none fs-23" id="question">You've earned {{$points}}
                            points</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <a class="btn btn-primary float-left" href="{{url('play')}}">Play Again</a>
                <a class="btn btn-primary float-right" href="{{url('leaderboard')}}">Leaderboard</a>
            </div>
        </div>
    </div>
@endsection
