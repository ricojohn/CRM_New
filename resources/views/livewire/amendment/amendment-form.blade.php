<div class="card" >
    <div class="card-body bg-primary ">
      <div class="row">
        <div class="col-md-12 ">
          <h4 class="text-white card-title">
            Request Amendment
          </h4>
        </div>
      </div>
    </div>
    <div class="card-body">
      <form wire:submit="save">
        <div class="mb-4 row">
          <label for="datetoday" class="col-md-2 col-form-label">Activity:</label>
          <div class="col-md-10">
            <select class="form-control" wire:model='activity'>
              <option value="">--</option>
              <option value="Working">Working</option>
              <option value="Ovetime">Ovetime</option>
            </select>
            @error('activity')
              <div class="error">
                {{ $message }} 
              </div>
            @enderror
          </div>
        </div>
        <div class="mb-4 row">
          <label for="datetoday" class="col-md-2 col-form-label">Date:</label>
          <div class="col-md-10">
            <input type="text" id="datepicker" class="form-control" wire:model='date'>
            @error('date')
              <div class="error">
                {{ $message }} 
              </div>
            @enderror
          </div>
        </div>
        <div class="mb-4 row">
          <label for="startTime" class="col-md-2 col-form-label">Start:</label>
          <div class="col-md-10">
            <input id="startTime" class="form-control" type="text" wire:model='startTime'>
            @error('startTime')
              <div class="error">
                {{ $message }} 
              </div>
            @enderror
          </div>
        </div>
        <div class="mb-4 row">
          <label for="endTime" class="col-md-2 col-form-label">End:</label>
          <div class="col-md-10">
            <input id="endTime" class="form-control" type="text" wire:model='endTime'>
            @error('endTime')
              <div class="error">
                {{ $message }} 
              </div>
            @enderror
          </div>
        </div>
        <div class="mb-6 row">
          <label class="col-sm-2 col-form-label" for="basic-default-message">Reason</label>
          <div class="col-sm-10">
            <textarea id="basic-default-message" class="form-control" placeholder="" aria-describedby="basic-icon-default-message2" rows="4" cols="50" wire:model='reason'></textarea>
            @error('reason')
              <div class="error">
                {{ $message }} 
              </div>
            @enderror
          </div>
        </div>
        <div class="mb-6 row">
          <label class="col-sm-2 col-form-label" for="basic-default-message">Add Attachment</label>
          <div class="input-group col-sm-10">
            <label class="input-group-text" for="inputGroupFile01">Upload</label>
            <input type="file" class="form-control" id="inputGroupFile01" wire:model='attachment'>
          </div>
          <div class="col-sm-2">
          </div>
          <div class="col-sm-10">
            @error('attachment')
              <div class="error">
                {{ $message }} 
              </div>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary">
              Send
              <div wire:loading>
              </div>
            </button>
          </div>
        </div>
      </form>
    </div>
</div>

<script type="text/javascript">
  //Initialize flatpick datetimepicker for saleStart and saleEnd
  $("#datepicker").flatpickr({
    dateFormat: "m-d-Y",
    // enableSeconds: true,
    static: true
  });
  $("#startTime, #endTime").flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
  });
</script>



