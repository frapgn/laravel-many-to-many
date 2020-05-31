@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page)
                        <tr>
                            <dt>{{$page->title}}</dt>
                            <dt>{{$page->user->name}}</dt>
                        </tr>
                    @endforeach
                </tbody>
            </div>
        </div>
    </div>
@endsection
