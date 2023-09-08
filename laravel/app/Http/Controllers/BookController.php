<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('book/index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'author' => 'required|string',
            'genre' => 'required|string',
            'price' => 'required|numeric',
            'total_pages' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/books', $image->hashName());
    
        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'price' => $request->price,
            'total_pages' => $request->total_pages,
            'image' => $image->hashName(),
        ]);
    
        if($book){
            //redirect dengan pesan sukses
            return redirect()->route('book.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }
        else{
            //redirect dengan pesan error
            return redirect()->route('book.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book/edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'author' => 'required|string',
            'genre' => 'required|string',
            'price' => 'required|numeric',
            'total_pages' => 'required|numeric',
        ]);
    
        //get data Blog by ID
        $book = Book::findOrFail($book->id);
        
        if($request->file('image') == "") {
            
            $book->update([
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'price' => $request->price,
                'total_pages' => $request->total_pages,
            ]);
            
        }
        else {
    
            Storage::disk('local')->delete('public/books/'.$book->image);
    
            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/books', $image->hashName());
    
            $book->update([
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'price' => $request->price,
                'total_pages' => $request->total_pages,
                'image' => $image->hashName(),
            ]);
            
        }
    
        if($book){
            return redirect()->route('book.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }
        else {           
            return redirect()->route('book.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        Storage::disk('local')->delete('public/books/'.$book->image);
        $book->delete();

        if($book){
            //redirect dengan pesan sukses
            return redirect()->route('book.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
        else {
            //redirect dengan pesan error
            return redirect()->route('book.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
