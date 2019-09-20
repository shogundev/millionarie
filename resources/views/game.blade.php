@extends('layouts.app')
@section('content')
    <div class="container">
        @isset($question)
            <div class="row">
                <div class="col-12 mb-3">
                    <p>Question {{count(session()->get('questions'))}} of 5</p>
                    <div class="card  mb-3 mb-lg-0 text-center">
                        <div class="card-body p-5">
                            <p class="text-center text-decoration-none fs-23" id="question"
                               data-id="{{$question->id}}">{{$question->question}}</p>
                        </div>
                    </div>
                </div>
                @foreach($question->choices as $choice)
                    <div class="col-md-6">
                        <div class="card card-frame mb-3">
                            <div class="card-body p-5 choice" data-choice="{{$choice->id}}">
                                <p class="text-center text-decoration-none">{{$choice->choice}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12">
                    <a class="btn btn-primary float-right" id="next-quest" href="{{url('play')}}">@if($end) END @else Next @endif</a>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('body').off('click', '.choice').one('click', '.choice', function () {
                let question = $('#question').data('id');
                let choice = $(this);
                let choice_id = choice.data('choice');
                $.ajax({
                    type: 'GET',
                    url: '/check/' + question + '/' + choice_id,
                    success: function (response) {
                        if (Number(response.answer)) {
                            choice.css({
                                'border':'1px solid #7cc481',
                                'border-radius':'4px',
                                'background-color':'#7cc481',
                                'color': '#ffffff'
                            });
                        } else {
                            choice.css({
                                'border':'1px solid #b31409',
                                'border-radius':'4px',
                                'background-color':'#b31409',
                                'color': '#ffffff'
                            });
                            $('.choice[data-choice=' + response.correct + ']').css({
                                'border':'1px solid #7cc481',
                                'border-radius':'4px',
                                'background-color':'#7cc481',
                                'color': '#ffffff'
                            });
                        }

                        setTimeout(function(){
                            $('#next-quest')[0].click();
                        }, 1000);

                    }
                });
            });
        })
    </script>
@endsection