@extends('task.index')

@section('content')
<div>
    <form action="">
        <!-- title -->
        <div>
            <label for=""></label>
            <input type="text">
            @error('title')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <!-- description -->
        <div>
            <label for=""></label>
            <input type="text">
            @error('title')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <!-- completed -->
        <div>
            <label for=""></label>
            <input type="checkbox">
            @error('title')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <!-- due at -->
        <div>
            <label for=""></label>
            <input type="date">
            @error('title')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <!-- priority -->
        <div>
            <label for="priority">Priority</label>
            <select id="priority" name="priority">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
            @error('priority')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

    </form>
</div>
@endsection