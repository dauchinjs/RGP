@include('layouts.app')

<div class="mx-auto max-w-sm">

    <button onclick="window.history.back()"
            class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-md">
        Atpakaļ
    </button>

    <div class="flex justify-center mt-4">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Labot zemes īpašumu</h2>
    </div>
    <form method="POST"
          action="{{ route('land-properties.update', ['people_id' => $people_id, 'land_property_id' => $land_property_id]) }}"
          class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Nosaukums:</label>
            <input type="text" id="name" name="name" value="{{ $landProperty->name }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="cadastre_number" class="block text-gray-700 font-bold mb-2">Kadastra numurs:</label>
            <input type="text" id="cadastre_number" name="cadastre_number" value="{{ $landProperty->cadastre_number }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        @error('cadastre_number')
        <p class="text-red-500 text-s italic mt-4 mb-4">
            Nederīgs kadastra numurs (jāsastāv no 11 cipariem)
        </p>
        @enderror

        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-bold mb-2">Status:</label>
            <select id="status" name="status"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="{{ $landProperty->status }}">-- Izvēlies statusu --</option>
                <option value="Ir pirkšanas līgums">Ir pirkšanas līgums</option>
                <option value="Apmaksāts">Apmaksāts</option>
                <option value="Reģistrēts zemes grāmatā">Reģistrēts zemes grāmatā</option>
                <option value="Pārdots">Pārdots</option>
            </select>
        </div>
        @error('status')
        <p class="text-red-500 text-s italic mt-4 mb-4">
            Izvēlies statusu
        </p>
        @enderror

        <div class="flex items-center justify-center">
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-md">
                Saglabāt
            </button>
        </div>
    </form>
</div>
