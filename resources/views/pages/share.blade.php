@extends('layouts.app')
@section('title', 'Mes partages')


@section('share')
    <div class="text-grey text-2xl pt-3 pr-11 pb-3 pl-3 bg-form rounded-md">
        <a href="{{ route('project', request()->route('id')) }}">
            <span class="text-light ml-8">{{ $title }}</span>
            <i class="fa fa-arrow-left fa-lg text-light ml-5"></i>
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

            <div class="ml-12">
                <div class="w-full">
                    <div class="flex justify-center mt-8">
                        <div class="w-9/12">
                            <div class="mb-5">
                                <div class="flex justify-between mr-6">
                                    <span class="text-grey text-2xl">Utilisateurs avec accès</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                @forelse ($shared as $share)
                    <div id="share-{{ $share->id }}" class="w-full">
                        <div class="flex justify-center mt-8">
                            <div class="bg-form2 shadow-lg w-9/12 rounded-2xl">
                                <div class="mb-5 mt-5">
                                    <div class="flex justify-between mr-6">
                                        <span class="text-grey ml-6 text-2xl">{{ $share->user->username }}</span>
                                        <div>

                                            <button type="submit" class="edit-share" value="{{ $share->id }}">
                                                @csrf
                                                <i class="fa fa-pencil fa-2x text-grey mr-4 {{ $share->edit ? 'hover:text-opacity-70' : 'text-opacity-40' }}"></i>
                                            </button>

                                            <button type="submit" class="delete-share" value="{{ $share->id }}">
                                                @csrf
                                                <i class="fa fa-trash-o fa-2x text-grey hover:text-opacity-70 ml-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="w-full">
                        <div class="flex justify-center mt-8">
                            <div class="bg-form2 shadow-lg w-9/12 rounded-2xl">
                                <div class="mb-5 mt-5">
                                    <div class="flex justify-between mr-6">
                                        <span class="text-grey ml-6 text-2xl">Aucun partage...</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>

        <div class="w-6/12 mr-8 mb-16">

            <div class="ml-12">
                <div class="w-full">
                    <div class="flex justify-center mt-8">
                        <div class="bg-form w-9/12 rounded-2xl">
                            <div class="mb-5 mt-5">
                                <div class="flex justify-between mr-6">
                                    <span class="text-grey ml-6 text-2xl">Ajouter un nouvel utilisateur avec accès</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="flex justify-center">
                        <div class="bg-form w-9/12 rounded-2xl">
                            <div class="mb-5 mt-5">
                                <div class="flex justify-between mr-6">
                                    <span class="text-grey text-1xl">Adresse mail ou identifiant</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="flex justify-center">
                        <div class="bg-form w-9/12 rounded-2xl">
                            <div class="mb-5">
                                <div class="flex justify-between mr-6">

                                    <form class="navbar-form text-center " form method="POST" action="{{ route('share.create') }}">
                                        @csrf
                                        <input type="hidden" value="{{ request()->route('id') }}" name="project_id">
                                        <input id="search" placeholder="Tapez un nom d'utilisateur" name="username"
                                            type="text" value=""
                                            style="width: 400px; height: 35px; border-radius: 5px ; padding-left: 12px;"><br><br>
                                        <input class="btn btn-default " type="submit" value="ajouter">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
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
    $(document).ready(function() {
        $("#search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ url('autocomplete') }}",
                    data: {
                        term: request.term
                    },
                    dataType: "json",
                    success: function(data) {
                        var resp = $.map(data, function(obj) {
                            return obj.username;
                        });

                        response(resp);
                    }
                });
            },
            minLength: 3
        });
    });


    $(".delete-share").on('click', function(e) {
        e.preventDefault();
        let shareId = $(this).val();
        let url = '{{ route('share.delete', ':id') }}';
        url = url.replace(':id', shareId);
        let token = $("input[name='_token']").val();
        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                "id": shareId,
                "_token": token,
            },
            success: function() {
                $("#share-" + shareId).remove();

            }
        });
    });


    $(".edit-share").on('click', function(e) {
        let edit = 0;
        if ($(this).children(".text-opacity-40")[0]){
            $(this).children(".text-opacity-40").removeClass("text-opacity-40");
            edit = 1;
        } else {
            $(this).children("i").addClass("text-opacity-40");
        }
        let shareId = $(this).val();
        let url = '{{ route('share.update', ':id') }}';
        url = url.replace(':id', shareId);
        let token = $("input[name='_token']").val();
        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                "share_id": shareId,
                "edit": edit,
                "_token": token,
            }
        });
    });

</script>
@stop
