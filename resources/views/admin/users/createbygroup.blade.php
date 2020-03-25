@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('cruds.userManagement.title')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ trans('cruds.user.title') }}</a></li>
                    <li class="breadcrumb-item active"> {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }} </li>
                </ol>
            </div>
            <h4 class="page-title"> {{ trans('global.create') }} {{ session('') }} </h4>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @if($errors->has('email'))
            <strong class="text-danger">{{ $errors->first('email') }}</strong>
        @endif
        <form action="{{ route("admin.users_store_group") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-right">
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
            <div class="form-group {{ $errors->has('student_file') ? 'has-error' : '' }}">
                <label for="student_file">{{ trans('cruds.user.fields.group_file') }}*</label>
                <input type="file" id="student_file" name="student_file" class="dropify" data-max-file-size="2M" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                @if($errors->has('notes'))
                    <strong class="text-danger">{{ $errors->first('student_file') }}</strong>
                @endif
            </div>
        </form>
    </div>
</div>
@stop
@section('javascript')
<script>
    $("document").ready(function(){
        $('.js-example-basic-multiple').select2();
        $(".dropify").dropify({
            messages: {
                default: "Drag and drop a file here or click",
                replace: "Drag and drop or click to replace",
                remove: "Remove",
                error: "Ooops, something wrong appended."
            },
            error: {
                fileSize: "The file size is too big (2M max)."
            }
        });
    })
</script>
@endsection