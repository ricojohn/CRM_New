<div class="card">
    <h5 class="card-header">Recordings</h5>
    <div class="card-body">
        @foreach ($recordings as $date => $records)
            <label>{{ $date }}</label>
            <div class="flex-wrap d-flex">
                @foreach ($records as $record)
                    <a href="https://q8marketingcrm.com/record/uploads/{{ $record->filename }}" target="_blank" class="m-3">
                        <div class="">
                            <img src="https://q8marketingcrm.com/record/playbtn.png" style="width:80px; height:80px;">
                        </div>
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
    
</div>