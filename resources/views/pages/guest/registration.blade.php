<x-guest-layout title="Pendaftaran Magang">
    @section('style')
        <script src="/assets/vendor/js/jquery.min.js"></script>
        <link href="/assets/vendor/css/select2.min.css" rel="stylesheet" />
        <script src="/assets/vendor/js/select2/select2.min.js"></script>
        <script src="/assets/vendor/js/select2/id.min.js"></script>
        <style>
            .hasImage:hover section {
                background-color: rgba(5, 5, 5, 0.4);
            }
            .hasImage:hover button:hover {
                background: rgba(5, 5, 5, 0.45);
            }

            #overlay p,
            i {
                opacity: 0;
            }

            #overlay.draggedover {
                background-color: rgba(255, 255, 255, 0.7);
            }
            #overlay.draggedover p,
            #overlay.draggedover i {
                opacity: 1;
            }

            .group:hover .group-hover\:text-blue-800 {
                color: #2b6cb0;
            }
    </style>
    @endsection

    <div class="banner justify-center py-16" style="background: url('/assets/img/hero-bg.png')">
        <div class="container max-w-screen-xl mx-auto items-center">
            @livewire('create-apprentice')
        </div>
    </div>


    @section('scripts')
        <script>
            $("#selectAgency").select2({
                tags: false,
                language: "id"
            });
        </script>
        <script> Livewire.on('openTab', link => { alert('A post was added with the id of: ' + link); }) </script>
    @endsection
</x-guest-layout>