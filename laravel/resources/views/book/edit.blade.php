<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Blog - SantriKoding.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Gambar</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Judul</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $book->title) }}" placeholder="Masukkan Judul Buku">
                            
                                <!-- error message untuk title -->
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Penulis</label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author', $book->author) }}" placeholder="Masukkan Judul Buku">
                            
                                <!-- error message untuk author -->
                                @error('author')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Genre</label>
                                <!-- <input type="text" class="form-control @error('genre') is-invalid @enderror" name="genre" value="{{ old('genre', $book->genre) }}" placeholder="Masukkan Genre Buku"> -->
                                <select class="form-control @error('genre') is-invalid @enderror" name="genre" value="{{ old('genre', $book->genre) }}">
                                    <option {{old('genre',$book->genre)=="Horor"? 'selected':''}}>Horor</option>
                                    <option {{old('genre',$book->genre)=="Comedy"? 'selected':''}}>Comedy</option>
                                    <option {{old('genre',$book->genre)=="Action"? 'selected':''}}>Action</option>
                                    <option {{old('genre',$book->genre)=="Romance"? 'selected':''}}>Romance</option>
                                </select>
                                <!-- error message untuk genre -->
                                @error('genre')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Harga</label>
                                <input type="numeric" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $book->price) }}" placeholder="Masukkan Harga Buku">
                            
                                <!-- error message untuk price -->
                                @error('price')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Genre</label>
                                <input type="numeric" class="form-control @error('total_pages') is-invalid @enderror" name="total_pages" value="{{ old('total_pages', $book->total_pages) }}" placeholder="Masukkan Jumlah Halaman">
                            
                                <!-- error message untuk total_pages -->
                                @error('total_pages')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            

                            <button type="submit" class="btn btn-md btn-primary">Update</button>
                            <button type="reset" class="btn btn-md btn-warning">Reset</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
</body>
</html>