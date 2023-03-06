@include('layouts.app')

<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
    <div class="flex justify-center mt-4">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Personas īpašumu saraksts</h2>
    </div>
    <div class="md:flex ml-16">
        <div class="p-4">
            @if($people->type == 'fiziska')
                <h3 class="text-xl font-medium text-gray-900">Personas informācija</h3>
                <p class="text-s text-gray-500 mb-1 ml-4">
                    {{ $people->name }} {{ $people->surname }}
                </p>
                <p class="text-s text-gray-500 mb-1 ml-4">
                    Personas kods: {{ $people->personal_code }}
                </p>
            @elseif($people->type == 'juridiska')
                <h3 class="text-xl font-medium text-gray-900">Kompānijas informācija</h3>
                <p class="text-s text-gray-500 mb-1 ml-4">
                    {{ $people->title }}
                </p>
                <p class="text-s text-gray-500 mb-1 ml-4">
                    Reģistrācijas numurs: {{ $people->personal_code }}
                </p>
            @endif
            <p class="text-s text-gray-500 mb-1 ml-4">
                Tips: {{ $people->type }}
            </p>
        </div>
    </div>
    <div class="md:flex ml-12">
        <div class="p-4">
            <div class="flex items-center">
                <h3 class="text-xl font-medium text-gray-900">Zemes īpašumi</h3>
                <a href="{{ route('land-properties.create', ['people_id' => $people->id]) }}"
                   class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-1 px-2 rounded-md ml-2">
                    Pievienot jaunu zemes īpašumu
                </a>
            </div>
            <ul class="ml-4">
                @foreach ($landProperties as $landProperty)
                    <li class="py-2 flex items-center justify-between border-b border-gray-300">
                        <div>
                            <div class="flex items-center">
                                <h3 class="text-lg font-medium text-gray-900">{{ $landProperty->name }}</h3>
                                <a href="{{ route('land-properties.show', ['people_id' => $people->id, 'land_property_id' => $landProperty->id]) }}"
                                   class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-1 px-2 rounded-md ml-4">
                                    Skatīt
                                </a>
                                <a href="{{ route('land-properties.edit', ['people_id' => $people->id, 'land_property_id' => $landProperty->id]) }}"
                                   class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-1 px-2 rounded-md ml-4">
                                    Labot
                                </a>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Kadastra
                                numurs: {{ $landProperty->cadastre_number }}</p>
                            <p class="text-sm text-gray-600 mt-1">Status: {{ $landProperty->status }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>


