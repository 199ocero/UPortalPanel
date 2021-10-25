<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Assign Student Management') }}
        </h2>
    </x-slot>

    {{-- Create Admin --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <h4>Find Irregular Student</h4>
                  </div>
                  <hr>
                  <table class="table table-sm table-responsive" id="assign_table_id">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Middle Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach ($assign as $assign)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td>{{$assign->username}}</td>
                                <td>{{$assign->first_name}}</td>
                                <td>{{$assign->middle_name}}</td>
                                <td>{{$assign->last_name}}</td>
                                <td>
                                    <a href="{{url('instructor/section/add-irregular/'.$sectionID.'/'.$subjectID.'/'.$assign->id)}}" class="btn btn-primary btn-sm text-white">Add</a>
                                </td>
                            </tr>
                        @endforeach
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                           <h4>Add Irregular Student</h4>
                        </div>
                        <hr>
                        <form method="POST" action="{{url('instructor/section/add-student/'.$sectionID.'/'.$subjectID)}}">
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
                                <a href="{{url('instructor/assign/section-subject/details/'.$sectionID.'/'.$subjectID)}}" class="btn btn-danger text-white">Cancel</a>
                              </div>
                        </form>
                        
                  </div>
            </div>
            
        </div>
    </div>

    {{-- Scripts --}}
    @section('scripts.instructor.section.subject.irregular')
        <script type="text/javascript">
            $(document).ready( function () {
                $('#assign_table_id').DataTable();
            } );
        </script>
         @if(Session::has('success'))
         <script>
             toastr.success("{{Session::get('success')}}");
         </script>
     @endif
    @endsection
</x-app-layout>

