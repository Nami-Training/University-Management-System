@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('library.Library') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('library.book_list') }}
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
                            <a href="{{ route('library.create') }}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{ trans('library.add_book') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('library.book_Name') }}</th>
                                            <th>{{ trans('library.teacher_Name') }}</th>
                                            <th>{{ trans('library.grade') }}</th>
                                            <th>{{ trans('library.classroom') }}</th>
                                            <th>{{ trans('library.section') }}</th>
                                            <th>{{ trans('library.processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($books as $book)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $book->title }}</td>
                                                <td>{{ $book->teacher->Name }}</td>
                                                <td>{{ $book->grade->Name }}</td>
                                                <td>{{ $book->classroom->Name }}</td>
                                                <td>{{ $book->section->Name }}</td>
                                                <td>
                                                    <a href="{{ route('library.downloadAttachment', $book->file_name) }}"
                                                        title="{{ trans('library.downloadBook') }}"
                                                        class="btn btn-warning btn-sm" role="button"
                                                        aria-pressed="true"><i class="fas fa-download"></i></a>
                                                    {{-- <form action="{{ route('library.downloadAttachment', $book->file_name) }}" method="POST" class="form-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning btn-sm"  title="{{ trans('library.downloadBook') }}"><i class="fas fa-download"></i></button> --}}
                                                    </form>
                                                    <a href="{{ route('library.edit', $book->id) }}"
                                                        class="btn btn-info btn-sm" role="button"
                                                        aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#delete_book{{ $book->id }}"
                                                        title="{{ trans('library.delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            @include('pages.library.destroy')
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
