@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.company.index') }}">{{ trans('cruds.company.title') }}</a></li>
                    <li class="breadcrumb-item active"> {{ trans('global.edit') }} {{ trans('cruds.company.title_singular') }} </li>
                </ol>
            </div>
            <h4 class="page-title"> {{ trans('global.edit') }} {{ trans('cruds.company.title_singular') }} </h4>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route("admin.company.update", [$company->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.company.fields.title') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($company) ? $company->name : '') }}" required>
                @if($errors->has('name'))
                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection