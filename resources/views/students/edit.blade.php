<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
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
            @foreach($courses as $course)
                <label class="text-white">
                    <input type="checkbox" name="courseIds[]"
                    value="{{ $course->id }}" {{ in_array($course->id,
                        $myCourseIds, false) ? 'checked' : '' }}>
                    {{ $course->name }}
                </label>
            @endforeach
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('students.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>