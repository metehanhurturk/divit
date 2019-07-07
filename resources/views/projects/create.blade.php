@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="md:w-2/3 pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light">
                    <div class="flex-auto p-6">
                        <h3 class="text-lg mb-4 text-center">Let's create something new.</h3>
                    </div>

                    <div class="flex-auto p-6">
                        <form method="post" action="{{ route('projects.store') }}">
                            @include('projects.form', [
                                    'project' => new Divit\Models\Project(),
                                    'btnText' => 'Create Project'
                                ]
                            )
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
