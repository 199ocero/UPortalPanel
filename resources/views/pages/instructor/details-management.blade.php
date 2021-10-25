<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Assign Student Management') }}
        </h2>
    </x-slot>
    

    {{-- Student Table --}}
        <div class="row justify-content-center">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-10">
                                <h4>Student Assigned in this Section - {{$section->section}}</h4>
                            </div>
                            <div class="col-md-2">
                                <a href="{{url('instructor/section/add/student/'.$section->id.'/'.$subject->id)}}" class="btn btn-primary float-right">Add Irregular Student</a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm" id="assign_table_id">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Middle Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Created</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @php($x=0)
                            @foreach($assign as $assign)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$assign['student']['username']}}</td>
                                    <td>{{$assign['student']['first_name']}}</td>
                                    <td>{{$assign['student']['middle_name']}}</td>
                                    <td>{{$assign['student']['last_name']}}</td>
                                    <td>{{$assign['student']['created_at']->format('m-d-Y')}}</td>
                                    @if($status[$x]=='Regular')
                                        <td><span class="badge badge-success">Regular</span></td>
                                        <td>
                                            <a href="{{url('instructor/section/drop-student/'.$assign['student']['id'].'/'.$section->id.'/'.$subject->id)}}" class="btn btn-secondary btn-sm text-white">Drop</a>
                                            <a href="{{url('instructor/section/edit-student/'.$assign['student']['id'].'/'.$section->id)}}" class="btn btn-primary btn-sm text-white">Edit</a>
                                            <a href="{{url('instructor/section/delete-student/'.$assign['student']['id'].'/'.$section->id.'/'.$subject->id)}}" class="btn btn-danger btn-sm text-white">Delete</a>
                                        </td>
                                        @php($x++)
                                    @elseif($status[$x]=='Drop')
                                        <td><span class="badge badge-danger">Drop</span></td>
                                        <td>
                                            <a href="{{url('instructor/section/undrop-student/'.$assign['student']['id'].'/'.$section->id.'/'.$subject->id)}}" class="btn btn-secondary btn-sm text-white">Add</a>
                                            <a href="{{url('instructor/section/edit-student/'.$assign['student']['id'].'/'.$section->id)}}" class="btn btn-primary btn-sm text-white">Edit</a>
                                            <a href="{{url('instructor/section/delete-student/'.$assign['student']['id'].'/'.$section->id.'/'.$subject->id)}}" class="btn btn-danger btn-sm text-white">Delete</a>
                                        </td>
                                        @php($x++)
                                    @else

                                        <td><span class="badge badge-info">Irregular</span></td>
                                        <td>
                                            <a href="{{url('instructor/section/remove-student/'.$assign['student']['id'].'/'.$section->id.'/'.$subject->id)}}" class="btn btn-info btn-sm text-white">Remove</a>
                                            <a href="{{url('instructor/section/drop-student/'.$assign['student']['id'].'/'.$section->id.'/'.$subject->id)}}" class="btn btn-secondary btn-sm text-white">Drop</a>
                                            <a href="{{url('instructor/section/edit-student/'.$assign['student']['id'].'/'.$section->id)}}" class="btn btn-primary btn-sm text-white">Edit</a>
                                            <a href="{{url('instructor/section/delete-student/'.$assign['student']['id'].'/'.$section->id.'/'.$subject->id)}}" class="btn btn-danger btn-sm text-white">Delete</a>
                                        </td>
                                        @php($x++)
                                    @endif
                                   
                                </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>
              </div>
        </div>


    {{-- Scripts --}}
    @section('scripts.instructor.section.subject.details')
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

