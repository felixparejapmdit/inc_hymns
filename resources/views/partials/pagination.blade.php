<div class="container text-center">
    {{ $musics->appends(['query' => request()->query('query')])->links('pagination::bootstrap-4') }}
</div>
