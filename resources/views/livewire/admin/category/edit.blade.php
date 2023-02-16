<div class="row">
    <div class="col-md-12">
        @if(session('message'))
        div.alert <alert-success> {{ session('message') }} </alert-success>
        @endif
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
                             <a href=" " class="btn btn-danger"> Delete </a>
                        </td>
                    </tr>
                    @endforeach     
                
                </table>           
            </div>
            {{$categories->links()}}
            </div>
        </div>
    </div>
</div>

