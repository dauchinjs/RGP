@include('layouts.app')

<div class="mx-auto max-w-sm">
    <button onclick="window.history.back()"
            class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-md">
        Atpakaļ
    </button>
    <div class="flex justify-center mt-4">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Pievienot jaunu personu</h2>
    </div>
    <form method="POST" action="{{ route('people.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <div class="mb-4">
            <label for="type" class="block text-gray-700 font-bold mb-2">Typs:</label>
            <select id="type" name="type" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">-- Izvēlies tipu --</option>
                <option value="fiziska">Fiziska</option>
                <option value="juridiska">Juridiska</option>
            </select>
        </div>

        <div id="fiziska-fields">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Vārds:</label>
                <input type="text" id="name" name="name" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="surname" class="block text-gray-700 font-bold mb-2">Uzvārds:</label>
                <input type="text" id="surname" name="surname" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        </div>

        <div id="juridiska-fields" style="display:none">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Uzņēmuma nosaukums:</label>
                <input type="text" id="title" name="title"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        </div>

        <div class="mb-4">
            <label for="personal_code" class="block text-gray-700 font-bold mb-2">Personālais kods:</label>
            <input type="text" id="personal_code" name="personal_code" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        @error('personal_code')
        <div class="text-red-500 text-s mb-4">
            Nederīgs kods
        </div>
        @enderror

        <div class="flex items-center justify-center">
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-md">
                Pievienot
            </button>
        </div>
    </form>
</div>
<script>
    const typeSelect = document.querySelector('#type');
    const fiziskaFields = document.querySelector('#fiziska-fields');
    const juridiskaFields = document.querySelector('#juridiska-fields');

    function visibleFields() {
        if (typeSelect.value === 'fiziska') {
            fiziskaFields.style.display = 'block';
            juridiskaFields.style.display = 'none';
            document.querySelectorAll('input[name]').forEach(input => {
                input.removeAttribute('required');
            });
            document.querySelectorAll('#fiziska-fields input[name]').forEach(input => {
                input.setAttribute('required', 'required');
            });
        } else if (typeSelect.value === 'juridiska') {
            fiziskaFields.style.display = 'none';
            juridiskaFields.style.display = 'block';
            document.querySelectorAll('input[name]').forEach(input => {
                input.removeAttribute('required');
            });
            document.querySelectorAll('#juridiska-fields input[name]').forEach(input => {
                input.setAttribute('required', 'required');
            });
        }
    }

    typeSelect.addEventListener('change', visibleFields);
    visibleFields();
</script>
