<div>
@include('livewire.admin.brands.modal-form')

<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="car-header">
                    <h3>
                        <h3>Brand List <a data-bs-toggle="modal" data-bs-target="#addbrandModal" class="btn btn-primary float-end btn-sm">Add Brand</a>
                        </h3>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        
                            <thead class="col-md-3">
                                <tr>
                                    <th><b>Id</b></th>
                                    <th><b>Name</b></th>
                                    <th><b>Slug</b></th>
                                    <th><b>Status</b></th>                               
                                </tr>
                            </thead>
                        
                        <tbody>
                            @foreach($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td>{{ $brand->status == 1 ? 'hidden':'visible' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>    
</div>
</div>

@push('script')
<script>
    window.addEventListener('close-modal', event => {
        $('#addbrandModal').modal('hide');
    });
</script>
@endpush