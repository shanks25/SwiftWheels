<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreOutstationPriceRequest;
use App\Outstation;
use App\OutstationPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OutstationPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $outstations_prices = OutstationPrice::all();

        return view('admin.outstations.prices.index', compact('outstations_prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $outstations = Outstation::all();

        return view('admin.outstations.prices.create', compact('outstations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutstationPriceRequest $request)
    {

        if ($request->source_id == $request->destination_id) {
            return redirect()->back()->withErrors('Source and destination should be different.');
        }

        //
        $outstationPrice = new OutstationPrice();
        $outstationPrice->source_id = $request->source_id;
        $outstationPrice->destination_id = $request->destination_id;
        $outstationPrice->fixed = $request->fixed;
        $outstationPrice->price = $request->price;
        $outstationPrice->distance = $request->distance;
        $outstationPrice->save();

        return redirect()->back()->with('flash_success', 'Outstations prices added successfully.');
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
        $outstations_price = OutstationPrice::find($id);

        $outstations = Outstation::all();

        return view('admin.outstations.prices.edit', compact('outstations_price', 'outstations'));
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
        //
        if ($request->source_id == $request->destination_id) {
            return redirect()->back()->withErrors('Source and destination should be different.');
        }

        $outstationPrice = OutstationPrice::find($id);

        if ($outstationPrice) {

            $outstationPrice->source_id = $request->source_id;
            $outstationPrice->destination_id = $request->destination_id;
            $outstationPrice->fixed = $request->fixed;
            $outstationPrice->price = $request->price;
            $outstationPrice->distance = $request->distance;
            $outstationPrice->save();

            return redirect()->back()->with('flash_success', 'Outstations prices added successfully.');
        } else {
            return redirect()->back()->with('flash_success', 'Outstations does not exists.');
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
        $outstation_price = OutstationPrice::find($id);

        if ($outstation_price) {

            $outstation_price->delete();

            return redirect()->back()->with('flash_success', 'Outstations prices deleted successfully.');
        } else {
            return redirect()->back()->with('flash_success', 'Outstations does not exists.');
        }

    }

    public function testing()
    {
        $latitude = 18.753749;
        $longitude = 74.2470779;

        $sourceOutstation = Outstation::select(DB::Raw("(6371 * acos( cos( radians('$latitude') ) * cos( radians(latitude) ) 
        * cos( radians(longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitude) ) ) ) AS distance"), 'name', 'id')
            ->whereRaw("(6371 * acos( cos( radians('$latitude') ) * cos( radians(latitude) ) * cos( radians(longitude) - 
            radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitude) ) ) ) <= 50")
            ->orderBy('distance', 'asc')
            ->first();

        return $sourceOutstation;

    }

}
