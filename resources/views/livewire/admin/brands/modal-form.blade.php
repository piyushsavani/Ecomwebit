<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addbrandModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>

      <form wire:submit.prevent="saveBrand">

        <div class="modal-body">
          <div class="col-md-12 mb-3">
            <label for="id">Name</label>
            <input type="text" wire:model.defer="name" class="form-control">
          </div>

          <div class="col-md-12 mb-3">
            <label for="id">Slug</label>
            <input type="text" wire:model.defer="slug" class="form-control">
          </div>
          <div class="col-md-12 mb-3"><br>
            <label for="id">status</label>
            <input type="checkbox" wire:model.defer="status"> checked:hidden, Un-checked:visible
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>


      </form>
    </div>
  </div>
</div>