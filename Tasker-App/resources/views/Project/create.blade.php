@extends('task.index')

@section('content')
<div>
    <form action="">
        <div>
            <label for="">Owner</label>
            <input type="text">
            @error('title')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="">name</label>
            <input type="text">
            @error('title')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="">description</label>
            <input type="text">
            @error('title')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="">start Date</label>
            <input type="text">
            @error('title')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="">End Date</label>
            <input type="text">
            @error('title')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="">users</label>
            <input type="text">
            @error('title')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

    </form>
</div>
@endsection
