@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $page)
                            <tr>
                                <td>{{$page->title}}</td>
                                <td>{{$page->user->name}}</td>
                                <td><a href="{{route('admin.pages.show', $page->id)}}">View</a></td>
                                <td><a href="{{route('admin.pages.edit', $page->id)}}">Edit</a></td>
                                <td>
                                    <form action="{{route('admin.pages.destroy', $page->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
