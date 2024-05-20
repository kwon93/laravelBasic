<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('글 조회') }}
        </h2>
    </x-slot>
<div class="container p-5">
  <h2 class="text-2xl">글을 자세하게 확인해봅시다.</h2>
    <div>
      <a href="{{ route('home')}}">home</a>
    </div>
  {{ $article->body}}
</div>
</x-app-layout>