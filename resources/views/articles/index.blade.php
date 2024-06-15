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
          
          <x-article-button-group :article=$article />
      </div>
      @endforeach
    <div class="container p-5">
      {{$articles->links()}}
    </div>
</div>
</x-app-layout>