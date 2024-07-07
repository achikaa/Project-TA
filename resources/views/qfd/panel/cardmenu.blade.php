<div class="container-fluid">
    <div class="row">

        <div class="col">
            <a href="{{ url($link_new ?? '#') }}" >
            <div class="card baseBlock h-75" style="cursor:pointer; background: #A91D3A;cursor:pointer">
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
            <div class="card baseBlock h-75" style="background: #FFC55A;cursor:pointer">
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
            <div class="card baseBlock h-75" style="background: rgb(33, 156, 144);cursor:pointer">
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

{{-- <<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a id="newCardLink" href="#">
                <div class="card baseBlock h-75" style="cursor:pointer; background: #A91D3A;">
                    <div class="card-body text-white">
                        <div class="media d-flex" style="position: relative">
                            <div class="media-body text-left">
                                <h3 id="newCardCount"></h3>
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
            <a id="onGoingCardLink" href="#">
                <div class="card baseBlock h-75" style="background: #FFC55A; cursor:pointer;">
                    <div class="card-body text-white">
                        <div class="media d-flex" style="position: relative">
                            <div class="media-body text-left">
                                <h3 id="onGoingCardCount"></h3>
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
            <a id="finishCardLink" href="#">
                <div class="card baseBlock h-75" style="background: rgb(33, 156, 144); cursor:pointer;">
                    <div class="card-body text-white">
                        <div class="media d-flex" style="position: relative">
                            <div class="media-body text-left">
                                <h3 id="finishCardCount">0</h3> <!-- Update this ID if needed -->
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
</div> --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Setup AJAX with CSRF Token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Fetch meeting counts
        $.ajax({
            url: 'meeting-counts', // Ensure this URL is correct
            type: 'GET',
            success: function(data) {
                // Update card counts and links
                $('#newCardCount').text(data.countnew);
                $('#onGoingCardCount').text(data.countongoing);
                $('#newCardLink').attr('href', data.link_new_card);
                $('#onGoingCardLink').attr('href', data.link_onGoing_card);
                $('#finishCardLink').attr('href', data.link_finish_card);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching meeting counts:', error);
            }
        });
    });
</script>

