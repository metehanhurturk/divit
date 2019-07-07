<div class="card" style="min-height: 200px;">

    <h3 class="font-normal text-xl py-4 -ml-5 mb-3 pl-4 border-l-4 border-blue-light">
        <a class="text-black no-underline" href="{{ $project->path() }}">{{ $project->title }}</a>
    </h3>

    <div class="text-gray-600">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</div>

</div>

