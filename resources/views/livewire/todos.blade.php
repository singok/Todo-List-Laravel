<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
            <div class="p-6 bg-white border-b border-gray-200" style="overflow-x: auto; overflow-y:hidden">
                
                <span style="float: left">
                    <button id="add-button" type="button" class="btn btn-primary" style="padding: 5px 15px"><i class="fa-solid fa-plus" style="color: white"></i>&nbsp;&nbsp;ADD TASK</button>
                </span>
                <div class="btn-group btn-group-toggle mb-4" style="float: right" data-toggle="buttons">
                    <label class="allTask btn btn-secondary active">
                        <input wire:model="option" type="radio" id="allTask" autocomplete="off" checked>All
                    </label>
                    <label class="completeTask btn btn-secondary">
                        <input wire:model="option" type="radio" value="complete" id="completeTask" autocomplete="off">Complete
                    </label>
                    <label class="incompleteTask btn btn-secondary">
                        <input wire:model="option" type="radio" value="incomplete" id="incompleteTask" autocomplete="off">Incomplete
                    </label>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th></th>
                        <th scope="col">Description</th>
                        <th scope="col" style="text-align:center">Status</th>
                        <th scope="col" style="text-align:center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($data as $info)
                            <tr>
                                <th scope="row">{{ $count++ }}</th>
                                <td>{{ $info->name }}</td>
                                <td>{{ $info->description }}</td>
                                <td>
                                    @if ($info->status == "Incomplete")
                                        <div style='color:black; background: rgb(230, 223, 165); border-radius:20px; text-align:center'>{{ $info->status }}</div>
                                    @elseif ($info->status == "Complete")
                                        <div style='color:black; background: rgb(168, 212, 168); border-radius:20px; text-align:center'>{{ $info->status }}</div>
                                    @endif
                                </td>
                                <td style="text-align:center">
                                    @if ($info->status == "Incomplete")
                                        <a href="" wire:click.prevent="changeStatusToComplete('{{ $info->id }}')" style="color:black"><i class="fa-regular fa-square fa-xl" onmouseover="this.style.color='green'" onmouseout="this.style.color='black'"></i></a>
                                    @elseif ($info->status == "Complete")
                                        <a href="" wire:click.prevent="changeStatusToIncomplete('{{ $info->id }}')" style="color:black"><i class="fa-regular fa-square-check fa-xl" onmouseover="this.style.color='orange'" onmouseout="this.style.color='black'"></i></a>
                                    @endif
                                    <a href="" wire:click.prevent="showUpdateForm('{{ $info->id }}')" style="color:black"><i class="fa-solid fa-pen fa-lg mx-3" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'"></i></a>
                                    <a href="" wire:click.prevent="deleteTask('{{ $info->id }}')" style="color:black"><i class="fa-solid fa-trash fa-lg" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                
            </div>
            <div>
                {{ $data->links() }}
            </div>
        </div>
    </div>

    <!-- insert modal -->
    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><b>New Task</b></h5>
              <button id="add-cross-button" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="addTaskDetail">
                <div class="form-group">
                  <label for="task-name" class="col-form-label">Name:</label>
                  <input wire:model.defer="name" type="text" class="form-control" id="task-name">
                  <div class="invalid-feedback">
                    Please, fill this field !!!
                  </div>
                </div>
                <div class="form-group">
                  <label for="detailed-text" class="col-form-label">Description:</label>
                  <textarea wire:model.defer="description" class="form-control" id="detailed-text"></textarea>
                  <div class="invalid-feedback">
                    Please, fill this field !!!
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button id="add-close-button" type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark fa-lg"></i>&nbsp;&nbsp;Close</button>
              <button wire:click.prevent="addTask" type="button" class="btn btn-primary"><i class="fa-solid fa-check fa-lg"></i>&nbsp;&nbsp;Add</button>
            </div>
          </div>
        </div>
      </div>

    <!-- update form modal -->
    <div class="modal fade" id="updateForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><b>Edit Task</b></h5>
              <button wire:click.prevent="closeUpdateForm" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Name:</label>
                  <input wire:model.defer="updateName" type="text" class="form-control" id="recipient-name">
                  <div class="invalid-feedback">
                    Please, fill this field !!!
                  </div>
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Description:</label>
                  <textarea wire:model.defer="updateDescription" class="form-control" id="message-text"></textarea>
                  <div class="invalid-feedback">
                    Please, fill this field !!!
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button wire:click.prevent="closeUpdateForm" type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark fa-lg"></i>&nbsp;&nbsp;Close</button>
              <button wire:click.prevent="updateTask" type="button" class="btn btn-primary"><i class="fa-solid fa-floppy-disk fa-lg"></i>&nbsp;&nbsp;Update</button>
            </div>
          </div>
        </div>
      </div>

    @push('script')
        <script type="text/javascript">

            $(document).ready(function() {
                toastr.options = {
                        "progressBar" : true,
                        "positionClass" : "toast-top-right",
                    };

            });

            // category status select
            window.addEventListener('select-all', event => {
                $('.allTask').addClass('active');
                $('.completeTask').removeClass('active');
                $('.incompleteTask').removeClass('active');
            });
            window.addEventListener('select-incomplete', event => {
                $('.incompleteTask').addClass('active');
                $('.allTask').removeClass('active');
                $('.completeTask').removeClass('active');
            });
            window.addEventListener('select-complete', event => {
                $('.completeTask').addClass('active');
                $('.allTask').removeClass('active');
                $('.incompleteTask').removeClass('active');
            });

            $('#add-button').on('click', function() {
                $('#addForm').modal('show');
            });

            $('#add-cross-button, #add-close-button').on('click', function () {
                $('#addForm').modal('hide');
            });
            
            // display add success message
            window.addEventListener('add-success', event => {
                $('#addForm').modal('hide');
                toastr.success(event.detail.message);
            });

            // display add error message
            window.addEventListener('add-failure', event => {
                $('#addForm').modal('hide');
                toastr.error(event.detail.message);
            });

            // display mark as complete
            window.addEventListener('mark-complete', event => {
                toastr.success(event.detail.message);
            });
            window.addEventListener('mark-incomplete', event => {
                toastr.warning(event.detail.message);
            });

            // display delete modal
            window.addEventListener('task-delete', event => {
                toastr.error(event.detail.message);
            });

            // display update form
            window.addEventListener('update-form', event => {
                $('#updateForm').modal('show');
            });

            // close update form
            window.addEventListener('update-form-close', event => {
                $('#updateForm').modal('hide');
            });

            // display success message
            window.addEventListener('update-success', event => {
                $('#updateForm').modal('hide');
                toastr.success(event.detail.message);
            });

        </script>
    @endpush
</div>
