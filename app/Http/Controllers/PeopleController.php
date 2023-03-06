<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonRequest;
use App\Models\LandProperty;
use App\Models\LandPropertyInfo;
use App\Models\People;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PeopleController
{
    public function index(): View
    {
        $people = People::orderBy('id', 'desc')->get();
        $landProperties = DB::table('land_property_infos')
            ->join('land_properties', 'land_property_infos.land_property_id', '=', 'land_properties.id')
            ->join('people', 'land_properties.people_id', '=', 'people.id')
            ->select('people.id as person_id', 'land_property_infos.total_area')
            ->get();

        return view('home', [
            'people' => $people,
            'landProperties' => $landProperties,
        ]);
    }

    public function show(int $id): View
    {
        $people = People::where('id', $id)->first();
        $landProperties = LandProperty::where('people_id', $id)->get();

        if (!$people) {
            abort(404, 'Person not found');
        }

        $landPropertyInfo = [];

        foreach ($landProperties as $landProperty) {
            $landPropertyInfo[$landProperty->id] = LandPropertyInfo::where('land_property_id', $landProperty->id)->get();
        }

        return view('people.show', [
            'people' => $people,
            'landProperties' => $landProperties,
            'landPropertyInfo' => $landPropertyInfo,
        ]);
    }

    public function create(): View
    {
        return view('people.create');
    }

    public function store(CreatePersonRequest $request): RedirectResponse
    {
        $name = $request->get('name');
        $surname = $request->get('surname');
        $personalCode = $request->get('personal_code');
        $type = $request->get('type');
        $title = $request->get('title');


        $people = (new People())->create([
            'name' => $name,
            'surname' => $surname,
            'title' => $title,
            'personal_code' => $personalCode,
            'type' => $type
        ]);


        $people->save();

        return redirect()->route('home')->with('success', 'Persona pievienota.');
    }
}
