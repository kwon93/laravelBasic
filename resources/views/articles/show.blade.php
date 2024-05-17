<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LarabelBasic</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="container p-5">
  <h2 class="text-2xl">글을 자세하게 확인해봅시다.</h2>
    <div>
      <a href="{{ route('home')}}">home</a>
    </div>
  {{ $article->body}}
</div>
</body>
</html>