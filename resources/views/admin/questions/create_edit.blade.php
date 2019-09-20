@extends('admin.layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <a href="{{route('questions.create')}}">
                        <h4 class="card-title float-right"> <i class="tim-icons icon-simple-add"></i>Add New</h4>
                    </a>
                </div>
                <div class="card-header">
                    <h5 class="title">@isset($question)Update Question @else Add Question @endif</h5>
                </div>
                <div class="card-body">
                    @isset($question)
                        <form action="{{ route('questions.update', $question->id) }}" method="POST">
                            @method('PUT')
                    @else
                        <form action="{{route('questions.store')}}" method="POST">
                    @endif
                            @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Question</label>
                                    <input type="text" class="form-control" name="question" placeholder="Enter Question here..."
                                           value="@isset($question) {{$question->question}}@endif">
                                    @if($errors->has('question'))
                                        <div class="error">{{ $errors->first('question') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="container" >
                            <div id="choices-container">
                                @if(isset($question) && !empty($question->choices))
                                    @foreach($question->choices as $key => $choice)
                                        <div class="card custom-choice mb-3" data-i="{{$key}}">
                                            <div class="card-body row col-md-12">
                                                <div class="col-md-6 form-group">
                                                    <label for="">Choice</label>
                                                    <input type="text" name="current[{{$choice->id}}]" id="" class="form-control" placeholder="Enter Choice" value="{{$choice->choice}}">
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Correct</label>
                                                    <input type="radio" name="correct" value="{{$choice->id}}" id="" class="form-control" @if($choice->is_correct == 1){{'checked'}}@endif>
                                                </div>

                                                <div class="col-md-1">
                                                    <label for="">Remove</label>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger remove-row"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                            <div class="card custom-choice mb-3" data-i="0">
                                <div class="card-body row col-md-12">
                                    <div class="col-md-6">
                                        <label for="">Choice</label>
                                        <input type="text" name="choices[0]" id="" class="form-control" placeholder="Enter Choice">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="">Correct</label>
                                        <input type="radio" name="correct" value="new-0" id="" class="form-control">
                                    </div>

                                    <div class="col-md-1">
                                        <label for="">Remove</label>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger remove-row"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endif
                                    @if ($errors->has('correct'))
                                        <div class="error">{{ $errors->first('correct') }}</div>
                                    @endif
                            </div>
                            <div class="mb-5 float-right">
                                <p>
                                    <small class="pl-3 text-right">
                                        <a href="javascript:void(0)" class="link-active btn-primary  btn btn-xs" id="add-choice"><i class="fa fa-plus" aria-hidden="true"></i> Add  Choice </a>
                                    </small>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-md-1">
                                <div class="form-group">
                                    <label>Points</label>
                                    <input id="mine" class="form-control" type="range" min="5" max="20" value="@isset($question){{$question->points}}@else{{5}}@endif"
                                           name="points"
                                           step="5" onChange="change();"> <span id="result">@isset($question) {{$question->points}} @else 5 @endif</span>
                                    @if ($errors->has('points'))
                                        <div class="error">{{ $errors->first('points') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 px-md-1">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="active" @if(isset($question) && $question->status == 'active'){{'selected'}}@endif>Active</option>
                                        <option value="draft" @if(isset($question) && $question->status == 'draft'){{'selected'}}@endif>Draft</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            @isset($question)
                                <button type="submit" class="btn btn-fill btn-warning">Update</button>
                            @else
                                <button type="submit" class="btn btn-fill btn-primary">Save</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var result = document.getElementById("result");
        var mine = document.getElementById("mine");

        function change() {
            result.innerText = mine.value;
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#add-choice').on('click', function (e) {
                var max = 0;
                var i = 0;
                $('body').find(".custom-choice[data-i]").each(function () {
                    var value = $(this).attr("data-i");
                    i = max < value ? value : max;
                    i = parseInt(i) + 1;
                });
                let html = '\
                <div class="card  custom-choice mb-3" data-i="'+i+'">\
                    <div class="card-body row col-md-12">\
                        <div class="col-md-6 form-group">\
                            <label for="">Choice</label>\
                            <input type="text"  name="choices['+i+']"  id="" class="form-control" placeholder="Enter Choice">\
                        </div>\
                        <div class="col-md-1 form-group">\
                            <label for="">Correct</label>\
                            <input type="radio"   name="correct" value="new-'+i+'"    id="" class="form-control">\
                        </div>\
                        <div class="col-md-1">\
                            <label for="">Remove</label>\
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger remove-row"><i class="fa fa-trash"></i></a>\
                        </div>\
                    </div>\
                </div>';

                $(html).appendTo($('#choices-container'));

            });
            $('body').off('click', '.remove-row').on('click','.remove-row', function(e){
                $(this).closest('.custom-choice').remove();
            });
        });
    </script>
@endsection