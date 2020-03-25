<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\Company;
use Illuminate\Support\Collection;
use Excel;

class UsersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('admin_permission') && !Gate::allows("teacher_permission")) {
            return abort(401);
        }

        $roles = Role::all();
        if(!\Session::has('role_selected'))
            \Session::put('role_selected', 'Administrator');

        return view('admin.users.index', compact('roles'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('admin_permission') && !Gate::allows("teacher_permission")) {
            return abort(401);
        }
        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Show the form for creating new User by type.
     *
     * @return \Illuminate\Http\Response
     */
    public function createbytype($id)
    {
        if (! Gate::allows('admin_permission') && !Gate::allows("teacher_permission")) {
            return abort(401);
        }
        \Session::put('role_selected', $id);
        $companies = Company::all();
        $roles = Role::where("name", $id)->get()->pluck('name', 'name');

        return view('admin.users.create', compact('roles', 'companies'));
    }

    /**
     * Show the form for creating new Student by group.
     *
     * @return \Illuminate\Http\Response
     */
    public function createbygroup($id)
    {
        if (! Gate::allows('admin_permission') && !Gate::allows("teacher_permission")) {
            return abort(401);
        }
        \Session::put('role_selected', $id);
        $companies = Company::all();
        $roles = Role::where("name", $id)->get()->pluck('name', 'name');

        return view('admin.users.createbygroup', compact('roles', 'companies'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        if (! Gate::allows('admin_permission') && !Gate::allows("teacher_permission")) {
            return abort(401);
        }
        $request['company_id'] = $request->company;

        if ($request->hasFile('avatar')) {
            $request['photo'] = $request->avatar->store('assets/images/users', 'store');
        }

        $user = User::create($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        \Session::put('role_selected', $user->roles()->first()->name);
        return redirect()->route('admin.users.index');
    }


    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store_group(Request $request)
    {
        if (! Gate::allows('admin_permission') && !Gate::allows("teacher_permission")) {
            return abort(401);
        }
        $request->validate([
            'student_file' => 'required'
        ]);

        $file = $request->student_file;
        
        Excel::import(new \App\Imports\ImportUsers, request()->file('student_file'));

        return redirect()->route('admin.users.index')->with('success_student', trans('cruds.user.student_import_succuess'));
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (! Gate::allows('admin_permission') && !Gate::allows("teacher_permission")) {
            return abort(401);
        }
        $companies = Company::all();
        $roles = Role::where("name", $user->roles()->first()->name)->get()->pluck('name', 'name');

        \Session::put('role_selected', $user->roles()->first()->name);

        return view('admin.users.edit', compact('user', 'roles', 'companies'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, User $user)
    {
        if (! Gate::allows('admin_permission') && !Gate::allows("teacher_permission")) {
            return abort(401);
        }

        $request['company_id'] = $request->company;

        if ($request->hasFile('avatar')) {
            $request['photo'] = $request->avatar->store('assets/images/users', 'store');
        }

        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);
        
        \Session::put('role_selected', $user->roles()->first()->name);

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        if (! Gate::allows('admin_permission') && !Gate::allows("teacher_permission")) {
            return abort(401);
        }

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (! Gate::allows('admin_permission') && !Gate::allows("teacher_permission")) {
            return abort(401);
        }

        \Session::put('role_selected', $user->roles()->first()->name);

        $user->delete();

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('admin_permission') && !Gate::allows("teacher_permission")) {
            return abort(401);
        }
        User::whereIn('id', request('ids'))->delete();
        return response()->noContent();
    }

    public function getdata(Request $request)
    {
        $role = request('role');
        
        $users = User::with("company")->with("roles")->whereHas(
            'roles', function($q) use ($role){
                $q->where('name', $role);
            }
        )->get()->toArray();

        \Session::put('role_selected', $role);

        return json_encode($users);
    }

}
