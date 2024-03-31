@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('main_trans.Settings') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.Settings') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')


    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="{{route('settings.update',$setting->id)}}">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-12 border-right-2 border-right-blue-400">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label font-weight-semibold">{{ trans('setting.schoolName') }}<span class="text-danger">*</span></label>
                                    <input name="school_name" value="{{ $setting->school_name }}" required type="text" class="form-control" placeholder="Name of School">
                                </div>
                                <div class="col-lg-6">
                                    <label for="current_session" class="col-form-label font-weight-semibold">{{ trans('setting.Currentyear') }}<span class="text-danger">*</span></label>
                                    <select data-placeholder="Choose..." required name="current_session" id="current_session" class="select-search form-control">
                                        @for($y=date('Y', strtotime('- 3 years')); $y<=date('Y', strtotime('+ 1 years')); $y++)
                                            <option @selected($setting->current_session == (($y-=1).'-'.($y+=1)))>{{ ($y-=1).'-'.($y+=1) }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label font-weight-semibold">{{ trans('setting.Abbreviated_name_school') }}</label>
                                    <input name="school_title" value="{{ $setting->school_title }}" type="text" class="form-control" placeholder="School Acronym">
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label font-weight-semibold">{{ trans('setting.phone') }}</label>
                                    <input name="phone" value="{{ $setting->phone }}" type="text" class="form-control" placeholder="Phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label font-weight-semibold">{{ trans('setting.email') }}</label>
                                    <input name="school_email" value="{{ $setting->school_email }}" type="email" class="form-control" placeholder="School Email">
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label font-weight-semibold">{{ trans('setting.schoolAddress') }}<span class="text-danger">*</span></label>
                                    <input required name="address" value="{{ $setting->address }}" type="text" class="form-control" placeholder="School Address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label font-weight-semibold">{{ trans('setting.firstTermEnd') }}</label>
                                    <input name="end_first_term" value="{{ $setting->end_first_term }}" type="text" class="form-control date-pick" placeholder="Date Term Ends">
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label font-weight-semibold">{{ trans('setting.secondTermEnd') }}</label>
                                    <input name="end_second_term" value="{{ $setting->end_second_term }}" type="text" class="form-control date-pick" placeholder="Date Term Ends">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label font-weight-semibold">{{ trans('setting.schoolLogo') }}</label>
                                    <div class="mb-3">
                                        @if ($setting->image)
                                            <img style="width: 100px" height="100px" src="{{ asset($setting->image->path) }}" alt="{{$setting->image->filename}}">
                                        @else
                                            <img style="width: 100px" height="100px" src="" alt="logo">
                                        @endif
                                    </div>
                                    <input name="logo" accept="image/*" type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-fouc>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.update')}}</button>
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
