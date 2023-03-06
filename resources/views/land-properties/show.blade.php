@include('layouts.app')

<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
    <div class="md:flex ml-12">
        <div class="p-4">
            <div class="flex">
                <h3 class="text-xl font-medium text-gray-900">{{ $landProperty->name }}</h3>
                <a href="{{ route('land-property-info.create', ['people_id' => $people_id, 'land_property_id' => $land_property_id]) }}"
                   class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-1 px-2 rounded-md ml-4">
                    Pievienot jaunu zemes gabalu
                </a>
            </div>
                <p class="text-sm text-gray-600 mt-1 ml-4">Kadastra
                    numurs: {{ $landProperty->cadastre_number }}</p>
                <p class="text-sm text-gray-600 mt-1 ml-4">Status: {{ $landProperty->status }}</p>
                @if($totalArea == 0)
                    @else
                <p class="text-sm text-gray-600 mt-1 ml-4">Kopējā platība īpašumam: {{ number_format($totalArea, 2) }} ha</p>
                @endif

            <ul class="ml-4">
                <li class="py-2 flex items-center justify-between border-b border-gray-300">
                    <div>
                        @foreach($landPropertyInfos as $landPropertyInfo)
                            <div class="border border-gray-200 rounded-md mt-3 p-3">
                                <p class="text-sm text-gray-600">Kadastra
                                    numurs: {{ $landPropertyInfo->cadastre_number }}</p>
                                <p class="text-sm text-gray-600 mt-1">Zemes
                                    lietojums: {{ $landPropertyInfo->land_usage }}</p>
                                <p class="text-sm text-gray-600 mt-1">Platība: {{ $landPropertyInfo->total_area }}
                                    ha</p>
                                <p class="text-sm text-gray-600 mt-1">Uzmērīšanas
                                    datums: {{ $landPropertyInfo->survey_date }}</p>
                                <a href="{{ route('land-property-info.edit', ['people_id' => $people_id, 'land_property_id' => $landProperty->id, 'land_property_info_id' => $landPropertyInfo->id]) }}"
                                   class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-1 px-2 rounded-md mt-2 inline-block">
                                    Labot
                                </a>
                            </div>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
