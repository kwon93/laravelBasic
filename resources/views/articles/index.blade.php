<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('글 목록') }}
        </h2>
    </x-slot>
<div class="container p-5">
    <div>
      <a href="{{ route('home')}}">home</a>
    </div>
    <h2 class="text-2xl">
      글 목록을 확인해봅시다.
    </h2>
      @foreach($articles as $article)
      <div class="background-white border rounded mt-3 p-3">
          <p class="text-xl"><a href="{{ route('articles.show', ['article' => $article->id]) }}">{{ $article->body }}</a></p>
          <p>{{ $article->user->name }}</p>
          <p class="">{{ $article->created_at->diffForHumans() }}</p>
          <div class="flex flex-row mt-2">
            @can('update', $article)
          <p class="mt-3 text-green-800 mr-1">
            <a href="{{ route('articles.edit', ['article' => $article->id]) }}"
              class="bg-green-500 p-1 rounded text-white">
              글 수정
          </a>
          </p>
            @endcan

            @can('delete', $article)
          <form action="{{ route('articles.destroy', ['article' => $article->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 p-1 rounded text-white">글 삭제</button>
          </form>
            @endcan
            
          </div>
      </div>
      @endforeach

    <div class="container p-5">
      {{$articles->links()}}
    </div>

</div>
</x-app-layout>