<x-admin-master>
    @section('content')

        @if (Session::has('permission-deleted-message'))
            <div class="alert alert-danger">{{ Session::get('permission-deleted-message') }}</div>
        @elseif (Session::has('permission-created-message'))
            <div class="alert alert-success">{{ Session::get('permission-created-message') }}</div>
        @elseif (Session::has('permission-updated-message'))
            <div class="alert alert-success">{{ Session::get('permission-updated-message') }}</div>
        @endif
        
        <div class="row">
            <div class="col-sm-3">
                <h1>Create a Permission</h1>
                <form method="POST" action="{{ route('permission.store') }}" >
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Enter name" id="name">
                        <div>
                            @error('name')
                                <span><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit"  class="btn btn-primary">Create Permission</button>
                </form>
            </div>

            <div class="col-sm-9">
                
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="permissions-table" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Name</th>
                              <th>Slug</th>
                              <th>Delete</th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Delete</th>
                            </tr>
                          </tfoot>
                          <tbody>
                            @foreach ($permissions as $permission )
            
                              <tr>
                                <td>{{ $permission->id }}</td>
                                <td><a href="{{ route('permission.edit',$permission->id) }}">{{ $permission->name }}</a></td>
                                <td>{{ $permission->slug }}</td>
                                <td>
                                  
                                    <form method="POST" action="{{ route('permission.destroy',$permission->id) }}">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-danger">Delete</button>
                                    </form>
                                  
                                </td>
                              </tr>
            
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
            
                @section('scripts')
                    <!-- Page level plugins -->
                    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
                    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
            
                    <!-- Page level custom scripts -->
                    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
                @endsection
            </div>
        </div>
    @endsection
</x-admin-master>