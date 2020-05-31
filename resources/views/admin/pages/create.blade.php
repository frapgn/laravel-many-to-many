@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <form action="{{route('admin.pages.store')}}" method="post" enctype="multipart/form-data" class="clearfix">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                      <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
                    </div>

                    <div class="form-group">
                      <label for="summary">Summary</label>
                    <input type="text" name="summary" id="summary" class="form-control" value="{{old('summary')}}">
                    </div>

                    <div class="form-group">
                      <label for="body">Body</label>
                    <textarea name="body" id="body" class="form-control" value="" rows="8" cols="80">{{old('body')}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" name="category_id" id="category">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}"
                                {{(old('category_id') == $category->id) ? 'selected' : ''}}>
                                {{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        @foreach ($tags as $key => $tag)
                            <input type="checkbox" id="tag-{{$tag->id}}"name="tags[]" value="{{$tag->id}}"
                             {{(is_array(old('tags')) &&  in_array($tag->id, old('tags'))) ? 'checked' : ''}}>
                             <label for="tag-{{$tag->id}}">{{$tag->name}}</label>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <h4>Upload photo</h4>
                        <input type="file" name="photo" id="photo">
                    </div>
                    <input type="submit" value="Store" class="btn btn-primary float-right">
                </form>
            </div>
        </div>
    </div>
@endsection
