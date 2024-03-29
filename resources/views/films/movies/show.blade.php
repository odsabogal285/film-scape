@extends('adminlte::page')

@section('title', "{$movie->title}")

@section('content_header')
    {{--<h1>{{$movie->title}}</h1>--}}
@stop

@push('css')
    <style>
        .card_image {
            width: 190px;
            height: 254px;
            background: lightgrey;
            border: 3px inset white;
            background: #e8e8e8;
            box-shadow: inset 20px 20px 60px #c5c5c5, inset -20px -20px 60px #ffffff;
            transition: all .5s ease-in-out;
            border-radius: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bolder;
            color: #8a8989;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

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

        #circle strong {
            position: absolute;
            top: 235px;
            left: -100px;
            width: 100%;
            text-align: center;
            line-height: 40px;
            font-size: 30px;
        }

        #circle-bar {
            width: 70px;
            height: 70px;
            margin-top: 10px;
        }
        
        .progressbar-text {
            color: black !important;
        }

        ol.people {
            margin-top: 20px;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        ol.people.no_image li {
            list-style-type: none;
            list-style-position: inside;
            width: 33%;
            flex-basis: 33%;
            text-align: left;
            margin-bottom: 14px;
            margin-right: 0;
            box-sizing: border-box;
            padding-right: 20px;
            /*display: flex;*/
           /* position: relative;
            top: 0;
            left: 0;*/
        }

        swiper-container {
            width: 100%;
            height: 100%;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            flex-direction: column;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

@endpush

@section('content')
    <div class="container-xl d-flex" id="movies" style="flex-wrap: wrap; justify-content: space-between;">
        <div class="col-md-12">
            <div class="row mt-2">
                <div class="col-md-4">
                    <img src="https://image.tmdb.org/t/p/original/{{$movie->poster_path??$movie->image}}" class="card-img-top" alt="..." style="width: 90%; height: 100%; border-radius: 5%;">
                </div>
                <div class="col-md-8" style="display: flex">
                    <div style="display: flex; flex-wrap: wrap; align-items: flex-start; align-content: center">
                        <div style="">
                            <h2 class="card-title" style="font-size: 2.2rem">
                                <span style="font-weight: 700;">{{$movie->title}}</span>
                                <span> ({{\Carbon\Carbon::parse($movie->release_date)->format('Y')}}) </span>
                            </h2>
                            <br>
                            <br>
                            <div>
                                <span>{{\Carbon\Carbon::parse($movie->release_date)->format('d/m/Y')}}</span> -
                                <span>{{$genres_name}}</span> -
                                <span>{{$duration}}</span>
                            </div>
                            <div style="display:flex; align-items: center">
                                <div id="circle-bar" style="display: inline-block; margin-right: 10px"></div>
                                <span style="display: inline-block">Puntuación de los usuarios </span>
                            </div>
                            <div class="mt-1">
                                <span style="font-style: italic">{{$movie->tagline}}</span>
                            </div>
                            <div class="mt-1">
                                <span style="font-weight: bold; font-size: 1.2rem">Vista General</span>
                            </div>
                            <div class="mt-1">
                                <span>{{$movie->overview}}</span>
                            </div>
                            <div class="mt-1" style="">
                                <ol class="people no_image" style="display: flex; justify-content: start; padding: 0">
                                    @foreach($credits_director as $director)
                                        <li>
                                            <p style="margin: 0">
                                                <strong>{{$director->name}}</strong>
                                            </p>
                                            <p>
                                                {{$director->job}}
                                            </p>
                                        </li>
                                    @endforeach
                                        @foreach($credits_screenplay as $screenplay)
                                            <li >
                                                <p style="margin: 0">
                                                    <strong> {{$screenplay->name}}</strong>
                                                </p>
                                                <p>
                                                    {{$screenplay->job}}
                                                </p>
                                            </li>
                                        @endforeach
                                </ol>
                            </div>
                            {{--<div>
                                <div id="circle">
                                    <strong>a</strong>
                                </div>
                            </div>--}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div>
                        <h4>Reparto principal </h4>
                        <swiper-container class="mySwiper" init="false">
                            @foreach($casts as $cast)
                                <swiper-slide>
                                    {{--<img src="https://media.themoviedb.org/t/p/w138_and_h175_face/4VjjKw3Jzue37Y8Tm0hSWEWW1e2.jpg" alt="" width="150" height="150">--}}
                                    @if($cast->profile_path)
                                        <img src="https://image.tmdb.org/t/p/original/{{$cast->profile_path}}" alt="">
                                    @else
                                        <img src="https://www.themoviedb.org/assets/2/v4/glyphicons/basic/glyphicons-basic-4-user-grey-d8fe957375e70239d6abdd549fd7568c89281b2179b5f4470e2e12895792dfa5.svg" alt="">
                                    @endif
                                    <p>
                                        {{$cast->name}}
                                    </p>
                                </swiper-slide>
                            @endforeach
                        </swiper-container>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    {{--<script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script>
        const swiperEl = document.querySelector('swiper-container')
        Object.assign(swiperEl, {
            setWrapperSize: true,
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 6,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 7,
                    spaceBetween: 50,
                },
            },
        });
        swiperEl.initialize();

        var color;
        var trailColor;

        const vote_average = `{{$movie->vote_average}}`;

        if (vote_average*10 >= 70) {
            color = '#21d07a';
            trailColor = '#20452970';
        } else {
            color = '#cfd230';
            trailColor = '#403b0e70';
        }

        var circle = new ProgressBar.Circle('#circle-bar', {
            color: color,
            trailColor: trailColor,
            strokeWidth: 6,
            trailWidth: 6,
            easing: 'easeInOut',
            duration: 1400,
            from: {color: color, width: 6},
            to: {color: color, width: 6},
            step: function (state, circle) {
                circle.path.setAttribute('stroke', state.color);
                circle.path.setAttribute('stroke-width', state.width);

                circle.setText(`{{round($movie->vote_average*10)}}`+'%');
            }
        });
        circle.text.style.fontSize = '1.2rem';

        circle.animate(vote_average/10, 0);

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
