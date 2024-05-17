<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LarabelBasic</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="container p-5">
    <h2 class="text-2xl">
      글 목록을 확인해봅시다.
    </h2>
      @foreach($articles as $article)
      <div class="background-white border rounded mt-3 p-3">
          <p>{{ $article->body }}</p>
          <p>{{ $article->user->name }}</p>
          <p>{{ $article->created_at->diffForHumans() }}</p>
      </div>
    @endforeach

    <div class="container p-5">
      {{$articles->links()}}
    </div>

</div>
</body>
</html>