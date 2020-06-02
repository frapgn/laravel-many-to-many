<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

use App\Page;
use App\User;
use App\Category;
use App\Tag;
use App\Photo;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate();

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $photos = Photo::all();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.pages.create', compact('photos', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|max:200',
            'summary' => 'max:65535',
            'body' => 'max:65535',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.pages.create')
            ->withErrors($validator)
            ->withInput();
        }

        if (isset($data['photo'])) {
            $path = Storage::disk('public')->put('images', $data['photo']);
            $photo = new Photo;
            $photo->user_id = Auth::id();
            $photo->name = $data['title'];
            $photo->path = $path;
            $photo->description = 'photo description';
            $photo->save();
        }

        $page = new Page;
        $now = Carbon::now()->format('Y-m-d-H-i-s');
        $data['slug'] = Str::slug($data['title'], '-') . '-' . $now;
        $data['user_id'] = Auth::id();
        $page->fill($data);
        $saved = $page->save();

        if (!$saved) {
            return redirect()->back();
            // ->with...
        }

        if (!empty($photo)) {
            $page->photos()->attach($photo);
        }

        $page->tags()->attach($data['tags']);

        Mail::to('firecaw331@dffwer.com')->send(new SendNewMail($page));

        return redirect()->route('admin.pages.show', $page->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);

        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        $photos = Photo::all();

        return view('admin.pages.edit', compact('page','categories', 'tags', 'photos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|max:200', //rimuovere required
            'slug' => 'unique|max:255',
            'summary' => 'max:65535',
            'body' => 'max:65535',
            'category_id' => 'exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator) // da aggiungere alla view
            ->withInput();
        }

        /* Controllo se l'id dell'autore della pagina è lo stesso dell'utente loggato
         * Se non lo è restituisco un errore 404 */
        $userId = Auth::id();
        $author = $page->user_id;
        if ($userId != $author) {
            abort('404');
        }

        // Upload new / delete old photos
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
