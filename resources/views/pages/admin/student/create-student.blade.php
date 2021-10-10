<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Student Management') }}
        </h2>
    </x-slot>

    {{-- Create Admin --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                           <h4>Add Student</h4>
                        </div>
                        <hr>
                        <form method="POST" action="{{route('view.add.student')}}">
                            @csrf
                            <input type="hidden" id="role_id" class="role_id form-control" type="text" name="role_id" value="student"/>
                            <div class="form-group mb-3">
                              <label>Username</label>
                              <input type="text" class="form-control" name="username" id="username_id" placeholder="Enter Username">
                              @error('username')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name">
                                @error('first_name')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                              <div class="form-group mb-3">
                                <label>Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Enter Middle Name">
                                @error('middle_name')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                              <div class="form-group mb-3">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name">
                                @error('last_name')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                              <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email" :value="old('email')" placeholder="Enter Email">
                                @error('email')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                              <div class="form-group d-flex justify-content-end align-items-baseline">
                                <button type="submit" class="btn btn-primary text-white" style="margin-right: 5px">Submit</button>
                                <a href="{{route('view.administrator.student')}}" class="btn btn-danger text-white">Cancel</a>
                              </div>
                        </form>
                        
                  </div>
            </div>
            
        </div>
    </div>
</x-app-layout>

