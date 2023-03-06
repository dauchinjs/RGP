@include('layouts.app')

<div class="flex flex-col items-center justify-center h-full">
    <div class="max-w-4xl w-full bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">
                Reģistrētās personas
            </h3>
            <a href="{{ route('people.create') }}"
               class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-md">
                Pievienot jaunu personu
            </a>
        </div>

        <div class="grid grid-cols-3 gap-4">
            @foreach($people as $person)
                <div class="bg-gray-100 p-4 rounded-lg relative" style="height: 9rem">
                    @if($person->type == 'fiziska')
                        <h4 class="text-sm font-medium text-gray-900 mb-1">
                            {{ $person->name }} {{ $person->surname }}
                        </h4>
                    @elseif($person->type == 'juridiska')
                        <h4 class="text-sm font-medium text-gray-900 mb-1">
                            {{ $person->title }}
                        </h4>
                    @endif
                    @if($person->type == 'fiziska')
                        <p class="text-sm text-gray-500 mb-1">
                            Personas kods: {{ $person->personal_code }}
                        </p>
                    @elseif($person->type == 'juridiska')
                        <p class="text-sm text-gray-500 mb-1">
                            Reģistrācijas numurs: {{ $person->personal_code }}
                        </p>
                    @endif
                    <p class="text-sm text-gray-500 mb-1">
                        Tips: {{ $person->type }}
                    </p>
                    @if($landProperties->where('person_id', $person->id)->sum('total_area') > 0)
                        <p class="text-sm text-gray-500 mb-1">
                            Kopplatība: {{ $landProperties->where('person_id', $person->id)->sum('total_area') }}
                            hektāri
                        </p>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 flex justify-between items-center py-2 px-4">
                        <a href="{{ route('people.show', $person->id) }}"
                           class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            Skatīt
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
