<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Assign Student Management') }}
        </h2>
    </x-slot>

    {{-- Create Admin --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <h4>Find Irregular Student</h4>
                  </div>
                  <hr>
                  <table class="table table-sm" id="assign_table_id">
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

