<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h2>{{ $blog->title }}</h2>
        @if (session('err_msg'))
            <p class="text-danger">
                {{ session('err_msg') }}
            </p>
        @endif

    </div>
</div>