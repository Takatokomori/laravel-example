<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h2>ブログ記事一覧</h2>
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
</div>