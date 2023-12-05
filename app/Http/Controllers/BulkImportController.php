<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Rap2hpoutre\FastExcel\FastExcel;

class BulkImportController extends Controller
{
    public function home()
    {
        return Inertia::render('City/Home');
    }

    public function dashboard()
    {
        return Inertia::render('Dashboard/Index');
    }

    public function bulkImport(Request $request)
    {
        try {
            $collections = (new FastExcel)->import($request->file('file'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'You have uploaded a wrong format file, please upload the right file.');
        }
        $data = [];
        $col_key = ['city', 'city_ascii', 'state_id', 'state_name', 'county_fips', 'county_name', 'lat', 'lng', 'population', 'density', 'source', 'military', 'incorporated', 'timezone', 'ranking', 'zips', 'id'];
        foreach ($collections as $collection) {
            foreach ($collection as $key => $value) {
                if ($key != "" && $value === "" && !in_array($key, $col_key)) {
                    return redirect()->back()->with('error', 'Please fill ' . $key . ' fields');
                }
            }

            array_push($data, [
                'id' => $collection['id'],
                'city' => $collection['city'],
                'city_ascii' => $collection['city_ascii'],
                'state_id' => $collection['state_id'],
                'state_name' => $collection['state_name'],
                'county_fips' => $collection['county_fips'],
                'county_name' => $collection['county_name'],
                'lat' => $collection['lat'],
                'lng' => $collection['lng'],
                'population' => $collection['population'],
                'density' => $collection['density'],
                'source' => $collection['source'],
                'incorporated' => filter_var($collection['incorporated'], FILTER_VALIDATE_BOOLEAN),
                'military' => filter_var($collection['military'], FILTER_VALIDATE_BOOLEAN),
                'timezone' => $collection['timezone'],
                'ranking' => $collection['ranking'],
                'zips' => $collection['zips'],
            ]);
        }
        DB::table('cities')->insert($data);
        return true;
    }

    public function cityIndex(Request $request)
    {
        return inertia('City/Index', [
            'cities' => City::
            when(request('county_name') != null, function ($query) {
                $query->where('county_name', 'like', '%' . request('county_name') . '%');
            })
                ->when(request('state_name') != null, function ($query) {
                    $query->where('state_name', 'like', '%' . request('state_name') . '%');
                })
                ->paginate(request()->get('limit') ?? 10)
                ->withQueryString()
                ->through(fn($city) => [
                    'id' => $city->id,
                    'city_name' => $city->city,
                    'county_name' => $city->county_name,
                    'state_name' => $city->state_name,
                ]),
            'countries' => City::take(10)->get(['county_name']),
            'states' => City::take(10)->get(['state_name']),
            'filter_data' => $request->all(),
        ]);
    }

    public function cityDetails($id)
    {
        return response()->json([
            'city' => City::find($id)
        ]);
    }

    public function city(Request $request)
    {
        return inertia('City/SearchResult', [
            'cities' => City::
            when(request('key') != null, function ($query) {
                $query->where('city', 'like', '%' . request('key') . '%');
                $query->orWhere('county_name', 'like', '%' . request('key') . '%');
                $query->orWhere('state_name', 'like', '%' . request('key') . '%');
            })->get(['id', 'city', 'county_name', 'state_name',])
        ]);
    }
}
