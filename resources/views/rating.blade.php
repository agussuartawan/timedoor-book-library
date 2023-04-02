@extends('layouts.app')

@section('content')
    <form action="{{ route('ratings.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="form-group mb-3">
            <label for="author_id">Book Author</label>
            <select name="author_id" id="author_id" class="form-select" onchange="filter()">
                <option value="">~Select Author~</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" @if(request()->get('author_id') == $author->id) selected  @endif>{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="book_id">Book Name</label>
            <select name="book_id" id="book_id" class="form-select">
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
            @error('book_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>        

        <div class="form-group mb-3">
            <label for="author_id">Rating</label>
            <select name="rating" id="rating" class="form-select">
                @foreach ($ratings as $rating)
                    <option value="{{ $rating }}">{{ $rating }}</option>
                @endforeach
            </select>
            @error('rating')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Submit</button>
    </form>
@endsection

@push('js')
    <script>
        const filter = () => {
            const authorId = document.querySelector('#author_id').value;
            window.location.href = '{{ route('ratings') }}' + '?author_id=' + authorId;
        }
    </script>
@endpush