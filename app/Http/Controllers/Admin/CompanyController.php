<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of Company.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('admin_permission')) {
            return abort(401);
        }
        
        $companies = Company::all();

        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating new Company.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('admin_permission')) {
            return abort(401);
        }
        
        return view('admin.company.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('admin_permission')) {
            return abort(401);
        }
        
        $data = $request->validate([
            'name' => 'required|string|max:190|unique:companies,name',
        ]);
        Company::create($data);

        return redirect()->route('admin.company.index');
    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        if (! Gate::allows('admin_permission')) {
            return abort(401);
        }

        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        if (! Gate::allows('admin_permission')) {
            return abort(401);
        }
        $data = $request->validate([
            'name' => 'required|string|max:190|unique:companies,name, '.$company->id,
        ]);

        $company->update($data);

        return redirect()->route('admin.company.index');
    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if (! Gate::allows('admin_permission')) {
            return abort(401);
        }

        $company->delete();

        return redirect()->route('admin.company.index');
    }

    public function show(Company $company)
    {
        if (! Gate::allows('admin_permission')) {
            return abort(401);
        }

        return view('admin.company.show', compact('company'));
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        Company::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
