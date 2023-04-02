@extends('layouts.app')

@section('content')
    <form action="{{ route('books') }}" method="GET" id="form">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="limit">List Shown</label>
                <select name="limit" id="limit" class="form-select" onchange="submit()">
                    @foreach ($limits as $limit)
                        <option value="{{ $limit }}" @if(request()->get('limit') == $limit) selected @endif>{{ $limit }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    
        <div class="col-lg-4">
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" id="search" name="search" class="form-control" onchange="submit()" value="{{ request()->get('search') }}">
            </div>
        </div>

        <button class="btn btn-primary mt-3">Submit</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Book Name</th>
                <th>Category Name</th>
                <th>Author Name</th>
                <th>Average Rating</th>
                <th>Voter</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $key => $book)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ $book->averageRating() }}</td>
                    <td>{{ $book->voter() }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="6">Data not found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

@push('js')
    <script>
        const submit = () => {
            document.querySelector('#form').submit();
        }
    </script>
@endpush