@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Leaderboard</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Place</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Points</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$result->first_name}}</td>
                <td>{{$result->last_name}}</td>
                <td>{{$result->points}}</td>
                <td>{{\Illuminate\Support\Carbon::createFromTimeStamp(strtotime($result->created_at))->diffForHumans()}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-12">
            <a class="btn btn-primary float-right" href="{{url('play')}}">Play</a>
        </div>
    </div>
@endsection