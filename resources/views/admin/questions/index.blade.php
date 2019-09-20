@extends('admin.layouts.dashboard')
@section('content')
    <div class="col-md-12">
        <div class="card-header">
            <a href="{{route('questions.create')}}">
                <h4 class="card-title"> <i class="tim-icons icon-simple-add"></i>  Add Question</h4>
            </a>
        </div>
        <div class="card  card-plain">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table tablesorter" id="">
                        <thead class=" text-primary">
                        <tr>
                            <th>
                                Question
                            </th>
                            <th>
                                Choices
                            </th>
                            <th>
                                Points
                            </th>
                            <th>
                                Satus
                            </th>
                            <th class="text-center">
                                Created
                            </th>
                            <th class="text-center">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>
                                    {{$question->question}}
                                </td>
                                <td>
                                    {{count($question->choices)}}
                                </td>
                                <td>
                                    {{$question->points}}
                                </td>
                                <td>
                                    {{$question->status}}
                                </td>
                                <td class="text-center">
                                    {{$question->created_at}}
                                </td>
                                <td class="font-weight-medium text-center td-actions">
                                    <a href="{{route('questions.edit', $question->id)}}" class="btn btn-link">
                                        <i class="tim-icons icon-pencil"></i>
                                    </a>
                                    <a href="{{route('questions.delete', $question->id)}}"
                                       class="btn btn-link confirm-del">
                                        <i class="tim-icons icon-trash-simple"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right ">{!! $questions->links() !!}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('body').off('click', '.confirm-del').on('click', '.confirm-del', function (e) {
                if (!confirm("Are you sure?")) {
                    e.preventDefault();
                }
            });
        })
    </script>
@endsection