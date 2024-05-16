<?php

use App\Http\Controllers\ProfileController;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 글쓰기 화면
Route::get('/articles/create', function () {
    return view('/articles/create');
});

//글 쓰기 
Route::post('/articles', function (Request $request) {
    $input = $request->validate([
        'body' => [
            'required',
            'string',
            'max:255'
        ],
    ]);
    //PDT 이용방법.
    // $host = config('database.connections.mysql.host');
    // $dbname= config('database.connections.mysql.database');
    // $username = config('database.connections.mysql.username');
    // $password = config('database.connections.mysql.password');

    // $conn = new PDO("mysql:host=$host;dbname=$dbname",$username, $password);

    // $stmt = $conn->prepare(
    //     "INSERT INTO articles (body, users_id)
    //     VALUES (:body, :userId)
    //     "
    // );

    // $body = $request->input('body');

    // $stmt->bindValue(':body' ,$input['body']);
    // $stmt->bindValue(':userId' , $request->user()->id);

    // $stmt->execute();

    // Laravel DB Facade 사용 
    // DB::statement("
    //     INSERT INTO articles (body, users_id)
    //     VALUES (:body, :userId)",
    //     ['body' => $input['body'], 'userId' => $request->user()->id]
    // );

    //queryBuilder 사용
    // DB::table('articles')->insert(
    //     [
    //         'body' => $input['body'],
    //         'users_id' => $request->user()->id
    //     ]
    // );

    //Eloquant ORM 사용
    // $article = new Article;
    // $article->body = $input['body'];
    // $article->users_id = $request->user()->id;
    // $article->save();

    Article::created(
        [
            'body' => $input['body'],
            'users_id' => $request->user()->id
        ]
    );

    return 'hello';
});

require __DIR__.'/auth.php';
