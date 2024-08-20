<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\ContributionBatch;
use App\Models\ContributionType;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ContributionTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('sentinel');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Sentinel::hasAccess('contributions')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $data = ContributionType::all();

        return view('contribution_type.data', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Sentinel::hasAccess('contributions.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        //get custom fields
        return view('contribution_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Sentinel::hasAccess('contributions.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $contribution_type = new ContributionType();
        $contribution_type->name = $request->name;
        $contribution_type->save();
        Flash::success(trans('general.successfully_saved'));
        return redirect('contribution/type/data');
    }


    public function show($contribution_type)
    {
        if (!Sentinel::hasAccess('contributions.view')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        return view('contribution_type.show', compact('contribution_type'));
    }


    public function edit($contribution_type)
    {
        if (!Sentinel::hasAccess('contributions.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        return view('contribution_type.edit', compact('contribution_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Sentinel::hasAccess('contributions.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $contribution_type = ContributionBatch::find($id);
        $contribution_type->name = $request->name;
        $contribution_type->save();
        Flash::success(trans('general.successfully_saved'));
        return redirect('contribution/type/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (!Sentinel::hasAccess('contributions.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        ContributionType::destroy($id);
        Flash::success(trans('general.successfully_deleted'));
        return redirect('contribution/type/data');
    }

}
