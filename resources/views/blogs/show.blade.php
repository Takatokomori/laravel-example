<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 border-gray-300">
        <h1 class="block w-full bg-white border-gray-300
                rounded-md shadow-sm">{{$blog->title}}</h1>
        <h1 class="bg-white border-gray-300
        rounded-md shadow-sm">{{$blog->content}}</h1>
    </div>
</x-app-layout>