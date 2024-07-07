@extends('qfd.layouts.master')
@section('content')
<style>
    .adjusted-td {
        width: 200px; /* Atur lebar sesuai dengan kebutuhan Anda */
        padding: 10px; /* Sesuaikan padding jika diperlukan */
        border: 1px solid #ddd; /* Tambahkan border jika diperlukan */
        background-color: #f9f9f9; /* Ubah warna latar belakang jika diperlukan */
        overflow-y: auto; /* Tambahkan scrollbar vertikal jika konten terlalu banyak */
        max-height: 200px; /* Atur tinggi maksimum jika diperlukan */
    }
</style>
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Gantt Activity</h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <!DOCTYPE html>
                <html>
                <head>
                {{-- bootstrap 5 --}}
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
                </head>
                <body>
                <div class="col-12 p-5 table-responsive">
                {{-- Filter Form --}}
                <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control" name="month" id="month">
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="year" id="year">
                                @for ($y = date('Y'); $y >= date('Y') - 10; $y--)
                                    <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Detail Produk</th>
                            <th>Proses</th>
                            <th>Sub Proses</th>
                            <?php 
                                $bulan = request()->get('month', date('n'));
                                $tahun = request()->get('year', date('Y'));

                                // jumlah tanggal bulan yang dipilih
                                $jumlah_tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                $array_is_minggu = array();

                                for ($i=1; $i <= $jumlah_tanggal; $i++) { 
                                    echo "<th>$i</th>";
                                    $array_is_minggu[] = date('N', strtotime($tahun.'-'.$bulan.'-'.$i));
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- INI HARUSNYA DI LOOP (DIMASUKKAN) DALAM PRODUK DETAIL --}}
                        <tr>
                            <td rowspan="12" style="  width: auto; white-space: nowrap; ">  
                                <?php 
                                // Ambil data pertama dari tabel quality_for_delivery
                                $detail = \App\Models\QFD\QualityForDelivery::first();
                                ?>
                                
                                <div>
                                    Customer   : <?php echo htmlspecialchars($detail->customer); ?> <br>
                                    PO Interco : <?php echo htmlspecialchars($detail->po_interco); ?> <br>
                                    Product     : <?php echo htmlspecialchars($detail->product_desc); ?> <br>
                                    Request Delivery : <?php echo htmlspecialchars($detail->reqDelivery); ?> <br>
                                    QTY        : <?php echo htmlspecialchars($detail->qty ); ?> <br>
                                </div>
                                </td>
                            <td>Schedule Incoming</td>
                            <td class="adjusted-td">
                                <?php 
                                // Ambil semua data dari tabel detail_schedule
                                $detailScheduleLine = \App\Models\QFD\DetailScheduleLine::whereMonth('incoming_date', $bulan)
                                    ->whereYear('incoming_date', $tahun)
                                    ->get();
                                
                                // Loop melalui semua data dan tampilkan nama_proses
                                foreach ($detailScheduleLine as $proses) {
                                    echo htmlspecialchars($proses->nama_proses) .'<br>';
                                }
                                ?>
                            </td>
                            <?php 
                                $detailScheduleLines = \App\Models\QFD\DetailScheduleLine::where('id_detail_meeting', 1)
                                    ->whereMonth('incoming_date', $bulan)
                                    ->whereYear('incoming_date', $tahun)
                                    ->first();
                                if ($detailScheduleLines) {
                                    $incoming_date = $detailScheduleLines->incoming_date;
                                    // ambil tanggal saja dan hilangkan 0 di depan angka
                                    $incoming_date = ltrim(date('d', strtotime($incoming_date)), '0');
                                    $end_date = $detailScheduleLines->end_date;
                                    // ambil tanggal saja dan hilangkan 0 di depan angka
                                    $end_date = ltrim(date('d', strtotime($end_date)), '0');
                                    $day = 1;
                                    for ($i=1; $i <= $jumlah_tanggal; $i++) { 
                                        if ($i >= $incoming_date && $i <= $end_date) {
                                            // jika hari minggu maka warna merah
                                            if ($array_is_minggu[$i-1] == 7) {
                                                echo "<td data-id='{$proses->id}' data-bs-toggle='tooltip' data-bs-html='true' title='Loading...' style='background-color: #51829B; cursor: pointer;'></td>";
                                            } else {
                                                echo "<td data-id='{$proses->id}' data-bs-toggle='tooltip' data-bs-html='true' title='Loading...' style='background-color: #51829B; cursor: pointer;'></td>";
                                            }
                                            $day++;
                                        } else {
                                            if ($array_is_minggu[$i-1] == 7) {
                                                echo "<td style='background-color: #ff0000'></td>";
                                            } else {
                                                echo "<td></td>";
                                            }
                                        }
                                    }
                                }
                            ?>
                        </tr>
                        <tr>
                            <td>Schedule Line Production</td>
                            <td class="adjusted-td">
                                <?php 
                                // Ambil semua data dari tabel detail_schedule_pb_finish
                                $detailScheduleLineProduct= \App\Models\QFD\DetailScheduleLineProduksi::whereMonth('start_date', $bulan)
                                    ->whereYear('start_date', $tahun)
                                    ->get();
                                
                                // Loop melalui semua data dan tampilkan nama_proses
                                foreach ($detailScheduleLineProduct as $proses) {
                                    echo htmlspecialchars($proses->nama_proses) . '<br>'; 
                                }
                                ?>
                            </td>
                            <?php 
                                $detailScheduleLineProduksis = \App\Models\QFD\DetailScheduleLineProduksi::where('id_detail_meeting', 3)
                                    ->whereMonth('start_date', $bulan)
                                    ->whereYear('start_date', $tahun)
                                    ->first();
                                if ($detailScheduleLineProduksis) {
                                    $start_date = $detailScheduleLineProduksis->start_date;
                                    // ambil tanggal saja dan hilangkan 0 di depan angka
                                    $start_date = ltrim(date('d', strtotime($start_date)), '0');
                                    $end_date = $detailScheduleLineProduksis->finish_date;
                                    // ambil tanggal saja dan hilangkan 0 di depan angka
                                    $end_date = ltrim(date('d', strtotime($end_date)), '0');
                                    $day = 1;
                                    for ($i=1; $i <= $jumlah_tanggal; $i++) { 
                                        if ($i >= $start_date && $i <= $end_date) {
                                            // jika hari minggu maka warna merah
                                            if ($array_is_minggu[$i-1] == 7) {
                                                echo "<td data-id='{$proses->id}' data-bs-toggle='tooltip' data-bs-html='true' title='Loading...' style='background-color: #51829B; cursor: pointer;'></td>";
                                            } else {
                                                echo "<td data-id='{$proses->id}' data-bs-toggle='tooltip' data-bs-html='true' title='Loading...' style='background-color: #51829B; cursor: pointer;'></td>";
                                            }
                                            $day++;
                                        } else {
                                            if ($array_is_minggu[$i-1] == 7) {
                                                echo "<td style='background-color: #ff0000'></td>";
                                            } else {
                                                echo "<td></td>";
                                            }
                                        }
                                    }
                                }
                            ?>
                        </tr>
                        <tr>
                            <td>Schedule PB Finish</td>
                            <td class="adjusted-td">
                                <?php 
                                // Ambil semua data dari tabel detail_schedule_pb_finish
                                $detailProsesPbFinishes = \App\Models\QFD\DetailSchedulePbFinish::whereMonth('start_date', $bulan)
                                    ->whereYear('start_date', $tahun)
                                    ->get();
                                
                                // Loop melalui semua data dan tampilkan nama_proses
                                foreach ($detailProsesPbFinishes as $proses) {
                                    echo htmlspecialchars($proses->nama_proses) . '<br>';
                                }
                                ?>
                            </td>
                            
                            <?php 
                                $detailSchedulePbFinishes = \App\Models\QFD\DetailSchedulePbFinish::where('id_detail_meeting', 1)
                                    ->whereMonth('start_date', $bulan)
                                    ->whereYear('start_date', $tahun)
                                    ->first();
                                if ($detailSchedulePbFinishes) {
                                    $start_date = $detailSchedulePbFinishes->start_date;
                                    // ambil tanggal saja dan hilangkan 0 di depan angka
                                    $start_date = ltrim(date('d', strtotime($start_date)), '0');
                                    $end_date = $detailSchedulePbFinishes->finish_date;
                                    // ambil tanggal saja dan hilangkan 0 di depan angka
                                    $end_date = ltrim(date('d', strtotime($end_date)), '0');
                                    $day = 1;
                                    for ($i=1; $i <= $jumlah_tanggal; $i++) { 
                                        if ($i >= $start_date && $i <= $end_date) {
                                            // jika hari minggu maka warna merah
                                            if ($array_is_minggu[$i-1] == 7) {
                                                echo "<td data-id='{$proses->id}' data-bs-toggle='tooltip' data-bs-html='true' title='Loading...' style='background-color: #51829B; cursor: pointer;'></td>";
                                            } else {
                                                echo "<td data-id='{$proses->id}' data-bs-toggle='tooltip' data-bs-html='true' title='Loading...' style='background-color: #51829B; cursor: pointer;'></td>";
                                            }
                                            $day++;
                                        } else {
                                            if ($array_is_minggu[$i-1] == 7) {
                                                echo "<td style='background-color: #ff0000'></td>";
                                            } else {
                                                echo "<td></td>";
                                            }
                                        }
                                    }
                                }
                            ?>
                        </tr>
                        {{-- BATASNYA --}}
                    </tbody>
                </table>
                </div>

                {{-- jquery --}}
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                {{-- bootstrap 5 --}}
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
                {{-- Script untuk handle klik dan tampilkan tooltip --}}
                <script>
                    $(document).ready(function(){
                        var tooltipElements = $('[data-bs-toggle="tooltip"]');
                        tooltipElements.each(function() {
                            var id = $(this).data('id');
                            var element = $(this);
                            // Panggil AJAX untuk mendapatkan detail
                            $.ajax({
                                url: '/getDetail/' + id,
                                type: 'GET',
                                success: function(data){
                                    element.attr('title', data).tooltip('dispose').tooltip(); // Update tooltip content
                                },
                                error: function(xhr, status, error){
                                    console.error(xhr.responseText);
                                }
                            });
                        });

                        tooltipElements.tooltip();
                    });
                </script>
                <script>
                    $(document).ready(function(){
                        var tooltipElements = $('[data-bs-toggle="tooltip"]');
                        tooltipElements.each(function() {
                            var id = $(this).data('id');
                            var element = $(this);
                            // Panggil AJAX untuk mendapatkan detail
                            $.ajax({
                                url: '/getDetail/' + id,
                                type: 'GET',
                                success: function(data){
                                    element.attr('title', data).tooltip('dispose').tooltip(); // Update tooltip content
                                },
                                error: function(xhr, status, error){
                                    console.error(xhr.responseText);
                                }
                            });
                        });
                
                        tooltipElements.tooltip();
                    });
                </script>
                </body>
                </html>
            </div>
        </div>
    </div>
</div>
@endsection
