<div class="container text-center pagination-centered">
    {{ $musics->appends(['query' => request()->query('query')])->links() }}
</div>
