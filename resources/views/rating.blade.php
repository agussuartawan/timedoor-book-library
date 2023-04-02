@extends('layouts.app')

@section('content')
    <form action="{{ route('ratings.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="form-group mb-3">
            <select name="author_id" id="author_id" class="form-select" onchange="filter()">
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
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
            <select name="rating" id="rating" class="form-select">
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
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