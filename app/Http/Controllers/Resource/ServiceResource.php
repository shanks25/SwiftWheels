<?php

namespace App\Http\Controllers\Resource;

use App\RideServicePrice;
use App\RideType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Setting;
use Exception;
use App\Helpers\Helper;

use App\ServiceType;

class ServiceResource extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = ServiceType::all();
        if ($request->ajax()) {
            return $services;
        } else {
            return view('admin.service.index', compact('services'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $ride_types = RideType::all();

        return view('admin.service.create', compact('ride_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'provider_name' => 'required|max:255',
            'capacity' => 'required|numeric',
            'image' => 'mimes:ico,png,jpg,jpeg'
        ]);

        try {
            $service = $request->all();

            if ($request->hasFile('image')) {
                $service['image'] = Helper::upload_picture($request->image);
            }

            $service = ServiceType::create($service);

            $ride_types = RideType::all();

            foreach ($ride_types as $ride_type) {
                $ride_service_price = new RideServicePrice();
                $ride_service_price->service_type_id = $service->id;
                $ride_service_price->ride_type_id = $ride_type->id;
                $ride_service_price->fixed = $request[$ride_type->id . '_fixed'];
                $ride_service_price->price = $request[$ride_type->id . '_price'];
                $ride_service_price->minute = $request[$ride_type->id . '_minute'];
                $ride_service_price->distance = $request[$ride_type->id . '_distance'];
                $ride_service_price->calculator = $request[$ride_type->id . '_calculator'];
                $ride_service_price->max_distance = $request[$ride_type->id . '_max_distance'];
                $ride_service_price->max_distance_price = $request[$ride_type->id . '_max_distance_price'];
                $ride_service_price->save();
            }

            return back()->with('flash_success', 'Service Type Saved Successfully');
        } catch (Exception $e) {
            dd("Exception", $e);
            return back()->with('flash_error', 'Service Type Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceType $serviceType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return ServiceType::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Service Type Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceType $serviceType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $service = ServiceType::with('ride_service_prices')->findOrFail($id);

            $ride_types = RideType::all();
            

            return view('admin.service.edit', compact('service', 'ride_types'));
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Service Type Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\ServiceType $serviceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'provider_name' => 'required|max:255',
            'image' => 'mimes:ico,png'
        ]);

        try {

            $service = ServiceType::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($service->image) {
                    Helper::delete_picture($service->image);
                }
                $service->image = Helper::upload_picture($request->image);
            }

            $service->name = $request->name;
            $service->provider_name = $request->provider_name;
            $service->capacity = $request->capacity;

            $ride_types = RideType::all();

//            RideServicePrice::where('service_type_id', $service->id)->delete();

//            dd($request->all());

            foreach ($ride_types as $ride_type) {

                $ride_service_price = RideServicePrice::where('service_type_id', $service->id)
                    ->where('ride_type_id', $ride_type->id)
                    ->first();

                if (!$ride_service_price) {
                    $ride_service_price = new RideServicePrice();
                    $ride_service_price->service_type_id = $service->id;
                    $ride_service_price->ride_type_id = $ride_type->id;
                }
                $ride_service_price->fixed = $request[$ride_service_price->id . '_fixed'];
                $ride_service_price->price = $request[$ride_service_price->id . '_price'];
                $ride_service_price->minute = $request[$ride_service_price->id . '_minute'];
                $ride_service_price->distance = $request[$ride_service_price->id . '_distance'];
                $ride_service_price->calculator = $request[$ride_service_price->id . '_calculator'];
                $ride_service_price->max_distance = $request[$ride_service_price->id . '_max_distance'];
                $ride_service_price->max_distance_price = $request[$ride_service_price->id . '_max_distance_price'];
                $ride_service_price->save();
                
           //     print_r($ride_service_price); die;

            }

            $service->save();

            return redirect()->route('admin.service.index')->with('flash_success', 'Service Type Updated Successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Service Type Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceType $serviceType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            ServiceType::find($id)->delete();
            return back()->with('message', 'Service Type deleted successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Service Type Not Found');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Service Type Not Found');
        }
    }
}