<x-app-layout>
<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 border-gray-300">
            <h1>Student Name</h1>
            <small class="text-sm text-blue-600">{{$student->name}}</small>
            <h1>Course Name</h1>
            @foreach ($student->courses as $course)
             <p class="text-sm text-blue-500">{{ $course->name }}</p>
            @endforeach
            @foreach ($student->regions as $region)
            <h2>Name</h2>
             <p class="text-sm text-blue-500">{{ $region->name }}</p>
            <h2>is_admin</h2>
            <p class="text-sm text-blue-500">{{ $region->pivot->is_admin }}</p>
            <h2>Price</h2>
            <p class="text-sm text-blue-500">{{ $region->pivot->price }}</p>
            @endforeach
        </div>
    </div>
</div>
</x-app-layout>