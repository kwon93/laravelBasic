<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('글 쓰기') }}
        </h2>
    </x-slot>
<div class="container p-5">
    <div>
      <a href="{{ route('home')}}">home</a>
    </div>
  <form action="{{ route('articles.store')}}" method="POST">
    <h2 class="text-2xl">
      글을 써봅시다.
    </h2>
    @csrf
    <input type="text" name="body" class="block w-full mt-5 rounded" value="{{ old('body')}}">
    @error('body')
      <p class="text-xs text-red-700 mt-3">{{ $message }}</p>
    @enderror
    <button class="py-1 px-3 bg-black text-white rounded text-xs mt-2">글쓰기</button>
  </form>
</div>
</x-app-layout>