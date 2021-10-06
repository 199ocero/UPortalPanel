<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Instructor Management') }}
        </h2>
    </x-slot>

    {{-- Edit and Update Instructor --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                           <h4>Edit and Update Instructor</h4>
                        </div>
                        <hr>
                        <form method="POST" action="{{url('administrator/instructor/update/'.$instructor->id)}}">
                            @csrf
                            <input type="hidden" id="role_id" class="role_id form-control" type="text" name="role_id" value="instructor"/>
                            <div class="form-group mb-3">
                              <label>Username</label>
                              <input type="text" class="form-control" name="username" id="username_id" placeholder="Enter Username" value="{{$instructor->username}}">
                              @error('username')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" value="{{$instructor->first_name}}">
                                @error('first_name')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                              <div class="form-group mb-3">
                                <label>Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Enter Middle Name" value="{{$instructor->middle_name}}">
                                @error('middle_name')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                              <div class="form-group mb-3">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{$instructor->last_name}}">
                                @error('last_name')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                              <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email" :value="old('email')" placeholder="Enter Email" value="{{$instructor->email}}">
                                @error('email')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                              <div class="form-group d-flex justify-content-end align-items-baseline">
                                <button type="submit" class="btn btn-primary text-white" style="margin-right: 5px">Update</button>
                                <a href="{{route('view.administrator.instructor')}}" class="btn btn-danger text-white">Cancel</a>
                              </div>
                        </form>
                        
                  </div>
            </div>
            
        </div>
    </div>
</x-app-layout>

