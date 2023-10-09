@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">Add Review for {{ $book->title }}</h1>

    <form method="post" action="{{ route('books.reviews.store', $book) }}">
        @csrf
        <label for="review">Review</label>
        <textarea name="review" id="review" required
            class="input @error('review') border border-red-500 @else mb-4 border border-slate-300 @enderror"></textarea>
        @error('review')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="rating">Rating</label>

        <select name="rating" id="rating" class="input mb-4 border border-slate-300" required>
            <option value="" selected disabled>Select a Rating</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        <button type="submit" class="btn">Add Review</button>
    </form>
@endsection
