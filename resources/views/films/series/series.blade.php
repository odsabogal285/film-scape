@foreach($series as $serie)
    <div class="card mr-2" style="width: 18rem; border-radius: 5%">
        <div data-id="{{$serie->id}}" hidden></div>
        <img src="https://image.tmdb.org/t/p/original/{{$serie->poster_path??$serie->image}}" class="card-img-top" alt="..." width="150" height="350" style="border-radius: 5%;">
        <div class="point-burst">
        </div>
        <div style="position: relative; top: -50px; left: 18px; ">
            <div style="position: absolute; top: 0; left: 0" class="text-white">
                {{($serie->vote_average??$serie->qualification)*10}}%
            </div>
        </div>
        {{--<div class="heart" data-id="{{$movie->id}}" data-type="heart">--}}
        <div class="pretty p-icon p-toggle p-plain p-smooth p-bigger heart"  style="font-size: 20px">
            <input type="checkbox" data-plugin="pretty" data-id="{{$serie->id}}" {{!empty($serie->checked)?$serie->checked?'checked':'':''}}/>
            <div class="state p-off">
                <i class="icon fa fa-heart-o "></i>
                <label></label>
            </div>
            <div class="state p-on p-danger-o ">
                <i class="icon fa fa-heart"></i>
                <label></label>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$serie->title??$serie->name}}</h5>
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item" style="border-top: 1px solid #dfdfdf">Fecha salida: {{$serie->release_date??$serie->first_air_date}}</li>
        </ul>
    </div>
@endforeach
