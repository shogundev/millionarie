@extends('admin.layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Total Users</h5>
                    <h3 class="card-title"><i class="tim-icons icon-single-02 text-primary"></i> {{$users}}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Total Questions</h5>
                    <h3 class="card-title"><i class="tim-icons icon-chat-33 text-info"></i> {{$questions}}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Total Games Played</h5>
                    <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> {{$games}}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection