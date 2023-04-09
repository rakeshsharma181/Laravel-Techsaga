<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Registration Form</title>
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
            <div class="h4 text-white">User Registration Form</div>
        </div>
    </div>
    <div class="container ">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Users</div>
            <div>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" id="regForm">
            @csrf
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>    
                        @enderror                        
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>    
                        @enderror      
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>    
                        @enderror      
                    </div>
                    <div class="mb-3">
                        <label for="hobbies" class="form-label">Hobbies</label> 
                        <div class="form-check">
                        <input  type="checkbox" name="hobbies[]" value="Dance" id="">
                            <label class="form-check-label" for="dance">
                                Dance
                            </label>
                        </div>
                        <div class="form-check">
                            <input  type="checkbox" name="hobbies[]" value="Yoga" id="">
                            <label class="form-check-label" for="yoga">
                                Yoga
                            </label>
                        </div>
                        <div class="form-check">
                            <input  type="checkbox" name="hobbies[]" value="Yoga" id="">
                            <label class="form-check-label" for="Cooking">
                            Cooking
                            </label>
                        </div>
                        <div class="form-check">
                            <input  type="checkbox" name="hobbies[]" value="Yoga" id="">
                            <label class="form-check-label" for="Blogging">
                            Blogging
                            </label>
                        </div>
                        @error('hobbies')
                            <p class="invalid-feedback">{{ $message }}</p>    
                        @enderror 
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Picture</label>
                        <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror">
                        @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>    
                        @enderror     
                    </div>
                </div>
            </div>
            <button class="btn btn-primary mt-3">Save User</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
</body>
</html>