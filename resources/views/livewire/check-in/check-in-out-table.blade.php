<div class="card">
    <h5 class="card-header">Check In & Outs</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Hours</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($records as $record)
                <tr>
                <td>{{ $record->date }}</td>
                <td>{{ $record->check_in_time }}</td>
                <td>{{ $record->check_out_time }}</td>
                @php
                    $check_in_time = $record->check_in_time;
                    $checkouttime = $record->dateout . " " . $record->check_out_time;
                    $checkintime = "";
                    $diff_in_hours = "";


                    // Check if check_in_time is not empty
                    if ($record->check_out_time != "") {
                        // Combine date and check-in time to create a full datetime string
                        $checkintime = $record->date . " " . $check_in_time;

                        // Parse the check-in and check-out times using Carbon
                        $start = \Carbon\Carbon::createFromFormat("m-d-Y H:i:s", $checkintime);
                        $end = \Carbon\Carbon::createFromFormat("m-d-Y H:i:s", $checkouttime);

                        // Check if both times are valid
                        if ($start && $end) {
                            // Calculate the difference in seconds
                            $diff = $end->diff($start);
                            $diff_in_seconds = $diff->s + ($diff->i * 60) + ($diff->h * 3600) + ($diff->days * 86400);

                            if ($diff_in_seconds > 0) {
                                // Calculate hours, minutes, and seconds
                                $hours = floor($diff_in_seconds / 3600);
                                $minutes = floor(($diff_in_seconds % 3600) / 60);
                                $seconds = $diff_in_seconds % 60;

                                // Format the difference as hours:minutes:seconds
                                $diff_in_hours = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
                            }
                        }
                    }
                @endphp
                <td>
                    {{$diff_in_hours}}
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-5 d-flex justify-content-center">
            {{ $records->links() }}
        </div>
    </div>
</div>