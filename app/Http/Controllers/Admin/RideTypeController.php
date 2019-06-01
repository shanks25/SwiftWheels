<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AssignRideTypeRequest;
use App\Http\Requests\StoreRideTypeRequest;
use App\Provider;
use App\ProviderRide;
use App\RideType;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RideTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rides = RideType::all();

        return view('admin.ride_type.index', compact('rides'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.ride_type.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRideTypeRequest $request)
    {

        try {

            //
            $ride = new RideType();
            $ride->name = $request->name;
            $ride->description = $request->description;

            if ($request->image != "") {
                $ride->image = $request->image->store('rides');
            }

            $ride->save();

            return redirect()->back()->with('flash_success', 'Profile Updated');

        } catch (Exception $e) {
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
        $ride = RideType::find($id);

        return view('admin.ride_type.edit', compact('ride'));
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

        try {
            $ride = RideType::find($id);

            if ($ride) {

                //
                if ($request->has('name')) {
                    $ride->name = $request->name;
                }
                if ($request->has('description')) {
                    $ride->description = $request->description;
                }

                if ($request->image != "") {
                    $ride->image = $request->image->store('rides');
                }

                $ride->save();

                return redirect()->back()->with('flash_success', 'Ride Updated');

            } else {

            }
        } catch (Exception $e) {
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

        $ride = RideType::find($id);

        if ($ride) {

            $ride->delete();

            return redirect()->back()->with('flash_success', 'Ride Deleted Successfully.');

        }

    }

    public function assignRide(AssignRideTypeRequest $request, $provider)
    {

        $providerUser = Provider::find($provider);

        if ($providerUser) {

            $providerRideType = ProviderRide::where('provider_id', $providerUser->id)
                ->where('ride_type_id', $request->ride_type)
                ->first();

            if (!$providerRideType) {
                $providerRideType = new ProviderRide();
                $providerRideType->provider_id = $providerUser->id;
                $providerRideType->ride_type_id = $request->ride_type;
            }

            $providerRideType->status = 'active';

            $providerRideType->save();

            return redirect()->back()->with('flash_success', 'Ride Assigned Successfully.');
        } else {
            return back()->with('flash_error', 'Something Went Wrong!');
        }

    }

    public function deleteAssignRide($provider, $ride_type)
    {

        $providerUser = Provider::find($provider);

        if ($providerUser) {

            $providerRideType = ProviderRide::where('provider_id', $provider)
                ->where('ride_type_id', $ride_type)
                ->first();

            if ($providerRideType) {
                $providerRideType->delete();
            }

            return redirect()->back()->with('flash_success', 'Ride Assignment Deleted Successfully.');
        } else {
            return back()->with('flash_error', 'Something Went Wrong!');
        }

    }

}
