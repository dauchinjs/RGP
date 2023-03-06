@include('layouts.app')

<div class="mx-auto max-w-sm">

    <button onclick="window.history.back()"
            class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-md">
        Atpakaļ
    </button>

    <div class="flex justify-center mt-4">

        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Pievienot jaunu zemes gabalu</h2>
    </div>
    <form method="POST"
          action="{{ route('land-property-info.store', ['people_id' => $people_id, 'land_property_id' => $land_property_id]) }}"
          class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <div class="mb-4">
            <label for="cadastre_number" class="block text-gray-700 font-bold mb-2">Kadastra numurs:</label>
            <input type="text" id="cadastre_number" name="cadastre_number" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        @error('cadastre_number')
        <p class="text-red-500 text-s italic mt-4 mb-4">
            Nederīgs kadastra numurs (jāsastāv no 11 cipariem)
        </p>
        @enderror

        <div class="mb-4">
            <label for="land_usage" class="block text-gray-700 font-bold mb-2">Zemes lietojums:</label>
            <select id="land_usage" name="land_usage" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">-- Izvēlies zemes lietojumu --</option>
                <option value="Lauksaimniecības zeme">Lauksaimniecības zeme</option>
                <option value="Meža zeme">Meža zeme</option>
                <option value="Zeme zem ūdeņiem">Zeme zem ūdeņiem</option>
                <option value="Apbūves platība">Apbūves platība</option>
                <option value="Cits">Cits</option>
                <option value="Nav lietojuma">Nav lietojuma</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="total_area" class="block text-gray-700 font-bold mb-2">Platība:</label>
            <input type="text" id="total_area" name="total_area" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        @error('total_area')
        <p class="text-red-500 text-s italic mt-4 mb-4">
            Platībai jāsastāv no cipariem
        </p>
        @enderror

        <div class="mb-4">
            <label for="survey_date" class="block text-gray-700 font-bold mb-2">Uzmērīšanas datums:</label>
            <input type="date" id="survey_date" name="survey_date" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex items-center justify-center">
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-md">
                Pievienot
            </button>
        </div>
    </form>
</div>
