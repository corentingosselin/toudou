@extends('layouts.app')
@section('title', 'Mes projets')

@section('content')


    <div class="flex justify-center">
        <div class="w-9/12">
            <div class="flex justify-center">
                <div class="flex justify-center mt-12">
                    <img src="{{ asset('images/cloudy.svg') }}" width="60" height="60" class="">
                    <span class="text-light text-5xl font-thin"> Vos projets en cours </span>
                </div>
            </div>
            <div class="w-full">
                <div class="mt-12 flex flex-wrap">

                    @foreach ($projects as $project)
                        <div class="w-1/4 mt-8 ml-12">
                            <div class="relative border-4 border-light rounded-3xl pb-16 pt-10">
                                <form method="POST" action="{{ route('projects.delete', $project->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="remove hidden" type="submit"><i
                                            class="fa fa-times-circle fa-3x absolute -top-7 -right-7 text-red-800"></i></button>
                                </form>

                                <span
                                    class="flex justify-center font-bold text-light text-2xl">{{ $project->title }}</span>

                                <div class="flex justify-center">
                                    <a href="{{ route('project', $project->id) }}" title="show"><i
                                            class="flex mt-5 fa fa-edit fa-4x text-main hover:text-opacity-70"></i></a>
                                </div>
                                <div class="flex justify-center">
                                    <p class="mt-3 mr-6 ml-6 text-light">{{ $project->user->username }}</p>
                                </div>
                            </div>

                        </div>
                    @endforeach
                    <div class="w-1/4 mt-8 ml-12">
                        <div class="border-4 border-light rounded-3xl pb-10 pt-6">
                            <span class="flex justify-center font-bold text-light text-2xl">Nouveau projet</span>
                            <div class="flex justify-center">

                                <form method="POST" action="{{ route('projects') }}">
                                    @csrf
                                    <div class="flex flex-col">
                                        <label class="font-semibold text-light text-lg pt-5" for="title">Intitulé</label>
                                        <input class="rounded-3xl border-2 border-gray-300" type="text" name="title"
                                            id="title" required>
                                    </div>
                                    <br />
                                    <div class="flex justify-center">
                                        <button type="submit" name="action" value="create">
                                            <i class="fa fa-plus-circle fa-4x text-main hover:text-opacity-70"></i>
                                        </button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-3/12 mr-8 mb-16 mt-48">

            <div class="ml-12 border-4 border-light rounded-3xl ">
                <div class="flex justify-center mt-12">
                    <img src="{{ asset('images/cloudy.svg') }}" width="60" height="60" class="">
                    <span class="flex justify-center text-light text-3xl font-bold mt-3 ml-4">En attente</span>
                </div>




                @forelse ($invitations as $invitation)
                    <div class="mt-12 flex justify-center text-2xl font-semibold">
                        <div class="flex justify-center">
                            <span class="text-light"> {{ $invitation->project->title }}</span>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <div class="flex justify-center">
                            <span class="text-light"> {{ $invitation->project->user->surname }}
                                {{ $invitation->project->user->name }} </span>
                        </div>
                    </div>

                    <div class="flex flex-row items-center justify-center mt-3">
                        <form method="POST" action="{{ route('projects', $invitation->id) }}">
                            @method("PUT")
                            @csrf
                            <input type="hidden" name="invitation_id" value="{{ $invitation->id }}">
                            <button type="submit" name="action" value="decline"> <i
                                    class="ml-8 mr-3  fa fa-ban fa-2x text-main hover:text-opacity-70"></i> </button>

                            <button type="submit" name="action" value="accept"><i
                                    class="mr-8 ml-12 flex fa fa-check-circle fa-4x text-main hover:text-opacity-70"></i></button>
                        </form>
                    </div>
                @empty
                    <div class="flex flex-row items-center justify-center mt-3">
                        <span class="flex justify-center text-light text-2xl font-semibold mt-3 ml-4">Aucun...</span>
                    </div>
                @endforelse







                <div class="flex justify-center mt-8 mb-8">
                    <button id="remove" type="button"
                        class="focus:outline-none text-white text-2xl py-3 px-3 border-b-8  bg-light hover:bg-opacity-70">Supprimer
                        des objets </button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
    $("#remove").on('click', function(e) {
        if ($(".remove").hasClass("hidden")) {
            $(".remove").removeClass("hidden");
        } else {
            $(".remove").addClass("hidden");
        }
    });

</script>
@stop