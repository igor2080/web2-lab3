<?php

namespace App\Http\Controllers;

use App\Models\Carmodel;
use App\Models\Country;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($countryslug)
    {
        //look up the country by its 2-letter code
        $country = Country::where('code', '=', $countryslug)->first();

        #use Eloquent relations to find all manufacturers in that country
        $manufacturers = $country->manufacturers()->get();

        return view('manufacturers', ['country' => $country, 'manufacturers' => $manufacturers]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($countryslug)
    {
        $country = Country::where('code', '=', $countryslug)->first();
        return view('manufacturer_new', compact('country'));
    }

    public function create_model($id)
    {
        $manufacturer = Manufacturer::where('id', '=', $id)->first();
        return view('manufacturer_carmodels_new', ['manufacturer' => $manufacturer]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'founded' => 'required|integer|min:0|max:' . now()->year,
            'website' => ['required', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'manufacturer_name' => 'required|max:15|unique:manufacturers,name'
        ], [
            'founded.min' => 'Foundation year must be a positive number',
            'founded.max' => 'Foundation year must not be in the future',
            'website.regex' => 'The website must be a valid URL',
            'manufacturer_name.max' => 'The name must not be longer than 15 characters',
            'manufacturer.unique' => 'This manufacturer already exists'
        ])->validate();
        $manufacturer = new Manufacturer();
        $manufacturer->name = $request->manufacturer_name;
        $manufacturer->founded = $request->founded;
        $manufacturer->website = $request->website;
        $manufacturer->country_id = $request->country_id;
        $manufacturer->save();
        #to perform a redirect back, we need country code from ID
        $country = Country::findOrFail($request->country_id);
        $action = action([ManufacturerController::class, 'index'], ['countryslug' =>
        $country->code]);
        return redirect($action);
    }

    public function store_model(Request $request)
    {
        $manufacturer = Manufacturer::where('id', '=', $request->manufacturer_id)->first();
        $validator = Validator::make($request->all(), [
            'model_name' => 'required',
            'min_price' => 'required|numeric|min:0',
            'production_started' => 'required|integer|min:1900'
        ], [
            'min_price.min' => 'The price must be a positive number',
            'production_started.min' => 'The year must be at least 1900'
        ])->validate();
        $carmodel = new Carmodel();
        $carmodel->name = $request->model_name;
        $carmodel->manufacturer_id = $request->manufacturer_id;
        $carmodel->production_started = $request->production_started;
        $carmodel->min_price = $request->min_price;
        $manufacturer->carmodels()->save($carmodel);
        $manufacturer->save();
        return redirect('/manufacturer/' . $manufacturer->id . '/models');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $manufacturer = Manufacturer::where('id', '=', $id)->first();
        $carmodels = $manufacturer->carmodels()->get();
        return view('manufacturer_carmodels', ['carmodels' => $carmodels, 'manufacturer' => $manufacturer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        return view('manufacturer_edit', compact('manufacturer'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'founded' => 'required|integer|min:0|max:' . now()->year,
            'website' => ['required', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'manufacturer_name' => 'required|max:15|unique:manufacturers,name,' . $id
        ], [
            'founded.min' => 'Foundation year must be a positive number',
            'founded.max' => 'Foundation year must not be in the future',
            'website.regex' => 'The website must be a valid URL',
            'manufacturer_name.max' => 'The name must not be longer than 15 characters',
            'manufacturer.unique' => 'This manufacturer already exists'
        ])->validate();
        $manufacturer->name = $request->manufacturer_name;
        $manufacturer->website = $request->website;
        $manufacturer->founded = $request->founded;
        $manufacturer->save();
        return redirect(action(
            [ManufacturerController::class, 'index'],
            ['countryslug' => $manufacturer->country->code]
        ));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Manufacturer::findOrfail($id)->delete();
        return back();
    }
}
