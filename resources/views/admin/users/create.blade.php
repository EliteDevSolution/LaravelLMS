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
            <h4 class="page-title"> {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }} </h4>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route("admin.users.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-right">
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                <label for="avatar">{{ trans('cruds.user.fields.avatar') }}</label>
                <input type="file" id="avatar" name="avatar" class="dropify" data-height="70" value="{{ old('avatar', isset($user) ? $user->avatar : '') }}">
                @if($errors->has('avatar'))
                    <strong class="text-danger">{{ $errors->first('avatar') }}</strong>
                @endif
            </div>
            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                <label for="first_name">{{ trans('cruds.user.fields.first_name') }}*</label>
                <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', isset($user) ? $user->first_name : '') }}" required>
                @if($errors->has('first_name'))
                    <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                @endif
            </div>
            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                <label for="last_name">{{ trans('cruds.user.fields.last_name') }}*</label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', isset($user) ? $user->last_name : '') }}" required>
                @if($errors->has('last_name'))
                    <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.user.fields.email') }}*</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                @if($errors->has('email'))
                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @if($errors->has('password'))
                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                @endif
            </div>
            <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
                <label for="company">{{ trans('cruds.user.fields.company') }}</label>
                <select id="company" name="company" class="form-control">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <strong class="text-danger">{{ $errors->first('company') }}</strong>
                @endif
            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">{{ trans('cruds.user.fields.roles') }}*
                </label>
                <select name="roles[]" id="roles" class="form-control js-example-basic-multiple" multiple="multiple" required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ 'selected' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <strong class="text-danger">{{ $errors->first('roles') }}</strong>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('business') ? 'has-error' : '' }}">
                <label for="business">{{ trans('cruds.user.fields.business') }}*</label>
                <input type="text" id="business" name="business" class="form-control" value="{{ old('business', isset($user) ? $user->business : '') }}" >
                @if($errors->has('business'))
                    <strong class="text-danger">{{ $errors->first('business') }}</strong>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('department') ? 'has-error' : '' }}">
                <label for="department">{{ trans('cruds.user.fields.department') }}</label>
                <input type="text" id="department" name="department" class="form-control" value="{{ old('department', isset($user) ? $user->department : '') }}">
                @if($errors->has('department'))
                    <strong class="text-danger">{{ $errors->first('department') }}</strong>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('market_stall') ? 'has-error' : '' }}">
                <label for="market_stall">{{ trans('cruds.user.fields.market_stall') }}</label>
                <input type="text" id="market_stall" name="market_stall" class="form-control" value="{{ old('market_stall', isset($user) ? $user->market_stall : '') }}">
                @if($errors->has('market_stall'))
                    <strong class="text-danger">{{ $errors->first('market_stall') }}</strong>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('home') ? 'has-error' : '' }}">
                <label for="home">{{ trans('cruds.user.fields.home') }}</label>
                <input type="text" id="home" name="home" class="form-control" value="{{ old('home', isset($user) ? $user->home : '') }}">
                @if($errors->has('home'))
                    <strong class="text-danger">{{ $errors->first('home') }}</strong>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                <label for="city">{{ trans('cruds.user.fields.city') }}</label>
                <input type="text" id="city" name="city" class="form-control" value="{{ old('city', isset($user) ? $user->city : '') }}">
                @if($errors->has('city'))
                    <strong class="text-danger">{{ $errors->first('city') }}</strong>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
                <label for="state">{{ trans('cruds.user.fields.state') }}</label>
                <input type="text" id="state" name="state" class="form-control" value="{{ old('state', isset($user) ? $user->state : '') }}">
                @if($errors->has('state'))
                    <strong class="text-danger">{{ $errors->first('state') }}</strong>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($user) ? $user->phone : '') }}">
                @if($errors->has('phone'))
                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
                <label for="notes">{{ trans('cruds.user.fields.notes') }}</label>
                <textarea id="notes" name="notes" class="form-control" rows="4">{{ old('notes', isset($user) ? $user->notes : '') }}</textarea>
                @if($errors->has('notes'))
                    <strong class="text-danger">{{ $errors->first('notes') }}</strong>
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
                fileSize: "The file size is too big (1M max)."
            }
        });
    })
</script>
@endsection