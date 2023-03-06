<?php

namespace App\Http\Controllers;

use App\Models\LandProperty;
use App\Models\People;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OverviewController
{
    public function index(): View
    {
        $filter = request()->get('filter');

        if (!$filter) {
            $filter = 'all';

        }

        if ($filter == 'all') {
            $people = People::orderBy('id', 'desc')->get();
            $landProperties = DB::table('land_properties')
                ->join('people', 'land_properties.people_id', '=', 'people.id')
                ->select('people.id as person_id', 'land_properties.id as land_property_id','people.type', 'people.title', 'land_properties.name', 'land_properties.cadastre_number')
                ->get();

            $landPropertyInfos = DB::table('land_property_infos')
                ->join('land_properties', 'land_property_infos.land_property_id', '=', 'land_properties.id')
                ->join('people', 'land_properties.people_id', '=', 'people.id')
                ->select('people.id as person_id', 'land_property_id as land_property_id', 'land_property_infos.cadastre_number', 'land_property_infos.land_usage', 'land_property_infos.total_area')
                ->get();
        } else if ($filter == 'no-land-property') {
            $people = People::whereDoesntHave('landProperties')->get();
            $landProperties = DB::table('land_properties')
                ->join('people', 'land_properties.people_id', '=', 'people.id')
                ->where('land_properties.name', '=', null)
                ->get();
            $landPropertyInfos = [];
        } else if ($filter == 'no-land-property-info') {
            $people = People::whereHas('landProperties', function ($query) {
                $query->whereDoesntHave('landPropertyInfo');
            })->get();
            $landProperties = LandProperty::whereDoesntHave('landPropertyInfo')
                ->join('people', 'land_properties.people_id', '=', 'people.id')
                ->select('people.id as person_id', 'land_properties.id as land_property_id','people.type', 'people.title', 'land_properties.name', 'land_properties.cadastre_number')
                ->get();
            $landPropertyInfos = [];
        } else if ($filter == 'no-land-usage') {
            $people = People::join('land_properties', 'people.id', '=', 'land_properties.people_id')
                ->join('land_property_infos', 'land_properties.id', '=', 'land_property_infos.land_property_id')
                ->where('land_property_infos.land_usage', '=', 'Nav lietojuma')
                ->select('people.id', 'people.name', 'people.surname', 'people.type', 'people.title',)
                ->get();
            $landProperties = DB::table('land_properties')
                ->join('people', 'land_properties.people_id', '=', 'people.id')
                ->join('land_property_infos', 'land_properties.id', '=', 'land_property_infos.land_property_id')
                ->where('land_property_infos.land_usage', '=', 'Nav lietojuma')
                ->select('people.id as person_id', 'land_properties.id as land_property_id', 'land_properties.name', 'land_properties.cadastre_number')
                ->get();
            $landPropertyInfos = DB::table('land_property_infos')
                ->join('land_properties', 'land_property_infos.land_property_id', '=', 'land_properties.id')
                ->join('people', 'land_properties.people_id', '=', 'people.id')
                ->where('land_property_infos.land_usage', '=', 'Nav lietojuma')
                ->select('people.id as person_id', 'land_property_id as land_property_id', 'land_property_infos.cadastre_number', 'land_property_infos.land_usage', 'land_property_infos.total_area')
                ->get();
        }

        return view('overview', [
            'people' => $people,
            'landProperties' => $landProperties,
            'landPropertyInfos' => $landPropertyInfos,
        ]);
    }
}
