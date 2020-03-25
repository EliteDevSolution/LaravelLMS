@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">
                        <span> @lang('cruds.user.title') </span>
                    </li>
                </ol>
            </div>
            <h4 class="page-title">@lang('cruds.user.title')</h4>
        </div>
    </div>
</div>
@if(isset($success_student))
    <p class="alert-success">{{ $success_student }}</p>
@endif
<div class="card">
    <div class="card-body">
        @can('admin_permission')
            <div class="row mb-3">
                <div class="col-md-auto">
                    <select id="role" class="form-control">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ (\Session::get("role_selected") == $role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-auto">
                    <a href="#" id="create_by_type" class="btn btn-success">
                        <i class="icon-plus"></i>
                        {{ trans('global.add') }}
                    </a>
                    <a href="{{ route("admin.users_createbygroup", "Student") }}" class="btn btn-primary btn-by-group" style="display:none;">
                        <i class="fe-file-plus"></i>
                        {{ trans('global.add') }} {{ trans('global.by group') }}
                    </a>
                </div>
            </div>
        @else
            <div class="row mb-3">
                <div class="col-md-auto">
                    <select id="role" class="form-control">
                        @foreach ($roles as $role)
                            @if($role->id != 1)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-auto">
                    <a href="#" id="create_by_type" class="btn btn-success">
                        <i class="icon-plus"></i>
                        {{ trans('global.add') }}
                    </a>
                    <a href="{{ route("admin.users.create") }}" class="btn btn-primary btn-by-group" style="display:none;">
                        <i class="fe-file-plus"></i>
                        {{ trans('global.add') }} {{ trans('global.by group') }}
                    </a>
                </div>
            </div>
        @endcan

        <div class="table-responsive">
            <div class="table-buttons" style="position: absolute; margin-left: 200px;  z-index: 999999999;">
                <button class="btn btn-danger" id="delete_selected" style="height: 30px !important; padding-top: 5px;">{{ trans('global.datatables.delete') }}</button>
            </div>
            <table id="datatable" class="display nowrap ml-0">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>


    </div>
</div>
@stop

@section('javascript')
<script>
    var table;
    $(document).ready(function () {
        table = $('#datatable').DataTable({
            "scrollY": "480px",
            'columnDefs': [
                {
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                }
            ],
            'order': [[1, 'asc']]
        });
        $("#delete_selected").click(function () {
            var ids = [];
            $("#datatable>tbody").find("input:checkbox").each(function (i, e) {
                if ($(this).is(":checked")) ids.push($(this).parents("[role=row]").attr("id"));
            });
            if (ids.length === 0) {
                $.NotificationApp.send("{{ trans('global.notifications') }}"
                    ,"{{ trans('global.datatables.zero_selected') }}"
                    ,"top-center"
                    ,"#da8609"
                    ,"warning");
                return;
            }
            if (!confirm('{{ trans('global.areYouSure') }}')) return;
            $.ajax({
                url: "{{ route('admin.users.mass_destroy') }}",
                type: 'POST',
                data: { ids: ids, _method: 'DELETE' }
            }).done( function () {
                location.reload();
            });
        });
        $("#role").change(function(){
            var add_url = '{{ url('admin/users_createbytype') }}' + '/' + $("#role").val();
            $("#create_by_type").attr("href", add_url);
            if($("#role").val() == "Student")
            {
                $(".btn-by-group").css("display", "inline-block");
            } else {
                $(".btn-by-group").css("display", "none");
            }
            showTable();
        });
        $("#role").trigger("change");
    });
    function showTable() {
        $.ajax({
            url: "{{ route('admin.users_getdata') }}",
            data: {
                role: $("#role").val()
            },
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                table.clear().draw();
                let index = 1;
                $.each(data, function(key, value){
                    var view_url = '{{ url('admin/users') }}' + '/' + value['id'];
                    var edit_url = '{{ url('admin/users') }}' + '/' + value['id'] + '/edit';
                    var destroy_url = '{{ url('admin/users') }}' + '/' + value['id'];
                    var view_button = '<a class="btn btn-xs btn-primary" href="' + view_url + '">\n' +
                        '                                    {{ trans('global.view') }}\n' +
                        '                                </a>';
                    var edit_button = '<a class="ml-1 btn btn-xs btn-info" href="' + edit_url + '">\n' +
                        '                                    {{ trans('global.edit') }}\n' +
                        '                                </a>';
                    var delete_button = '<form action="' + destroy_url + '" class="ml-1" method="POST" onsubmit="return confirm(\'{{ trans('global.areYouSure') }}\');"\n' +
                        '                                      style="display: inline-block; margin:0">\n' +
                        '                                    <input type="hidden" name="_method" value="DELETE">\n' +
                        '                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">\n' +
                        '                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">\n' +
                        '                                </form>';
                    var action_td = view_button + edit_button + delete_button;
                    if (parseInt(value['id']) == 1) {
                        var action_td = view_button + edit_button;
                    }
                    var name = value['first_name'] + " " + value['last_name'];
                    var email = value['email'];
                    var roles = '';
                    $.each(value['roles'], function(key, role_value){
                        roles += '<span class="badge badge-info">' + role_value['name'] + '</span>';
                    });
                    var company = '';
                    if (value['company'] != null)
                    {
                        company = value['company']['name'];
                    }
                    var avatar_url = "{{ url('/') }}" + "/" + value['photo'];
                    var avatar = "<img src='"+avatar_url+"' alt='table-user' class='mr-2 rounded-circle' height='40px;'>";
                    table.row.add(['', index, avatar+name, email, company, roles, action_td]).draw().node().id = value['id'];
                    index++;
                });
                if(parseInt($($("tbody").find("tr:eq(0)")).attr("id")) == 1)
                {
                    $("tbody>tr:eq(0)").find("td:eq(0)").html("");
                }
            }
        });
    }
</script>
@endsection