<!DOCTYPE html>
<html>
<head>
    <title>Activity Calendar</title>
    <style>
        .planning { background-color: lightblue; }
        .actual { background-color: lightgreen; }
        .both { background-color: lightseagreen; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid black; padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Product Number</th>
                <th>Due Date</th>
                <th>18</th>
                <th>19</th>
                <th>20</th>
                <th>21</th>
                <th>22</th>
                <th>23</th>
                <th>24</th>
                <!-- Tambahkan header tanggal sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            @foreach ($activities as $activity)
                <tr>
                    <td>{{ $activity->product_number }}</td>
                    <td>{{ $activity->due_date }}</td>
                    @for ($day = 18; $day <= 24; $day++) <!-- Sesuaikan rentang tanggal -->
                        @php
                            $class = '';
                            if ($activity->planning) $class = 'planning';
                            if ($activity->actual) $class = 'actual';
                            if ($activity->planning && $activity->actual) $class = 'both';
                        @endphp
                        <td class="{{ $class }}">{{ $activity->due_date->day == $day ? 'P' : '' }}</td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
