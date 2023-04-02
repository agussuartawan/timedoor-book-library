@extends('layouts.app')

@section('content')
    <h1 class="text-center">Top 10 Most Famous Author</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Author Name</th>
                <th>Voter</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($authors as $key => $author)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->voter() }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="6">Data not found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection