@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-gray-600 text-sm font-normal">
                <a class="text-gray-600 text-sm font-normal no-underline" href="{{ route('projects.index') }}">My Projects</a> / {{ $project->title }}
            </p>
            <a class="button" href="{{ route('projects.edit', $project) }}">Edit Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3">

                <div class="mb-8">
                    <h2 class="text-gray-600 font-normal text-lg mb-3">Tasks</h2>

                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form action="{{ route('tasks.update', [$project, $task]) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="flex">
                                    <input class="w-full {{ $task->completed ? 'text-gray-600' : '' }}" type="text" placeholder="Add some tasks..." name="body" value="{{ $task->body }}">
                                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-3">
                        <form action="{{ route('tasks.store', $project) }}" method="post">
                            @csrf
                            <input class="w-full" type="text" placeholder="Add some tasks..." name="body">
                        </form>
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-gray-600 font-normal text-lg mb-3">General Notes</h2>

                    <form action="{{ route('projects.update', $project) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <textarea class="card w-full mb-4 @if($errors->first('description')) border-red-500 @endif" style="min-height: 200px" name="notes" placeholder="Share something...">{{ $project->notes }}</textarea>
                        @if($errors->first('notes'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('notes') }}</p>
                        @endif

                        <button class="button" type="submit">Save</button>
                    </form>
                </div>
            </div>

            <div class="lg:w-1/4 px-3">
                @include('partials.card')
            </div>
        </div>
    </main>

@endsection
