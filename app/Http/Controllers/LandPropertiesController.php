<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLandPropertyRequest;
use App\Models\LandProperty;
use App\Models\LandPropertyInfo;
use App\Models\People;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\Request;

class LandPropertiesController
{
    public function show(int $people_id, int $land_property_id): View
    {
        $landProperty = LandProperty::findOrFail($land_property_id);

        $landPropertyInfos = LandPropertyInfo::where('land_property_id', $land_property_id)->get();

        $totalArea = 0;
        foreach ($landPropertyInfos as $landPropertyInfo) {
            $totalArea += $landPropertyInfo->total_area;
        }

        return view('land-properties.show', [
            'landProperty' => $landProperty,
            'people_id' => $people_id,
            'land_property_id' => $land_property_id,
            'landPropertyInfos' => $landPropertyInfos,
            'totalArea' => $totalArea,
        ]);
    }

    public function create(int $people_id): View
    {
        People::findOrFail($people_id);

        return view('land-properties.create', ['people_id' => $people_id]);
    }

    public function store(CreateLandPropertyRequest $request, int $people_id): RedirectResponse
    {
        $name = $request->get('name');
        $cadastreNumber = $request->get('cadastre_number');
        $status = $request->get('status');

        $landProperty = (new LandProperty())->create([
            'people_id' => $people_id,
            'name' => $name,
            'cadastre_number' => $cadastreNumber,
            'status' => $status,
        ]);

        $landProperty->save();

        return redirect()->route('people.show', $people_id)->with('success', 'Zemes īpašums pievienots.');
    }

    public function edit(int $people_id, int $land_property_id): View
    {
        $landProperty = LandProperty::findOrFail($land_property_id);

        return view('land-properties.edit', [
            'landProperty' => $landProperty,
            'people_id' => $people_id,
            'land_property_id' => $land_property_id,
        ]);
    }

    public function update(Request $request, int $people_id, int $land_property_id): RedirectResponse
    {
        $landProperty = LandProperty::findOrFail($land_property_id);

        $request->validate([
            'name' => [
                'required',
                'string',
            ],
            'cadastre_number' => [
                'required',
                Rule::unique('land_properties')->where(function ($query) use ($people_id, $land_property_id) {
                    return $query->where('people_id', $people_id)
                        ->where('id', '<>', $land_property_id);
                }),
                'size:11',
                'regex:/^[0-9]{11}$/',
            ],
            'status' => [
                'required',
                'in:Ir pirkšanas līgums,Apmaksāts,Reģistrēts zemes grāmatā,Pārdots',
            ],
        ]);

        $name = $request->get('name');
        $cadastre_number = $request->get('cadastre_number');
        $status = $request->get('status');

        $landProperty->update([
            'name' => $name,
            'cadastre_number' => $cadastre_number,
            'status' => $status,
        ]);

        return redirect()->route('people.show', $people_id)->with('success', 'Zemes īpašums atjaunots.');
    }
}
