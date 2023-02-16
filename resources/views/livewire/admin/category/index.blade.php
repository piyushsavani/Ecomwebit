<div class="container">@if(session('message'))
        <div style="color: green;" alert alert-success> {{ session('message') }} </alert-success>
        @endif
      </div>
<div>
  
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form wire:submit.prevent="destroyCategory">
      <div class="modal-body">
        are you sure want to delete it ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Yes. Delete</button>
      </div>
      </form>

    </div>
  </div>
</div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4> Category <a class="btn btn-primary float-end" href="{{ url('admin/add-category') }}"> Add Category
                    </a> </h4>
            </div>
            <div class="card-body">
                <table class='table'>
                    <thead>
                        <tr>
                            <td>id</td>
                            <td>name</td>
                            <td>status</td>
                            <td>Action</td>
                        </tr>
                    </thead>

                    @foreach($categories as $category)       
                    <tr>
                        <td>{{$category['id']}}</td>
                        <td>{{$category['name']}}</td>
                        <td>{{$category['status'] == 1? 'hidden':'Visible' }}</td>
                        <td> <a href="{{ url('admin/category/'.$category->id) }}" class="btn btn-success"> Edit </a>
                             <a href="#" wire:click="deleteCategory({{ $category->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger"> Delete </a>
                        </td>
                    </tr>
                    @endforeach     
                
                </table>           
            </div>
            {{$categories->links()}}
            </div>
        </div>
    </div>
    <!-- <script>
    $(document).ready(function() {
    $("#exampleModal").modal();
  });
  </script> -->
</div>

