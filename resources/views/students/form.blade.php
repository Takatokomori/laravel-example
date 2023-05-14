<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <input
            name="name"
            placeholder="{{ __('name') }}"
            class="block w-full border-gray-300 
            focus:border-indigo-300 
            focus:ring focus:ring-indigo-200 
            focus:ring-opacity-50 rounded-md shadow-sm"
        >{{ old('name') }}
        @if ($errors->has('name'))
            <div class="text-danger bg-white">
                {{ $errors->first('name') }}
            </div>
        @endif
        <x-primary-button class="mt-4">{{ __('Students') }}</x-primary-button>
    </form>
</div>