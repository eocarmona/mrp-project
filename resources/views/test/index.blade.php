<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>{{$prueba->title}}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/general.css')}}">
    </head>
    <body>
        <br><br>
        <h1>{{$prueba->title}}</h1>
        <hr>
        {{$prueba->content}}
        <hr>
        {{$prueba->user->name }} | {{$prueba->category->name}} | 
        @foreach($prueba->tags as $tag)
            {{ $tag->name}}
        @endforeach
    </body>    
</html>