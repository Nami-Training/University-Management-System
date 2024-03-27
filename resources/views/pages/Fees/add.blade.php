@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Students_trans.Add_fee') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Students_trans.Add_fee') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('Fees.store') }}" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            @foreach (config('app.languages') as $key => $lang)
                                <div class="form-group col">
                                    <label for="title_{{ $key }}">{{trans('Students_trans.name_' . $key)}}</label>
                                    <input type="text" name="{{ $key }}[title]" class="form-control" id="title_{{ $key }}">
                                </div>
                            @endforeach
                            {{-- <input  type="hidden" name="student_id"  value="{{$student->id}}" class="form-control"> --}}

                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('Students_trans.amount') }}</label>
                                <input type="number" value="{{ old('amount') }}" name="amount" class="form-control">
                            </div>
                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{ trans('Students_trans.Grade') }}</label>
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($Grades as $Grade)
                                        <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{ trans('Students_trans.classrooms') }}</label>
                                <select class="custom-select mr-sm-2" name="classroom_id">

                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{ trans('Students_trans.academic_year') }}</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{ trans('Students_trans.Type_of_fees') }}</label>
                                <select class="custom-select mr-sm-2" name="Fee_type">
                                    <option value="Buildings">{{ trans('Students_trans.buildings') }}</option>
                                    <option value="Libraries">{{ trans('Students_trans.libraries') }}</option>
                                    <option value="Laboratories">{{ trans('Students_trans.laboratories') }}</option>
                                    <option value="Computer Lab">{{ trans('Students_trans.computer_lab') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{ trans('Students_trans.description') }}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{ trans('Students_trans.add') }}</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Classrooms/getClasses') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classroom_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
