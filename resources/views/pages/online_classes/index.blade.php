@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('onlineClass.Onlineclasses') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('onlineClass.Onlineclasses') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('OnlineClass.create')}}" class="btn btn-success" role="button" aria-pressed="true">{{ trans('onlineClass.add_new_OnlineClass') }}</a>
                                <a class="btn btn-warning" href="{{route('OnlineClass.indirect.create')}}">{{ trans('onlineClass.add_new_OfflineClass') }}</a>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ trans('onlineClass.grade') }}</th>
                                            <th>{{ trans('onlineClass.classroom') }}</th>
                                            <th>{{ trans('onlineClass.section') }}</th>
                                            <th>{{ trans('onlineClass.teacher') }}</th>
                                            <th>{{ trans('onlineClass.class_title') }}</th>
                                            <th>{{ trans('onlineClass.starting_date') }}</th>
                                            <th>{{ trans('onlineClass.class_time') }}</th>
                                            <th>{{ trans('onlineClass.class_link') }}</th>
                                            <th>{{ trans('onlineClass.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($online_classes as $online_classe)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$online_classe->grade->Name}}</td>
                                            <td>{{ $online_classe->classroom->Name_Class }}</td>
                                            <td>{{$online_classe->section->Name_Section}}</td>
                                                <td>{{$online_classe->user->name}}</td>
                                                <td>{{$online_classe->topic}}</td>
                                                <td>{{$online_classe->start_at}}</td>
                                                <td>{{$online_classe->duration}}</td>
                                                <td class="text-danger"><a href="{{$online_classe->join_url}}" target="_blank">{{ trans('onlineClass.join_now') }}</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$online_classe->meeting_id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.online_classes.delete')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
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
