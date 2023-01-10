<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;

// use App\Http\Controllers\Bookrequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{

    public function __construct()
    {
     $this->middleware('auth');
    }
    public function list()
    {
        $items = Book::orderBy('name', 'asc')->get();
        return view(
            'book.list',
            [
                'title' => 'Grāmatas',
                'items' => $items
            ]
        );
    }

    public function create()
    {
        $authors = Author::orderBy('name', 'asc')->get();
        return view(
            'book.form',
            [
                'title' => 'Pievienot grāmatu',
                'book' => new Book(),
                'authors' => $authors,
            ]
        );
    }

    // public function put(Request $request)
// {
//  $validatedData = $request->validate([
//  'name' => 'required|min:3|max:256',
//  'author_id' => 'required',
//  'description' => 'nullable',
//  'price' => 'nullable|numeric',
//  'year' => 'numeric',
//  'image' => 'nullable|image',
//  'display' => 'nullable'
//  ]);
//  $book = new Book();
//  $book->name = $validatedData['name'];
//  $book->author_id = $validatedData['author_id'];
//  $book->description = $validatedData['description'];
//  $book->price = $validatedData['price'];
//  $book->year = $validatedData['year'];
//  $book->display = (bool) ($validatedData['display'] ?? false);
//  if ($request->hasFile('image')) {
//     $uploadedFile = $request->file('image');
//     $extension = $uploadedFile->clientExtension();
//     $name = uniqid();
//     $book->image = $uploadedFile->storePubliclyAs(
//     '/',
//     $name . '.' . $extension,
//     'uploads'
//     );
//    }

    //  $book->save();
//  return redirect('/books');
// }

    public function update(Book $book)
    {
        $authors = Author::orderBy('name', 'asc')->get();
        return view(
            'book.form',
            [
                'title' => 'Rediģēt grāmatu',
                'book' => $book,
                'authors' => $authors,
            ]
        );
    }
    // public function patch(Book $book, Request $request)
// {
//  $validatedData = $request->validate([
//  'name' => 'required|min:3|max:256',
//  'author_id' => 'required',
//  'description' => 'nullable',
//  'price' => 'nullable|numeric',
//  'year' => 'numeric',
//  'image' => 'nullable|image',
//  'display' => 'nullable'
//  ]);
//  $book->name = $validatedData['name'];
//  $book->author_id = $validatedData['author_id'];
//  $book->description = $validatedData['description'];
//  $book->price = $validatedData['price'];
//  $book->year = $validatedData['year'];
//  $book->display = (bool) ($validatedData['display'] ?? false);
//  if ($request->hasFile('image')) {
//     $uploadedFile = $request->file('image');
//     $extension = $uploadedFile->clientExtension();
//     $name = uniqid();
//     $book->image = $uploadedFile->storePubliclyAs(
//     '/',
//     $name . '.' . $extension,
//     'uploads'
//     );
//    }

    //  $book->save();
//  return redirect('/books/update/' . $book->id);
// }
    private function saveBookData(Book $book, BookRequest $request)
    {
        //  $validatedData = $request->validate([
//  'name' => 'required|min:3|max:256',
//  'author_id' => 'required',
//  'description' => 'nullable',
//  'price' => 'nullable|numeric',
//  'year' => 'numeric',
//  'image' => 'nullable|image',
//  'display' => 'nullable'
//  ]);
//  $book->name = $validatedData['name'];
//  $book->author_id = $validatedData['author_id'];
//  $book->description = $validatedData['description'];
//  $book->price = $validatedData['price'];
//  $book->year = $validatedData['year'];
        $validatedData = $request->validated();
        $book->fill($validatedData);
        $book->display = (bool) ($validatedData['display'] ?? false);
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $book->image = $uploadedFile->storePubliclyAs(
                '/',
                $name . '.' . $extension,
                'uploads'
            );
        }
        $book->save();
    }
    public function put(BookRequest $request)
    {
        $book = new Book();
        $this->saveBookData($book, $request);
        return redirect('/books');
    }
    public function patch(Book $book, BookRequest $request)
    {
        $this->saveBookData($book, $request);
        return redirect('/books/update/' . $book->id);
    }

    public function delete(Book $book)
    {
        $book->delete();
        return redirect('/books');
    }

    public function messages()
    {
        return [
            'required' => 'Lauks ":attribute" ir obligāts',
            'min' => 'Laukam ":attribute" jābūt vismaz :min simbolus garam',
            'max' => 'Lauks ":attribute" nedrīkst būt garāks par :max simboliem',
            'boolean' => 'Lauka ":attribute" vērtībai jābūt "true" vai "false"',
            'unique' => 'Šāda lauka ":attribute" vērtība jau ir reģistrēta',
            'numeric' => 'Lauka ":attribute" vērtībai jābūt skaitlim',
            'image' => 'Laukā ":attribute" jāpievieno korekts attēla fails',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nosaukums',
            'author_id' => 'autors',
            'description' => 'apraksts',
            'price' => 'cena',
            'year' => 'gads',
            'image' => 'attēls',
            'display' => 'publicēt',
        ];
    }
}