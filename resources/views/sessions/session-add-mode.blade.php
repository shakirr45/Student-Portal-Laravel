<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" enctype="multipart/form" id="exampleModal">
    @csrf
    

    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">Add Session</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="errmsg my-2">

            </div>
           <div class="form-group">

            <label for="session">Session : </label>
            <input type="text" class="form-control" id="session" name="session" placeholder="Enter Session. Ex(2024-2025)" required><br>
            
            <label for="session_year">Session Current Year : </label>
            <input type="text" class="form-control" id="session_year" name="session_year" placeholder="Enter Session Current Year. Ex(2024)" required>

           </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary add_session">Save Session</button>
          </div>
        </div>
      </div>

    </form>
    
  </div>