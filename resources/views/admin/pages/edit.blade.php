@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <form action="{{route('admin.pages.update', $page->id)}}" method="post" enctype="multipart/form-data" class="clearfix">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                      <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{old('title') ?? $page->title}}">
                    </div>

                    <div class="form-group">
                      <label for="title">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{old('slug') ?? $page->slug}}">
                    </div>

                    <div class="form-group">
                      <label for="summary">Summary</label>
                    <input type="text" name="summary" id="summary" class="form-control" value="{{old('summary') ?? $page->summary}}">
                    </div>

                    <div class="form-group">
                      <label for="body">Body</label>
                    <textarea name="body" id="body" class="form-control" value="" rows="8" cols="80">{{old('body') ?? $page->body}}</textarea>
                    </div>

                    {{-- CATEGORIES --}}
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" name="category_id" id="category">
                            @foreach ($categories as $category)
                                @if (!empty(old('category_id')))
                                    @if (old('category_id') == $category->id)
                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @else
                                    @if ($page->category->id == $category->id)
                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{-- TAGS --}}
                    <div class="form-group">
                        @foreach ($tags as $tag)
                            @if (!empty(old('tags'))) {{-- se l'array old('tags') è pieno, cioè l'utente ha modificato qualcosa ma l'edit non è andato a buon fine) --}}
                                {{-- stampa i dati salvati durante la sessione --}}
                                @if (is_array(old('tags')) &&  in_array($tag->id, old('tags')))
                                    <input type="checkbox" id="tag-{{$tag->id}}"name="tags[]" value="{{$tag->id}}" checked>
                                    <label for="tag-{{$tag->id}}">{{$tag->name}}</label>
                                @else
                                    <input type="checkbox" id="tag-{{$tag->id}}"name="tags[]" value="{{$tag->id}}">
                                    <label for="tag-{{$tag->id}}">{{$tag->name}}</label>
                                @endif
                            @else {{-- altrimenti stampa a partire dai dati salvati nel database --}}
                                @if ($page->tags->contains($tag)) {{-- se la collection $page->tags contiene l'istanza $tag (accetta anche l'id) --}}
                                    <input type="checkbox" id="tag-{{$tag->id}}"name="tags[]" value="{{$tag->id}}" checked>
                                    <label for="tag-{{$tag->id}}">{{$tag->name}}</label>
                                @else
                                    <input type="checkbox" id="tag-{{$tag->id}}"name="tags[]" value="{{$tag->id}}">
                                    <label for="tag-{{$tag->id}}">{{$tag->name}}</label>
                                @endif
                            @endif
                        @endforeach
                    </div>

                    {{-- PHOTOS --}}
                    <div class="form-group">
                        <h4>Photos</h4>

                            @foreach ($page->photos as $photo)
                                <input type="checkbox" name="photos[]" value="{{$photo->id}}">
                                <img src="{{asset('storage/'  . $photo->path)}}" alt="">
                            @endforeach

                    </div>
                    <input type="submit" value="Store" class="btn btn-primary float-right">
                </form>
            </div>
        </div>
    </div>
@endsection
