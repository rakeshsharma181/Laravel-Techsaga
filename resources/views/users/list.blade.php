<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Registration</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>

    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">User Registration</div>
        </div>
    </div>

    <div class="container ">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Users</div>
            <div>
                <a href="{{ route('users.create') }}" class="btn btn-primary">Create</a>
            </div>
        </div>

        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif

        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th width="30">ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Hobbies</th>
                        <th width="150">Action</th>
                    </tr>

                    @if($users->isNotEmpty())
                    @foreach ($users as $user)
                    <tr valign="middle">
                        <td>{{ $user->id }}</td>
                        <td>
                            @if($user->picture != '' && file_exists(public_path().'/uploads/users/'.$user->picture))
                            <img src="{{ url('uploads/users/'.$user->picture) }}" alt="" width="40" height="40" class="rounded-circle">
                            @else
                            <img src="{{ url('assets/images/no-image.png') }}" alt="" width="40" height="40" class="rounded-circle">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->hobbies }}</td>
                        <td>
                            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" onclick="deleteEmployee(`{{$user->id}}`)" class="btn btn-danger btn-sm">Delete</a>
                            <form id="user-delete-action-{{ $user->id }}" action="{{ route('users.delete',$user->id) }}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                        
                    </tr>
                    @endforeach
                    
                    @else
                    <tr>
                        <td colspan="6">Record Not Found</td>
                    </tr>
                    @endif

                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $users->links() }}
        </div>

    </div>

    
</body>
</html>
<script>
    function deleteEmployee(id) {
        if (confirm("Are you sure you want to delete?")) {
            document.getElementById('user-delete-action-'+id).submit();
        }
    }
</script>