@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('cruds.userManagement.title')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">{{ trans('cruds.permission.title') }}</a></li>
                    <li class="breadcrumb-item active"> {{ trans('global.edit') }} {{ trans('cruds.permission.title_singular') }} </li>
                </ol>
            </div>
            <h4 class="page-title"> {{ trans('global.edit') }} {{ trans('cruds.permission.title_singular') }} </h4>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route("admin.permissions.update", [$permission->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.permission.fields.title') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($permission) ? $permission->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.permission.fields.title_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection