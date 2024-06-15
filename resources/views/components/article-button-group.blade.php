<div class="flex flex-row mt-2 items-center">
    @can('update', $article)
    <div class="mr-1">
        <a href="{{ route('articles.edit', ['article' => $article->id]) }}"
           class="bg-green-500 p-1 rounded text-white">
           글 수정
        </a>
    </div>
    @endcan

    @can('delete', $article)
    <div>
        <form action="{{ route('articles.destroy', ['article' => $article->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 h-[20] rounded text-white">글 삭제</button>
        </form>
    </div>
    @endcan
</div>
