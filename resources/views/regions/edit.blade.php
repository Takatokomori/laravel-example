<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        @if ($errors->any())
    <div class="text-white">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
        <form method="POST" action="{{ route('regions.update', $region) }}">
            @csrf
            @method('PATCH')
            <input
                name="name"
                class="block w-full border-gray-300 focus:border-indigo-300 
                focus:ring focus:ring-indigo-200 focus:ring-opacity-50 
                rounded-md shadow-sm"
                value="{{ old('name', $region->name) }}"
            />
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <h1 class="text-green-300">Students</h1>
            @foreach($students as $student)
            <label class="text-white">
                <input type="checkbox" name="studentIds[]"
                    value="{{ $student->id }}" {{ in_array($student->id, $myStudentIds, false) ? 'checked' : '' }}>
                {{ $student->name }}
            </label>
            <label class="text-white">
                <input type="checkbox" name="isAdmin[{{ $student->id }}]"
                    value="1" {{ in_array($student->id, $myAdminStudentIds, false) ? 'checked' : '' }}>
                Is Admin
            </label>
            <label class="text-white">
                <input type="number" name="prices[{{ $student->id }}]"
                value="{{ old('prices.' . $student->id, isset($prices[$student->id]) ? $prices[$student->id] : '') }}"
                placeholder="Price">
            </label>
            @endforeach
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('regions.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>