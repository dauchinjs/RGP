<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLandPropertyInfoRequest;
use App\Models\LandProperty;
use App\Models\LandPropertyInfo;
use App\Models\People;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LandPropertyInfoController
{
    public function create(int $people_id, int $land_property_id): View
    {
        People::findOrFail($people_id);
        LandProperty::findOrFail($land_property_id);

        return view('land-property-info.create', ['people_id' => $people_id, 'land_property_id' => $land_property_id]);
    }

    public function store(CreateLandPropertyInfoRequest $request, int $people_id, int $land_property_id): RedirectResponse
    {
        $cadastreNumber = $request->get('cadastre_number');
        $landUsage = $request->get('land_usage');
        $totalArea = $request->get('total_area');
        $surveyDate = $request->get('survey_date');

        $landPropertyInfo = (new LandPropertyInfo())->create([
            'land_property_id' => $land_property_id,
            'cadastre_number' => $cadastreNumber,
            'land_usage' => $landUsage,
            'total_area' => $totalArea,
            'survey_date' => $surveyDate,
        ]);

        $landPropertyInfo->save();

        return redirect()->route('people.show', $people_id)->with('success', 'Zemes gabals pievienots.');
    }

    public function edit(int $people_id, int $land_property_id, int $land_property_info_id): View
    {
        $landPropertyInfo = LandPropertyInfo::findOrFail($land_property_info_id);

        return view('land-property-info.edit', [
            'landPropertyInfo' => $landPropertyInfo,
            'people_id' => $people_id,
            'land_property_id' => $land_property_id,
            'land_property_info_id' => $land_property_info_id,
        ]);
    }

    public function update(Request $request, int $people_id, int $land_property_id, int $land_property_info_id): RedirectResponse
    {
        $landPropertyInfo = LandPropertyInfo::findOrFail($land_property_info_id);

        $request->validate([
            'cadastre_number' => [
                'required',
                Rule::unique('land_properties')->where(function ($query) use ($people_id, $land_property_id) {
                    return $query->where('people_id', $people_id)
                        ->where('id', '<>', $land_property_id);
                }),
                'size:11',
                'regex:/^[0-9]{11}$/',
            ],
            'land_usage' => [
                'required',
                'string',
            ],
            'total_area' => [
                'required',
                'numeric',
            ],
            'survey_date' => [
                'required',
                'date',
            ],
        ]);

        $cadastre_number = $request->get('cadastre_number');
        $land_usage = $request->get('land_usage');
        $total_area = $request->get('total_area');
        $survey_date = $request->get('survey_date');

        $landPropertyInfo->update([
            'cadastre_number' => $cadastre_number,
            'land_usage' => $land_usage,
            'total_area' => $total_area,
            'survey_date' => $survey_date,
        ]);

        return redirect()->route('land-properties.show', [$people_id, $land_property_id])->with('success', 'Zemes gabals atjaunots.');
    }
}
