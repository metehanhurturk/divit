@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-gray-600 text-sm font-normal">My Projects</h2>

            <a class="button" href="{{ route('projects.create') }}">New Project</a>
        </div>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('partials.card')
            </div>
        @empty
            <div>
                <h3>No project is added yet!</h3>
            </div>
        @endforelse
    </main>

@endsection
