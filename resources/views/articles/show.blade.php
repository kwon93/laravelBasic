<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('글 조회') }}
        </h2>
    </x-slot>
<div class="container p-5 mx-auto">
  <h2 class="text-2xl">글을 자세하게 확인해봅시다.</h2>
    <div>
      <a href="{{ route('home')}}">home</a>
    </div>
    <div class="border border-2 rounded mt-10 p-5">
        {{ $article->body}}
        <x-article-button-group :article=$article />
    </div>
    <!-- comment area -->
    <div class="mt-5">
        <form action="{{ route('comments.store') }}" method="POST" class="flex">
          @csrf
          <input type="hidden" name="article_id" value="{{ $article->id }}">
          <x-text-input name="body" class="mr-3" />
          @error('body')
          <x-input-error :messages=$messages />
          @enderror
          <x-primary-button> 댓글 쓰기 </x-primary-button>
        </form>
    </div>
    <!-- comment area end-->
</div>
</x-app-layout>