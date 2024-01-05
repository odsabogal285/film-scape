@extends('adminlte::page')

@section('title', "{$movie->title}")

@section('content_header')
    {{--<h1>{{$movie->title}}</h1>--}}
@stop

@push('css')
    <style>
        .card {
            flex: 0 1 24%;
        }
        .point-burst {
            color: red;
            top: -20px;
            left: 10px;
            background: #333;
            width: 40px;
            height: 40px;
            position: relative;
            text-align: center;
            transform: rotate(20deg);
          }
        .point-burst:before {
              content: "";
              position: absolute;
              top: 0;
              left: 0;
              height: 40px;
              width: 40px;
              background: #333;
              transform: rotate(135deg);
          }

        .heart {
            /* Modify size here: */
            position: absolute !important;
            top: 10px;
            right: 1px;
            z-index: 4;
            width: var(--size);
            height: calc(var(--size) * 0.3);
            margin-right: 0 !important;
        }

        .pretty.p-toggle .state.p-off .icon {
            color: white !important;
        }
    </style>

@endpush

@section('content')
    <div class="container-xl d-flex" id="movies" style="flex-wrap: wrap; justify-content: space-between;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <img src="https://image.tmdb.org/t/p/original/{{$movie->poster_path??$movie->image}}" class="card-img-top" alt="..." width="150" height="350" style="border-radius: 5%;">
                </div>
                <div class="col-md-8">
                    <h5 class="card-title">{{$movie->title}}</h5>
                    <br>
                    {{$movie->release_date}}
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        // Mirar como validar lo del data-type in l9
       let pagina = 2;
       const loading = document.getElementById('loading');
       window.onscroll = () => {
           loading.removeAttribute('hidden');
           if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
               fetch(`/list-movies?page=${pagina}`, {
                  method: 'get'
               })
                   .then(response => response.text())
                   .then(html => {
                       loading.setAttribute('hidden', '');
                       document.getElementById('movies').innerHTML += html;
                       pagina++;
                       $('[data-plugin="pretty"]').each(function (a, e) {
                           $(this).change(function () {
                               var id = $(this).data('id');
                               var active = $(this).prop('checked');
                               let $active = $(this).parent().parent().find('.active');
                               console.log(id, this, active, $active);
                               $.ajax({
                                   url: `{{route('update-favorite')}}`,
                                   type: 'post',
                                   headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                                   dataType: 'json',
                                   data: {id: id, active: active ? 1 : 0},
                                   success: function (response) {
                                       if (active) {
                                           $active.html(`<span class="text-success">Active</span>`);
                                       } else {
                                           $active.html(`<span class="text-danger">Inactive</span>`);
                                       }
                                   },
                                   error: function (jqXHR, exception) {
                                       console.log(jqXHR, exception);
                                   }
                               });
                           });
                       });
                   })
                   .catch(error => console.log(error))
           }
       }

        $('[data-plugin="pretty"]').each(function (a, e) {
            $(this).change(function () {
                var id = $(this).data('id');
                var active = $(this).prop('checked');
                let $active = $(this).parent().parent().find('.active');
                console.log(id, this, active, $active);
                $.ajax({
                    url: `{{route('update-favorite')}}`,
                    type: 'post',
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    dataType: 'json',
                    data: {id: id, active: active ? 1 : 0},
                    success: function (response) {
                        if (active) {
                            $active.html(`<span class="text-success">Active</span>`);
                        } else {
                            $active.html(`<span class="text-danger">Inactive</span>`);
                        }
                    },
                    error: function (jqXHR, exception) {
                        console.log(jqXHR, exception);
                    }
                });
            });
        });

    </script>
@endpush
