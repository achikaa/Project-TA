<div class="container-fluid">
    <div class="row">

        <div class="col">
            <a href="{{ url($link_new ?? '#') }}" >
            <div class="card baseBlock h-75" style="cursor:pointer; background: rgb(3, 35, 108);">
                <div class="card-body text-white">
                    <div class="media d-flex" style="position: relative">
                        <div class="media-body text-left">
                        <h3>{{$countnew ?? 0}}</h3>
                        <h5 style="font-weight: bold;">New</h5>
                        </div>
                        <div class="cardicons">
                        <i class="fas fa-flag-checkered fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>

        <div class="col">
            <a href="{{ url($link_onGoing ?? '#') }}" >
            <div class="card baseBlock h-75" style="background: #001cbb;cursor:pointer">
                <div class="card-body text-white">
                    <div class="media d-flex" style="position: relative">
                        <div class="media-body text-left">
                        <h3>{{$countongoing ?? 0}}</h3>
                        <h5 style="font-weight: bold;">OnGoing</h5>
                        </div>
                        <div class="cardicons">
                        <i class="fas fa-road fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col">
            <a href="{{ url($link_finish ?? '#') }}" >
            <div class="card baseBlock h-75" style="background: rgb(7, 129, 255);cursor:pointer">
                <div class="card-body text-white">
                    <div class="media d-flex" style="position: relative">
                        <div class="media-body text-left">
                        <h3>{{$countfinish ?? 0}}</h3>
                        <h5 style="font-weight: bold;">Finish</h5>
                        </div>
                        <div class="cardicons">
                        <i class="fas fa-send fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
</div>