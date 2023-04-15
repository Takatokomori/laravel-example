<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('blogs.update', $blog) }}">
            @csrf
            @method('patch')
            <input
                name="title"
                class="block w-full border-gray-300 focus:border-indigo-300 
                focus:ring focus:ring-indigo-200 focus:ring-opacity-50 
                rounded-md shadow-sm"
            >{{ old('title', $blog->title) }}</input>
            <textarea
                name="content"
                class="block w-full border-gray-300 focus:border-indigo-300 
                focus:ring focus:ring-indigo-200 focus:ring-opacity-50 
                rounded-md shadow-sm"
            >{{ old('content', $blog->content) }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('blogs.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>