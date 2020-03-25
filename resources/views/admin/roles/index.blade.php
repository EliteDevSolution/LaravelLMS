@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">
                        <i class="fe-user"></i><span> {{ trans('cruds.role.title_singular') }} {{ trans('global.list') }} </span>
                    </li>
                </ol>
            </div>
            <h4 class="page-title">{{ trans('cruds.role.title_singular') }} {{ trans('global.list') }}</h4>
        </div>
    </div>
</div>
<div class="card">
    <div class="p-4">
        <a class="btn btn-success" href="{{ route("admin.roles.create") }}">
            <i class="icon-plus"></i>
            {{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}
        </a>
    </div>

    <div class="card-body">
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
                            {{ trans('cruds.role.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.role.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.role.fields.permissions') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $key => $role)
                        <tr id="{{ $role->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $role->id ?? '' }}
                            </td>
                            <td>
                                {{ $role->name ?? '' }}
                            </td>
                            <td>
                                @foreach($role->permissions()->pluck('name') as $permission)
                                    <span class="badge badge-info">{{ $permission }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.roles.show', $role->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('admin.roles.edit', $role->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block; margin:0;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
    $(function () {
        $("#delete_selected").click(function () {
            var ids = [];
            $("#datatable>tbody").find("input:checkbox").each(function (i, e) {
                if ($(this).is(":checked"))
                {
                    ids.push($(this).parents("[role=row]").attr("id"));
                }
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
                url: "{{ route('admin.roles.mass_destroy') }}",
                type: 'POST',
                data: { ids: ids, _method: 'DELETE' }
            }).done( function () {
                location.reload();
            });
        });

        var table = $('#datatable').DataTable({
            "scrollY": "480px",
            'columnDefs': [
                {
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                }
            ],
            // 'select': {
            //     'style': 'multi'
            // },
            'order': [[1, 'asc']]
        });
    })
</script>
@endsection