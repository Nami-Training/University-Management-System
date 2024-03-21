@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('quizz.add_new_question') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('quizz.add_new_question') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('Questions.store') }}" method="post" autocomplete="off">
                                @csrf
                                <div class="form-row">
                                    @foreach (config('app.languages') as $key => $lang)
                                        <div class="col">
                                            <label for="Question_{{$key}}">{{ trans('quizz.question_'. $key) }}</label>
                                            <input type="text" name="{{$key}}[title]" id="Question_{{$key}}"
                                                    class="form-control form-control-alternative" autofocus>
                                        </div>
                                    @endforeach
                                </div>
                                <br>

                                <div class="form-row">
                                    @foreach (config('app.languages') as $key => $lang)
                                        <div class="col">
                                            <label for="answers_{{$key}}">{{ trans('quizz.answers_' . $key) }}</label>
                                            <textarea name="{{$key}}[answers]" class="form-control" id="answers_{{$key}}"
                                                    rows="4"></textarea>
                                        </div>
                                    @endforeach
                                </div>
                                <br>

                                <div class="form-row">
                                    @foreach (config('app.languages') as $key => $lang)
                                        <div class="col">
                                            <label for="right_answer_{{$key}}">{{ trans('quizz.risght answer_' . $key) }}</label>
                                            <input id="right_answer_{{ $key }}" type="text" name="{{ $key }}[right_answer]" class="form-control form-control-alternative" autofocus>
                                        </div>
                                    @endforeach
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="quizzes_id">{{ trans('quizz.quiz name') }} : <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="quiz_id">
                                                <option selected disabled>{{ trans('quizz.choose quizz') }}...</option>
                                                @foreach($quizzes as $quizze)
                                                    <option value="{{ $quizze->id }}">{{ $quizze->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('quizz.score')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score">
                                                <option selected disabled> {{ trans('quizz.choose score') }}...</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('quizz.add')}}</button>
                            </form>
                        </div>
                    </div>
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
