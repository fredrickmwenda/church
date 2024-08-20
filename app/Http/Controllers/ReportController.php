<?php

namespace App\Http\Controllers;

use Aloha\Twilio\Twilio;
use App\Helpers\BulkSms;
use App\Helpers\GeneralHelper;
use App\Models\Borrower;

use App\Models\Branch;
use App\Models\Collateral;
use App\Models\CollateralType;
use App\Models\Contribution;
use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\EventPayment;
use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Loan;
use App\Models\LoanRepayment;
use App\Models\LoanSchedule;
use App\Models\OtherIncome;
use App\Models\Payroll;
use App\Models\Pledge;
use App\Models\PledgePayment;
use App\Models\SavingTransaction;
use App\Models\Setting;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Clickatell\Api\ClickatellHttp;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class ReportController extends Controller
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
    public function cash_flow(Request $request)
    {
        if (!Sentinel::hasAccess('reports')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $branch_id = $request->branch_id;
        $expenses = Expense::when($start_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })->when($branch_id, function ($query) use ($branch_id) {
            $query->where('branch_id', $branch_id);
        })->sum('amount');
        $payroll = Payroll::when($start_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })->when($branch_id, function ($query) use ($branch_id) {
            $query->where('branch_id', $branch_id);
        })->sum('paid_amount');
        $contributions = Contribution::when($start_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })->when($branch_id, function ($query) use ($branch_id) {
            $query->where('branch_id', $branch_id);
        })->sum('amount');
        $other_income = OtherIncome::when($start_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })->when($branch_id, function ($query) use ($branch_id) {
            $query->where('branch_id', $branch_id);
        })->sum('amount');
        $events = EventPayment::leftJoin('events', 'events.id', 'event_payments.event_id')
            ->when($start_date, function ($query) use ($start_date, $end_date) {
                $query->whereBetween('event_payments.date', [$start_date, $end_date]);
            })->when($branch_id, function ($query) use ($branch_id) {
                $query->where('events.branch_id', $branch_id);
            })->sum('event_payments.amount');
        $pledges = PledgePayment::leftJoin('pledges', 'pledges.id', 'pledge_payments.pledge_id')
            ->when($start_date, function ($query) use ($start_date, $end_date) {
                $query->whereBetween('pledge_payments.date', [$start_date, $end_date]);
            })->when($branch_id, function ($query) use ($branch_id) {
                $query->where('pledges.branch_id', $branch_id);
            })->sum('pledge_payments.amount');
        $branches = array();
        foreach (Branch::get() as $key) {
            $branches[$key->id] = $key->name;
        }
        $total_payments = $expenses + $payroll;
        $total_receipts = $pledges + $contributions + $other_income + $events;
        $cash_balance = $total_receipts - $total_payments;
        return view('report.cash_flow',
            compact('expenses', 'payroll', 'contributions', 'total_payments', 'other_income', 'pledges',
                'total_receipts', 'cash_balance', 'start_date',
                'end_date', 'events', 'branch_id', 'branches'));
    }

    public function profit_loss(Request $request)
    {
        if (!Sentinel::hasAccess('reports')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $branch_id = $request->branch_id;
        $expenses = Expense::when($start_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })->when($branch_id, function ($query) use ($branch_id) {
            $query->where('branch_id', $branch_id);
        })->sum('amount');
        $payroll = Payroll::when($start_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })->when($branch_id, function ($query) use ($branch_id) {
            $query->where('branch_id', $branch_id);
        })->sum('paid_amount');
        $contributions = Contribution::when($start_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })->when($branch_id, function ($query) use ($branch_id) {
            $query->where('branch_id', $branch_id);
        })->sum('amount');
        $other_income = OtherIncome::when($start_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })->when($branch_id, function ($query) use ($branch_id) {
            $query->where('branch_id', $branch_id);
        })->sum('amount');
        $events = EventPayment::leftJoin('events', 'events.id', 'event_payments.event_id')
            ->when($start_date, function ($query) use ($start_date, $end_date) {
                $query->whereBetween('event_payments.date', [$start_date, $end_date]);
            })->when($branch_id, function ($query) use ($branch_id) {
                $query->where('events.branch_id', $branch_id);
            })->sum('event_payments.amount');
        $pledges = PledgePayment::leftJoin('pledges', 'pledges.id', 'pledge_payments.pledge_id')
            ->when($start_date, function ($query) use ($start_date, $end_date) {
                $query->whereBetween('pledge_payments.date', [$start_date, $end_date]);
            })->when($branch_id, function ($query) use ($branch_id) {
                $query->where('pledges.branch_id', $branch_id);
            })->sum('pledge_payments.amount');
        $operating_expenses = $expenses + $payroll;
        $operating_profit = $contributions + $pledges + $other_income + $events;
        $gross_profit = $operating_profit - $operating_expenses;
        $net_profit = $gross_profit;
        //build graphs here
        $monthly_net_income_data = array();
        $monthly_operating_profit_expenses_data = array();
        $monthly_overview_data = array();
        if (isset($request->end_date)) {
            $date = $request->end_date;
        } else {
            $date = date("Y-m-d");
        }
        $branches = array();
        foreach (Branch::get() as $key) {
            $branches[$key->id] = $key->name;
        }
        $start_date1 = date_format(date_sub(date_create($date),
            date_interval_create_from_date_string('1 years')),
            'Y-m-d');
        $start_date2 = date_format(date_sub(date_create($date),
            date_interval_create_from_date_string('1 years')),
            'Y-m-d');
        $start_date3 = date_format(date_sub(date_create($date),
            date_interval_create_from_date_string('1 years')),
            'Y-m-d');
        for ($i = 1; $i < 14; $i++) {
            $d = explode('-', $start_date1);
            $o_profit = Contribution::where('year', $d[0])->where('month',
                    $d[1])->sum('amount') + OtherIncome::where('year', $d[0])->where('month',
                    $d[1])->sum('amount') + PledgePayment::where('year', $d[0])->where('month', $d[1])->sum('amount') + EventPayment::where('year', $d[0])->where('month',
                    $d[1])->sum('amount');
            $o_expense = Expense::where('year', $d[0])->where('month',
                $d[1])->sum('amount');
            foreach (Payroll::where('year', $d[0])->where('month',
                $d[1])->get() as $key) {
                $o_expense = $o_expense + GeneralHelper::single_payroll_total_pay($key->id);
            }

            $ext = ' ' . $d[0];
            $n_income = $o_profit - $o_expense;
            array_push($monthly_net_income_data, array(
                'month' => date_format(date_create($start_date1),
                    'M' . $ext),
                'amount' => $n_income

            ));
            //add 1 month to start date
            $start_date1 = date_format(date_add(date_create($start_date1),
                date_interval_create_from_date_string('1 months')),
                'Y-m-d');
        }
        for ($i = 1; $i < 14; $i++) {
            $d = explode('-', $start_date2);
            //get loans in that period
            $o_profit = Contribution::where('year', $d[0])->where('month',
                    $d[1])->sum('amount') + OtherIncome::where('year', $d[0])->where('month',
                    $d[1])->sum('amount') + PledgePayment::where('year', $d[0])->where('month', $d[1])->sum('amount') + EventPayment::where('year', $d[0])->where('month',
                    $d[1])->sum('amount');
            $o_expense = Expense::where('year', $d[0])->where('month',
                $d[1])->sum('amount');
            foreach (Payroll::where('year', $d[0])->where('month',
                $d[1])->get() as $key) {
                $o_expense = $o_expense + GeneralHelper::single_payroll_total_pay($key->id);
            }

            $ext = ' ' . $d[0];
            array_push($monthly_operating_profit_expenses_data, array(
                'month' => date_format(date_create($start_date2),
                    'M' . $ext),
                'profit' => $o_profit,
                'expenses' => $o_expense

            ));
            //add 1 month to start date
            $start_date2 = date_format(date_add(date_create($start_date2),
                date_interval_create_from_date_string('1 months')),
                'Y-m-d');
        }
        for ($i = 1; $i < 14; $i++) {
            $d = explode('-', $start_date3);
            //get loans in that period
            $contributions = Contribution::where('year', $d[0])->where('month',
                $d[1])->sum('amount');
            $pledges = PledgePayment::where('year', $d[0])->where('month', $d[1])->sum('amount');
            $other_income = OtherIncome::where('year', $d[0])->where('month',
                $d[1])->sum('amount');
            $events = EventPayment::where('year', $d[0])->where('month',
                $d[1])->sum('amount');

            $ext = ' ' . $d[0];
            array_push($monthly_overview_data, array(
                'month' => date_format(date_create($start_date3),
                    'M' . $ext),
                'contributions' => $contributions,
                'pledges' => $pledges,
                'other_income' => $other_income,
                'events' => $events
            ));
            //add 1 month to start date
            $start_date3 = date_format(date_add(date_create($start_date3),
                date_interval_create_from_date_string('1 months')),
                'Y-m-d');
        }
        $monthly_net_income_data = json_encode($monthly_net_income_data);
        $monthly_operating_profit_expenses_data = json_encode($monthly_operating_profit_expenses_data);
        $monthly_overview_data = json_encode($monthly_overview_data);
        return view('report.profit_loss',
            compact('expenses', 'payroll', 'operating_expenses', 'other_income',
                'contributions', 'pledges', 'operating_profit', 'gross_profit', 'start_date',
                'end_date', 'net_profit', 'monthly_net_income_data',
                'monthly_operating_profit_expenses_data', 'monthly_overview_data', 'events', 'branch_id', 'branches'));
    }


}
