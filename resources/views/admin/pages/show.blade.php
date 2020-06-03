@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>TITLE: {{$page->title}}</h1>
                <h3>CATEGORY: {{$page->category->name}}</h3>
                <p>SUMMARY: {{$page->summary}}</p>
                <p>BODY: {{$page->body}}</p>

                <div>
                    <span>TAGS: </span>
                    @foreach ($page->tags as $tag)
                    <span>{{$tag->name}}</span>
                    @endforeach
                </div>

                <br>

                <h3>PHOTOS</h3>
                @foreach ($page->photos as $photo)
                <img src="{{asset('storage/' . $photo->path)}}" alt="">
                @endforeach
            </div>
        </div>
    </div>
@endsection
