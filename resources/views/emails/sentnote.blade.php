<!DOCTYPE html>
<html>
<head>
    <title>{{$note->title}}</title>
</head>
<body>
    <h1>Hi {{$note->recipient}},</h1>
    <h2>Kamu mendapatkan note dari {{$note->user->name}}</h2>
    <p>Klik <a href={{ $noteUrl = config('app.url') . '/notes/' . $note->id; }}>di sini</a> untuk membuka note yang dikirimkan</p>
</body>
</html>