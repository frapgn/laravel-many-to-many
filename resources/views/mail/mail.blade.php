<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
    <h1>TITLE: {{$page->title}}</h1>
    <h3>CATEGORY: {{$page->category->name}}</h3>
    <p>SUMMARY: {{$page->summary}}</p>
    <p>BODY: {{$page->body}}</p>

    <div>
        <span>TAGS: </span>
        @foreach ($page->tags as $tag)
        <span>{{$tag->name}} </span>
        @endforeach
    </div>

    <br>

    <h3>PHOTOS</h3>
    @foreach ($page->photos as $photo)
    <img src="{{asset('storage/' . $photo->path)}}" alt="">
    @endforeach
</body>
</html>
