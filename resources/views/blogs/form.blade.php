<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <form method="POST" action="{{ route('blogs.store') }}">
        @csrf
        <input
            name="title"
            placeholder="{{ __('title') }}"
            class="block w-full border-gray-300 
            focus:border-indigo-300 
            focus:ring focus:ring-indigo-200 
            focus:ring-opacity-50 rounded-md shadow-sm"
        >{{ old('message') }}</input>
        @if ($errors->has('title'))
            <div class="text-danger bg-white">
                {{ $errors->first('title') }}
            </div>
        @endif
        <textarea
            name="content"
            placeholder="{{ __('What\'s on your mind?') }}"
            class="block w-full border-gray-300 
            focus:border-indigo-300 
            focus:ring focus:ring-indigo-200 
            focus:ring-opacity-50 rounded-md shadow-sm"
        >{{ old('message') }}</textarea>
        <x-input-error :messages="$errors->get('message')" class="mt-2" />
        @if ($errors->has('content'))
            <div class="text-danger bg-neutral-50">
                {{ $errors->first('content') }}
            </div>
        @endif
        <x-primary-button class="mt-4">{{ __('Blogs') }}</x-primary-button>
    </form>
</div>