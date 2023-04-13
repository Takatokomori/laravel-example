<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 bg-white dark:bg-gray-800">
    <h2>ブログ記事一覧</h2>
    <h3>
        <x-nav-link :href="route('blog.create')" :active="request()->routeIs('blog/create')">
           {{ __('Blogs') }}
        </x-nav-link>
    </h3>
        @if (session('err_msg'))
            <p class="text-danger">
                {{ session('err_msg') }}
            </p>
        @endif
        <table class="table table-striped">
            <tr>
                <th>記事番号</th>
                <th>タイトル</th>
                <th>日付</th>
                <th>作成日</th>
            </tr>
            @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->id }}</td>
                <td><a href="/blog/{{ $blog->id }}">{{ $blog->title }}</a></td>
                <td>{{ $blog->created }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>