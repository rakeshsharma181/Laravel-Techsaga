<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<style>
    label.error {
         color: #dc3545;
         font-size: 14px;
    }
</style>
<body>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">Edit User Registration</div>
        </div>
    </div>

    <div class="container ">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Edit User</div>
            <div>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="{{ route('users.update',$user->id) }}" method="post" enctype="multipart/form-data" id="regForm">
            @csrf
            @method('put')
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$user->name) }}">
                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>    
                        @enderror                        
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$user->email) }}">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>    
                        @enderror      
                    </div>
                    <div class="mb-3">
                        <label for="hobbies" class="form-label">Hobbies</label> 
                        <div class="form-check">
                            <input  type="checkbox" name="hobbies[]" value="Dance" {{ in_array('Dance', $hobbies) ? 'checked' : '' }} id="">
                                <label class="form-check-label" for="dance">
                                    Dance
                                </label>
                            </div>
                        <div class="form-check">
                            <input  type="checkbox" name="hobbies[]" value="Yoga" {{ in_array('Yoga', $hobbies) ? 'checked' : '' }} id="">
                            <label class="form-check-label" for="yoga">
                                Yoga
                            </label>
                        </div>
                        <div class="form-check">
                            <input  type="checkbox" name="hobbies[]" value="Cooking" {{ in_array('Cooking', $hobbies) ? 'checked' : '' }} id="">
                            <label class="form-check-label" for="yoga">
                            Cooking
                            </label>
                        </div>
                        <div class="form-check">
                            <input  type="checkbox" name="hobbies[]" value="Blogging" {{ in_array('Blogging', $hobbies) ? 'checked' : '' }} id="">
                            <label class="form-check-label" for="yoga">
                            Blogging
                            </label>
                        </div>
                        @error('hobbies')
                            <p class="invalid-feedback">{{ $message }}</p>    
                        @enderror 
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Picture</label>
                        <input type="file"  class="form-control" name="image" id="image" class= "@error('image') is-invalid @enderror">
                        @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>    
                        @enderror 
                        <div class="pt-3">
                            @if($user->picture != '' && file_exists(public_path().'/uploads/users/'.$user->picture))
                            <img src="{{ url('uploads/users/'.$user->picture) }}" alt="" width="100" height="100">
                        @endif
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary my-3">Update user</button>

        </form>
    </div>
</body>
</html>