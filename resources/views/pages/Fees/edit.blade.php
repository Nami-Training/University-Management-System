@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Students_trans.edit_fee') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Students_trans.edit_fee') }}
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

                    <form action="{{route('Fees.update', $fee->id)}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            @foreach (config('app.languages') as $key => $lang)
                                <div class="form-group col">
                                    <label for="Name_{{ $key }}">{{trans('Students_trans.name_' . $key)}}</label>
                                    <input type="text" value="{{$fee->translate($key)->title}}" name="{{ $key }}[Name]" class="form-control" id="Name_{{ $key }}">
                                </div>
                            @endforeach
                            <input type="hidden" value="{{$fee->id}}" name="id" class="form-control">

                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('Students_trans.amount') }}</label>
                                <input type="number" value="{{$fee->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{ trans('Students_trans.Grade') }}</label>
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    @foreach($Grades as $Grade)
                                        <option value="{{ $Grade->id }}" @selected($Grade->id == $fee->Grade_id)>{{ $Grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{ trans('Students_trans.classrooms') }}</label>
                                <select class="custom-select mr-sm-2" name="classroom_id">
                                    <option value="{{$fee->classroom_id}}">{{$fee->classroom->Name}}</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{ trans('Students_trans.academic_year') }}</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" @selected($year == $fee->year)>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{ trans('Students_trans.Type_of_fees') }}</label>
                                <select class="custom-select mr-sm-2" name="Fee_type">
                                    <option value="{{ $fee->Fee_type }}">{{ trans('Students_trans.Fees') }}</option>
                                    <option value="{{ $fee->Fee_type }}">{{ trans('Students_trans.Fees') }}</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputAddress">{{ trans('Students_trans.description') }}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                      rows="4">{{$fee->description}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{ trans('Students_trans.update') }}</button>

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
@endsection
