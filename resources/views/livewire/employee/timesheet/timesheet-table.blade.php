<div  class="mb-12 row g-6">
    <div class="col-12">
        <div class="card">
            <form wire:submit="updateTimeSheet">
                <div class="card-body">
                    <div class="row justify-content-start">
                        <div class="col-md-2"> <!-- Adjusted column width to 4 -->
                            <label>Salary Date Start</label>
                            <input type="text" class="form-control" wire:model="search_date" id="search_date">
                        </div>
                        <div class="col-md-1">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="text-center table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="table-light">
                                <td><small>Name</small></td>
                                <td><small>Position</small></td>
                                @foreach ($days as $day)
                                    <td><small>{{ $day }}</small></td>
                                @endforeach
                                <td><small>Required Weekly Hours</small></td>
                                <td><small>Total Hours</small></td>
                            </tr>
                            <tr class="table-dark">
                                <td></td>
                                <td></td>
                                @foreach ($headers as $date)
                                    <td><small>{{ $date }}</small></td>
                                @endforeach
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach ($timesheet as $employee)
                                <tr>
                                    <td><small>{{ $employee['name'] }}</small></td>
                                    <td><small>{{ $employee['position'] }}</small></td>
                                    {{-- @foreach ($employee['data'] as $hours) --}}
                                        <td class="highlight"></td>
                                    {{-- @endforeach --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
// window.addEventListener('search_date', event => {
//     //Initialize flatpick datetimepicker for saleStart and saleEnd
//     let searchInput = document.getElementById("search_date");
//     if (searchInput._flatpickr) {
//         searchInput._flatpickr.destroy(); // Destroy previous instance
//     }
//     searchInput.flatpickr({
//         dateFormat: "Y-m-d",
//         static: true
//     });
// });     
window.addEventListener('search_date', event => {
    setTimeout(() => {
        let searchInput = document.getElementById("search_date");
        if (!searchInput) return; // Prevent errors if element is missing
        if (searchInput._flatpickr) searchInput._flatpickr.destroy();
        searchInput.flatpickr({ dateFormat: "Y-m-d", static: true });
    }, 300); // Small delay to ensure DOM is ready
});
</script>
