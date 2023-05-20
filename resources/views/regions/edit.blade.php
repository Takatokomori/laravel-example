<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
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
            <x-forms.input-many-to-many-checkbox
                :things="$students" :my-thing-ids="$myStudentIds" input-name='studentIds'/>

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('regions.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>