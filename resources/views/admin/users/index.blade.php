<x-admin-master>
    @section('content')

    @if (Session::has('user-deleted-message'))
      <div class="alert alert-danger">{{ Session::get('user-deleted-message') }}</div>
    {{-- @elseif (Session::has('post-created-message'))
      <div class="alert alert-success">{{ Session::get('post-created-message') }}</div>
    @elseif (Session::has('post-updated-message'))
      <div class="alert alert-success">{{ Session::get('post-updated-message') }}</div> --}}
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Avatar</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Registered Date</th>
                  <th>Updated Profile Date</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered Date</th>
                    <th>Updated Profile Date</th>
                    <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($users as $user )

                  <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ route('users.profile.show',$user)}}">{{ $user->username }}</a></td>
                    <td>
                        <div>
                          <img height="40px" src="{{ asset($user->avatar) }}" alt="">
                        </div>
                      </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    {{-- <td>
                      
                        <form method="POST" action="{{ route('post.edit',$post->id) }}">
                          @csrf
                          <button class="btn btn-success">Edit</button>
                        </form>
                      
                    </td> --}}
                    <td>
                        <form method="POST" action="{{ route('user.destroy',$user->id) }}">
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
      
      
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    @endsection
</x-admin-master>