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
        <form method="POST" action="{{ route('students.update', $student) }}">
            @csrf
            @method('PATCH')
            <input
                name="name"
                class="block w-full border-gray-300 focus:border-indigo-300 
                focus:ring focus:ring-indigo-200 focus:ring-opacity-50 
                rounded-md shadow-sm"
                value="{{ old('name', $student->name) }}"
            />
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-forms.input-many-to-many-checkbox
                :things="$courses" :my-thing-ids="$myCourseIds" input-name='courseIds'/>
            @foreach($regions as $region)
            <label class="text-white">
                <input type="checkbox" name="regionIds[]"
                    value="{{ $region->id }}"
                    {{ in_array($region->id, $myCourseIds, false) ? 'checked' : '' }}>
                {{ $student->name }}
            </label>
            <label class="text-white">
                <input type="checkbox" name="isAdmin[{{ $region->id }}]"
                    value="1" {{ in_array($region->id, $myAdminStudentIds, false) ? 'checked' : '' }}>
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
                <a href="{{ route('students.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>