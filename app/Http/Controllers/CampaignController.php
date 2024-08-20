<?php

namespace App\Http\Controllers;

use Aloha\Twilio\Twilio;
use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\Campaign;
use App\Models\Pledge;
use App\Models\PledgePayment;
use App\Models\Setting;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class CampaignController extends Controller
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
        if (!Sentinel::hasAccess('pledges.view')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $data = Campaign::all();

        return view('campaign.data', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Sentinel::hasAccess('pledges.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        //get custom fields
        return view('campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Sentinel::hasAccess('pledges.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $campaign = new Campaign();
        $campaign->user_id = Sentinel::getUser()->id;
        $campaign->name = $request->name;
        $campaign->goal = $request->goal;
        $campaign->start_date = $request->start_date;
        if (!empty($request->end_date)) {
            $campaign->end_date = $request->end_date;
        }
        $date = explode('-', $request->start_date);
        $campaign->year = $date[0];
        $campaign->month = $date[1];
        $campaign->notes = $request->notes;
        $campaign->save();
        Flash::success(trans('general.successfully_saved'));
        return redirect('pledge/campaign/data');
    }


    public function show($campaign)
    {
        if (!Sentinel::hasAccess('pledges.view')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        return view('campaign.show', compact('campaign'));
    }


    public function edit($campaign)
    {
        if (!Sentinel::hasAccess('pledges.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        return view('campaign.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Sentinel::hasAccess('pledges.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $campaign = Campaign::find($id);
        $campaign->name = $request->name;
        $campaign->goal = $request->goal;
        $campaign->start_date = $request->start_date;
        if (!empty($request->end_date)) {
            $campaign->end_date = $request->end_date;
        }
        $date = explode('-', $request->start_date);
        $campaign->year = $date[0];
        $campaign->month = $date[1];
        $campaign->notes = $request->notes;
        $campaign->save();
        Flash::success(trans('general.successfully_saved'));
        return redirect('pledge/campaign/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (!Sentinel::hasAccess('pledges.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        Campaign::destroy($id);
        foreach (Pledge::where('campaign_id', $id)->get() as $key) {
            PledgePayment::where('pledge_id', $key->id)->delete();
            Pledge::destroy($key->id);
        }
        Flash::success(trans('general.successfully_deleted'));
        return redirect('pledge/campaign/data');
    }

    public function close($id)
    {
        if (!Sentinel::hasAccess('pledges.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $campaign = Campaign::find($id);
        $campaign->status = 1;
        $campaign->save();
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }

    public function open($id)
    {
        if (!Sentinel::hasAccess('pledges.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $campaign = Campaign::find($id);
        $campaign->status = 0;
        $campaign->save();
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }
}
