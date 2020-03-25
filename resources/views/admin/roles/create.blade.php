@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('cruds.userManagement.title')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">{{ trans('cruds.role.title') }}</a></li>
                    <li class="breadcrumb-item active"> {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }} </li>
                </ol>
            </div>
            <h4 class="page-title"> {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }} </h4>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route("admin.roles.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.role.fields.title') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($role) ? $role->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.role.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                <label for="permission">{{ trans('cruds.role.fields.permissions') }}*
                    {{--  <span class="btn btn-info btn-xs select-all" onclick="alert();">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span>  --}}
                </label>
                <select name="permission[]" id="permission" class="form-control js-example-basic-multiple" multiple="multiple" required>
                    @foreach($permissions as $id => $permissions)
                        <option value="{{ $id }}" {{ (in_array($id, old('permission', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                    @endforeach
                </select>
                @if($errors->has('permission'))
                    <em class="invalid-feedback">
                        {{ $errors->first('permission') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.role.fields.permissions_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@stop
@section('javascript')
<script>
    $("document").ready(function(){
        $('.js-example-basic-multiple').select2();
    })
</script>
@endsection