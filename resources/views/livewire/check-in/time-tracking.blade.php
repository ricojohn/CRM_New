<div class="card" >
    <div class="card-body bg-primary ">
      <div class="row">
        <div class="col-md-6 ">
          <h4 class="text-white card-title">
            Online Time Tracker
          </h4>
        </div>
        <div class="col-md-6 ">
          <h4 style="text-align: right;">
            <a href="{{route('recording.record')}}" target="_blank" class="nav-link">
            <button class="btn btn-danger">
                <i class="nav-icon fa fa-camera" aria-hidden="true"></i>&nbsp;
                Start Recording
            </button>
            </a>
          </h4>
        </div>
      </div>
    </div>
    <div class="card-body">
      {{-- <form id="timeForm" method="POST"> --}}
        <p id="time"></p>
        <div class="mb-4 row">
          <label for="datetoday" class="col-md-2 col-form-label">Date:</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="datetoday" name="datetoday" value="{{ $datetoday }}" readonly>
          </div>
        </div>
        <div class="mb-4 row">
          <label for="timeIn" class="col-md-2 col-form-label">Time In:</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="timeIn" name="timeIn" value="{{ $timeTracking ? $timeTracking->check_in_time : '' }}" readonly>
          </div>
        </div>
        <div class="mb-4 row">
          <label for="timeOut" class="col-md-2 col-form-label">Time Out:</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="timeOut" name="timeOut" value="{{ $timeTracking ? $timeTracking->check_out_time : '' }}" readonly>
          </div>
        </div>
        <div class="text-center">
            <input 
              type="button" 
              class="btn btn-success {{$checkinbtn}}" 
              value="Time In" 
              name="check_in" 
              id="check_in" 
              wire:click="checkIn"
              >
            
            <input 
              type="button" 
              class="btn btn-danger {{$checkoutbtn}}" 
              value="Time Out"
              name="check_out" 
              wire:click="checkOut({{$timeTracking ? $timeTracking->id : ''}})"
              onclick="return confirm('Are you sure you want to check out?')" 
              >
        </div>
      {{-- </form> --}}
    </div>
</div>
<script>
    function displayTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        
        // Adding leading zeros if necessary
        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;
        seconds = (seconds < 10 ? "0" : "") + seconds;
  
        // Formatting the time
        var timeString = "Today: {{$datenow}} "  +hours + ":" + minutes + ":" + seconds;
  
        // Displaying the time in the 'time' element
        document.getElementById("time").innerHTML = timeString;
    }
  
    // Calling the displayTime function every second to update the time
    setInterval(displayTime, 1000);
  
    // Displaying the time when the page loads
    displayTime();
</script>
<script>
    const toastPlacementExample = document.querySelector('.toast-placement-ex'), toastPlacementBtn = document.querySelector('#showToastPlacement'), toastbody = document.querySelector('.toast-body');
    let selectedType, selectedPlacement, toastPlacement;

    // Dispose toast when open another
    function toastDispose(toast) {
        if (toast && toast._element !== null) {
        if (toastPlacementExample) {
            toastPlacementExample.classList.remove(selectedType);
            DOMTokenList.prototype.remove.apply(toastPlacementExample.classList, selectedPlacement);
        }
        toast.dispose();
        }
    }
    
    window.addEventListener('query', event => {
         // Get the data from the event (which was passed as an object)
        let status = event.__livewire.params[0].status;  
        let message = event.__livewire.params[0].message; 
        let check = event.__livewire.params[0].check; 

        selectedType = status;  // Choose the success type class you want
        selectedPlacement = ['top-0', 'start-50', 'translate-middle-x'];  // You can modify placement as needed

        toastbody.textContent = message;
        toastPlacementExample.classList.add(selectedType);
        DOMTokenList.prototype.add.apply(toastPlacementExample.classList, selectedPlacement);
        toastPlacement = new bootstrap.Toast(toastPlacementExample);
        toastPlacement.show();

        // Add delay after showing the toast
        if(check == 'in'){
          if (status == 'bg-success') {
            // Delay window.open after the toast has shown (e.g., 2 seconds)
            setTimeout(() => {
                window.open("https://q8marketingcrm.com/record/", "_blank");
            }, 2000);  // Adjust 3000 for your desired delay
          }
        }
    });
</script>

