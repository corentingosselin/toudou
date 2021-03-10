@extends('layouts.app')
@section('title', 'Mon projet')

@section('share')
    <div class="text-grey text-2xl pt-3 pr-11 pb-3 pl-3 bg-form rounded-md">
        <a href="{{ route('share', request()->route('id')) }}">
            <span class="text-light ml-8">{{ $project->title }}</span>
            <a href="" class="fa fa-share-alt fa-lg text-light hover:text-opacity-70 ml-5"></a>
        </a>
    </div>
@endsection

@section('content')


    <div class="flex justify-center">
        <div class="flex justify-center mt-32">
        </div>
    </div>
    <div class="flex justify-center">


        <div class="w-6/12 mr-8 mb-16 ">

            <div id="tasks" class="ml-12 border-8 border-light rounded-3xl bg-light">
                <div class="flex justify-center mt-12">
                    <span class="flex justify-center  fa fa-clock-o fa-4x text-white"></span>
                    <span class="mt-2.5 ml-2 text-3xl text-white">Tâches en cours</span>
                </div>



                @forelse ($tasks as $task)
                    <div class="w-full" id="task-{{ $task->id }}">
                        <div class="flex justify-center mt-8">
                            <div class="bg-form w-9/12 rounded-2xl">
                                <div class="mb-5 mt-5">
                                    <div class="flex justify-between mr-6">
                                        <p class="text-grey ml-6 text-2xl">
                                            {{ $task->description }}</p>
                                        <div class="flex justify-between">

                                            <button type="submit" class="delete-task" value="{{ $task->id }}">
                                                @csrf
                                                <i class="fa fa-trash-o fa-2x text-grey hover:text-opacity-70 ml-4"></i>
                                            </button>

                                            <button type="submit" class="done-task" value="{{ $task->id }}">
                                                @csrf
                                                <i class="fa fa-check fa-2x text-grey hover:text-opacity-70 ml-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div id="no-task" class="w-full">
                        <div class="flex justify-center mt-8">
                            <div class="bg-form w-9/12 rounded-2xl">
                                <div class="mb-5 mt-5">
                                    <div class="flex justify-between mr-6">
                                        <span class="text-grey ml-6 text-2xl">Aucune tâche en cours</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse


                <div class="w-full">
                    <div class="flex justify-center mt-8">
                        <div class="bg-form w-9/12 rounded-2xl mb-8 border-4 bg-opacity-0 border-white">
                            <div class="mb-5 mt-5">

                                <div class="flex justify-center mr-6">
                                    <div>
                                        @csrf
                                        <div class="pb-5">
                                            <span class="text-white text-xl font-semibold pr-3 "> Nom:</span>
                                            <input class=" border-2 border-gray bg-transparent" type="text"
                                                id="task-description" required>
                                        </div>
                                        <div class="flex group cursor-pointer" id="create-task">

                                            <i class="fa fa-plus fa-2x text-white mt-1 group-hover:text-opacity-70 "></i>
                                            <p class="text-white ml-6 text-2xl font-semibold group-hover:text-opacity-70">
                                                Ajouter la tâche</p>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="w-6/12 mr-8 mb-16">

            <div class="ml-12 border-8 border-grey rounded-3xl bg-grey">
                <div class="flex justify-center mt-12">
                    <span class="flex justify-center  fa fa-check fa-4x text-white"></span>
                    <span class="mt-2.5 ml-2 text-3xl text-white">Taches terminées</span>
                </div>

                @forelse ($finished_tasks as $task)
                <div class="w-full" id="task-{{ $task->id }}">
                    <div class="flex justify-center mt-8 mb-8">
                        <div class="bg-form w-9/12 rounded-2xl">
                            <div class="mb-5 mt-5">
                                <div class="flex justify-between mr-6">
                                    <p class="text-grey ml-6 text-2xl">
                                        {{ $task->description }}</p>
                                    <div class="flex justify-between">

                                        <button type="submit" class="delete-task" value="{{ $task->id }}">
                                            @csrf
                                            <i class="fa fa-trash-o fa-2x text-grey hover:text-opacity-70 ml-4"></i>
                                        </button>

                                        <button type="submit" class="undone-task" value="{{ $task->id }}">
                                            @csrf
                                            <i class="fa fa-arrow-left fa-2x text-grey hover:text-opacity-70 ml-4"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-full">
                    <div class="flex justify-center mt-8 mb-8">
                        <div class="bg-form w-9/12 rounded-2xl">
                            <div class="mb-5 mt-5">
                                <div class="flex justify-between mr-6">
                                    <span class="text-grey ml-6 text-2xl">Aucune tâche terminée</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>


    </div>

@endsection

@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script>
        $(".delete-task").on('click', function(e) {
            e.preventDefault();
            let taskId = $(this).val();
            let url = '{{ route('tasks.delete', ':id') }}';
            url = url.replace(':id', taskId);
            let token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    "id": taskId,
                    "_token": token,
                },
                success: function() {
                    $("#task-" + taskId).remove();

                }
            });
        });

        $("#create-task").on('click', function(e) {
            let description = $('#task-description').val();
            let token = $("input[name='_token']").val();
            let project_id = '{{ $project->id }}';
            let url = "{{ route('tasks.create') }}";

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    "description": description,
                    "project_id": project_id,
                    "_token": token,
                },
                success: function() {
                    location.reload();
                }
            });
        });


        $(".done-task").on('click', function(e) {
            let taskId = $(this).val();
            let url = '{{ route('tasks.update', ':id') }}';
            url = url.replace(':id', taskId);
            let token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                type: 'PUT',
                data: {
                    "task_id": taskId,
                    "done": 1,
                    "_token": token,
                },
                success: function() {
                    location.reload();
                }
            });
        });


        $(".undone-task").on('click', function(e) {
            let taskId = $(this).val();
            let url = '{{ route('tasks.update', ':id') }}';
            url = url.replace(':id', taskId);
            let token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                type: 'PUT',
                data: {
                    "task_id": taskId,
                    "done": 0,
                    "_token": token,
                },
                success: function() {
                    location.reload();
                }
            });
        });

    </script>
@stop
