<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreOutstationPriceRequest;
use App\Http\Requests\StoreOutstationRequest;
use App\Outstation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session\Store;

class OutstationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $outstations = Outstation::all();

        return view('admin.outstations.index', compact('outstations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.outstations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutstationRequest $request)
    {

        $outstation = new Outstation();

        $outstation->name = $request->name;
        $outstation->address = $request->place;
        $outstation->latitude = $request->latitude;
        $outstation->longitude = $request->longitude;

        $outstation->save();

        if ($outstation) {
            return redirect()->back()->with('flash_success', 'Out station added successfully.');
        } else {
            return back()->with('flash_error', 'Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $outstation = Outstation::find($id);

        return view('admin.outstations.edit', compact('outstation'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOutstationRequest $request, $id)
    {
        $outstation = Outstation::find($id);

        if ($request->has('name')) {
            $outstation->name = $request->name;
        }
        if ($request->has('place')) {
            $outstation->address = $request->place;
        }
        if ($request->has('latitude')) {
            $outstation->latitude = $request->latitude;
        }
        if ($request->has('longitude')) {
            $outstation->longitude = $request->longitude;
        }

        $outstation->save();

        if ($outstation) {
            return redirect()->back()->with('flash_success', 'Out station updated successfully.');
        } else {
            return back()->with('flash_error', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $outstation = Outstation::find($id);

        if ($outstation) {

            $outstation->delete();

            return redirect()->back()->with('flash_success', 'Outstation Deleted Successfully.');

        }
    }

}
