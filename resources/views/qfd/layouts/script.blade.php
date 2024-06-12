<!-- Fonts and icons -->
<script src="{{asset('qfd/assets/js/plugin/webfont/webfont.min.js')}}"></script>

<script>
    WebFont.load({
        google: {"families":["Lato:300,400,700,900"]},
        custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{ asset('qfd/assets/css/fonts.min.css') }}"]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>

{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
<!-- Initialize Select2 and Add Change Event Handler -->

<!--   Core JS Files   -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="{{asset('qfd/assets/js/core/jquery.3.2.1.min.js')}}"></script> --}}
<script src="{{asset('qfd/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('qfd/assets/js/core/bootstrap.min.js')}}"></script>


<!-- jQuery UI -->
<script src="{{asset('qfd/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('qfd/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('qfd/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>


<!-- Chart JS -->
<script src="{{asset('qfd/assets/js/plugin/chart.js/chart.min.js')}}"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('qfd/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Chart Circle -->
<script src="{{asset('qfd/assets/js/plugin/chart-circle/circles.min.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('qfd/assets/js/plugin/datatables/datatables.min.js')}}"></script>
<script >
$(document).ready(function() {
    $('#basic-datatables').DataTable({
    });

    $('#multi-filter-select').DataTable( {
        "pageLength": 5,
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select class="form-control"><option value=""></option></select>')
                .appendTo( $(column.footer()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                        );

                    column
                    .search( val ? '^'+val+'$' : '', true, false )
                    .draw();
                } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    });

    // Add Row
    $('#add-row').DataTable();

    var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    // $('#addRowButton').click(function() {
    // 	$('#add-row').dataTable().fnAddData([
    // 		$("#addName").val(),
    // 		$("#addPosition").val(),
    // 		$("#addOffice").val(),
    // 		action
    // 		]);
    // 	$('#addRowModal').modal('hide');

    // });
});
</script>

<!-- Custom Theme Scripts -->
{{-- <script src="{{ asset('assets/build/js/custom.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/select2.min.js') }}"></script> --}}



<script>
    function roundToNearest10Minutes() {
    const input = document.getElementById('datetimeInput');
    if (input.value) {
        const date = new Date(input.value);
        const roundedMinutes = Math.round(date.getMinutes() / 10) * 10;
        date.setMinutes(roundedMinutes);
        input.value = date.toISOString().slice(0, -8); // Remove seconds and milliseconds
    }
    }
</script>

<!-- Bootstrap Notify -->
<script src="{{asset('qfd/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<!-- jQuery Vector Maps -->
{{-- <script src="{{asset('qfd/assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('qfd/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script> --}}

<!-- Sweet Alert -->
<script src="{{asset('qfd/assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
{{-- flatpickr --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- include libraries(jQuery, bootstrap) -->
{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}

<!-- include summernote css/js -->
{{-- <script src="{{asset('assets/js/summernote-bs4.min.js')}}"></script> --}}


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.select2').select2({
        placeholder: 'Select an option',
           width: '100%'

    });

    
    $('.select2-multiple').select2({
           width: '100%'
    
    });

    
</script>
<script>
    flatpickr('.datetimepicker', {
        enableTime: true,
        minDate: "today",
        dateFormat: 'd/m/Y H:i', // Adjust the date and time format as needed
        // Additional configuration options can be added here
    });
    
    flatpickr('.datepicker', {
        minDate: "today",
        dateFormat: 'd/m/Y ', // Adjust the date and time format as needed
        // Additional configuration options can be added here
    });

    flatpickr('.datereqdev', {
        minDate: "today",
        dateFormat: 'd-m-Y ', // Adjust the date and time format as needed
        // Additional configuration options can be added here
    });

    flatpickr('.datetimepickerrange', {
        mode :"range",
    
        minDate: "today",
        dateFormat: 'd-m-Y ', // Adjust the date and time format as needed
        // Additional configuration options can be added here
    });


</script>




<!-- Atlantis JS -->
<script src="{{asset('qfd/assets/js/atlantis.min.js')}}"></script>


<!-- Atlantis DEMO methods, don't include it in your project! -->
{{-- <script src="{{asset('qfd/assets/js/setting-demo.js')}}"></script>
<script src="{{asset('qfd/assets/js/demo.js')}}"></script>
<script>
    Circles.create({
        id:'circles-1',
        radius:45,
        value:60,
        maxValue:100,
        width:7,
        text: 5,
        colors:['#f1f1f1', '#FF9E27'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-2',
        radius:45,
        value:70,
        maxValue:100,
        width:7,
        text: 36,
        colors:['#f1f1f1', '#2BB930'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-3',
        radius:45,
        value:40,
        maxValue:100,
        width:7,
        text: 12,
        colors:['#f1f1f1', '#F25961'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

    var mytotalIncomeChart = new Chart(totalIncomeChart, {
        type: 'bar',
        data: {
            labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
            datasets : [{
                label: "Total Income",
                backgroundColor: '#ff9e27',
                borderColor: 'rgb(23, 125, 255)',
                data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        display: false //this will remove only the label
                    },
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }],
                xAxes : [ {
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }]
            },
        }
    });

    $('#lineChart').sparkline([105,103,123,100,95,105,115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });
</script> --}}