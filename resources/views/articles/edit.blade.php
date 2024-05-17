<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LarabelBasic</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="container p-5">
    <div>
      <a href="{{ route('home')}}">home</a>
    </div>
    <h2 class="text-2xl">
      글을 수정해봅시다.
    </h2>
  <form action="{{ route('articles.update', ['article' => $article->id ]) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')
    <input type="text" name="body" class="block w-full mt-5 rounded" value="{{ old('body') ?? $article->body }}">
    @error('body')
      <p class="text-xs text-red-700 mt-3">{{ $message }}</p>
    @enderror
    <button class="button py-1 px-3 bg-black text-white rounded text-xs mt-2 bg-green-500">수정하기</button>
  </form>
</div>
</body>
</html>