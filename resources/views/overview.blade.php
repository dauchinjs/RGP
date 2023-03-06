@include('layouts.app')

<div class="flex flex-col items-center justify-center h-full">
    <div class="max-w-6xl w-full bg-white shadow-lg rounded-lg p-6">
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-900">
                Kopsavilkums
            </h3>
        </div>

        <form method="GET" action="/overview">
            <div class="flex flex-row items-center justify-between mb-4">
                <div>
                    <button type="submit" name="filter" value="all"
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:bg-gray-200">
                        Viss
                    </button>
                    <button type="submit" name="filter" value="no-land-property"
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:bg-gray-200">
                        Bez zemes īpašuma
                    </button>
                    <button type="submit" name="filter" value="no-land-property-info"
                            class="ml-2 px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:bg-gray-200">
                        Īpašums bez zemes gabala
                    </button>
                    <button type="submit" name="filter" value="no-land-usage"
                            class="ml-2 px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:bg-gray-200">
                        Nav zemes lietojuma
                    </button>
                </div>
            </div>
        </form>

        <table class="w-full text-left table-collapse">
            <thead>
            <tr>
                <th class="text-s font-semibold text-gray-100 p-4 bg-indigo-500">Zemes īpašnieks</th>
                <th class="text-s font-semibold text-gray-100 p-4 bg-indigo-500">Īpašums</th>
                <th class="text-s font-semibold text-gray-100 p-4 bg-indigo-500">Zemesgabals</th>
                <th class="text-s font-semibold text-gray-100 p-4 bg-indigo-500">Zemes lietojums</th>
                <th class="text-s font-semibold text-gray-100 p-4 bg-indigo-500">Platība</th>
            </tr>
            </thead>
            <tbody>
            @foreach($people as $person)
                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-indigo-100 dark:hover:bg-gray-600">
                    @if($person->type == 'fiziska')
                        <td class="p-3 border-t border-gray-200 font-medium text-gray-700">
                            {{ $person->name }} {{ $person->surname }}
                        </td>
                    @elseif($person->type == 'juridiska')
                        <td class="p-3 border-t border-gray-200 font-medium text-gray-700">
                            {{ $person->title }}
                        </td>
                    @endif
                    <td class="p-3 border-t border-gray-200 font-medium text-gray-700">
                        @foreach($landProperties as $landProperty)
                            @if($landProperty->person_id == $person->id)
                                {{ $landProperty->name }} <br>
                            @endif
                        @endforeach
                    </td>
                    <td class="p-3 border-t border-gray-200 font-medium text-gray-700">
                        @foreach($landPropertyInfos as $landPropertyInfo)
                            @foreach($landProperties as $landProperty)
                                @if($landProperty->person_id == $person->id)
                                    @if($landPropertyInfo->land_property_id == $landProperty->land_property_id)
                                        {{ $landPropertyInfo->cadastre_number }} <br>
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td class="p-3 border-t border-gray-200 font-medium text-gray-700">
                        @foreach($landPropertyInfos as $landPropertyInfo)
                            @foreach($landProperties as $landProperty)
                                @if($landProperty->person_id == $person->id)
                                    @if($landPropertyInfo->land_property_id == $landProperty->land_property_id)
                                        {{ $landPropertyInfo->land_usage }} <br>
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td class="p-3 border-t border-gray-200 font-medium text-gray-700">
                        @foreach($landPropertyInfos as $landPropertyInfo)
                            @foreach($landProperties as $landProperty)
                                @if($landProperty->person_id == $person->id)
                                    @if($landPropertyInfo->land_property_id == $landProperty->land_property_id)
                                        {{ $landPropertyInfo->total_area }} ha <br>
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
