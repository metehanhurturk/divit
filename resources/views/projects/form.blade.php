@csrf

<div class="flex mb-4">
    <div class="w-1/4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
            <strong>Title :</strong>
        </label>
    </div>
    <div class="w-3/4">
        <input id="title" name="title" type="text" placeholder="Title" required
               value="{{ $project->title }}"
               class="appearance-none border rounded w-full py-2 px-3 text-gray -700 mb-3 leading-tight focus:outline-none focus:shadow-outline @if($errors->first('title')) border-red-500 @endif"/>
        @if($errors->first('title'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('title') }}</p>
        @endif
    </div>
</div>

<div class="flex mb-4">
    <div class="w-1/4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
            <strong>Description :</strong>
        </label>
    </div>
    <div class="w-3/4">
        <textarea id="description" name="description" required
                  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @if($errors->first('description')) border-red-500 @endif">{{ $project->description }}</textarea>
        @if($errors->first('description'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('description') }}</p>
        @endif
    </div>
</div>

<div class="flex mb-4">
    <div class="w-full">
        <button type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            {{ $btnText }}
        </button>
        <a class="py-2 px-4" href="{{ url($project->path()) }}">Cancel</a>
    </div>
</div>

@if($errors->any())
    <div class="field mt-6">
        @foreach($errors->all() as $error)
            <p class="text-red-500 text-xs italic">{{ $error }}</p>
        @endforeach
    </ul>
@endif
