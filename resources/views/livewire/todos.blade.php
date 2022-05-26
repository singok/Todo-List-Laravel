<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            <div class="p-6 bg-white border-b border-gray-200">
                <span style="float: left">
                    <button wire:click.prevent="showForm" type="button" class="btn btn-primary" style="padding: 5px 15px">Add</button>
                </span>
                <div class="btn-group btn-group-toggle mb-4" style="float: right" data-toggle="buttons">
                    <label class="btn btn-secondary active">
                        <input type="radio" name="options" id="option1" autocomplete="off" checked>All
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" name="options" id="option2" autocomplete="off">Completed
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" name="options" id="option3" autocomplete="off">Incompleted
                    </label>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th></th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col" style="text-align:center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td style="text-align:center">
                            <a href="" style="color:black"><i class="fa-solid fa-check fa-xl" onmouseover="this.style.color='green'" onmouseout="this.style.color='black'"></i></a>
                            <a href="" style="color:black"><i class="fa-solid fa-pen-to-square fa-lg mx-2" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'"></i></a>
                            <a href="" style="color:black"><i class="fa-solid fa-trash fa-lg" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'"></i></a>
                        </td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- insert modal -->
    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><b>New Task</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Name:</label>
                  <input wire:model.defer="name" type="text" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Description:</label>
                  <textarea wire:model.defer="description" class="form-control" id="message-text"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button wire:click.prevent="addTask" type="button" class="btn btn-primary">Add</button>
            </div>
          </div>
        </div>
      </div>

    @push('script')
        <script type="text/javascript">

            // show employee add form
            window.addEventListener('show-addForm', event => {
                $('#addForm').modal('show');
            });
        </script>
    @endpush
</div>
