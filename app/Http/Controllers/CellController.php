<?php

namespace App\Http\Controllers;

use App\Models\Cell;
use App\Models\Member;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;


class CellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cells = Cell::all();
        $data['cells'] = $cells;
        return view('cell.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $members = Member::all();
        //dd($members);
        $data['members'] = $members;
        return view('cell.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $cells = Cell::all();
        $data['cells'] = $cells;

        Cell::create($request->all());
        return redirect()->route('cell.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function show(Cell $cell)
    {
        //
    }

    public function get_cell(Request $request)
    {
        if (!Sentinel::hasAccess('cell')) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $query = Cell::query();
        return DataTables::of($query)->make(true);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function edit(Cell $cell)
    {

        $members = Member::all();
        //dd($members);
        $data['members'] = $members;
        $data['cell'] = $cell;

        return view('cell.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cell $cell)
    {

        // $request->validate([
        //     'name' => 'required',
        //     'leader' => 'required|integer|min:1',
        // ]);

        $cell->update($request->all());
        $data['cell'] = Cell::all();
        return redirect()->route('cell.index',$data)
            ->with('success', 'cell updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cell $cell)
    {
        //dd($cell);
        $data['cell'] = Cell::all();
        $cell->delete();
        return redirect()->route('cell.index',$data)
            ->with('success', 'Cell deleted successfully');
    }
}
