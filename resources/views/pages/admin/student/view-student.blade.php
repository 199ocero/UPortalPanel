<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Student Management') }}
        </h2>
    </x-slot>
    

    {{-- Student Table --}}
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <form method="POST" action="{{url('administrator/student/excel')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <button type="submit" class="btn btn-primary" type="button" disabled>Upload</button>
                                </div>
                                <div class="custom-file">                                                                                                                                                                               
                                  <input type="file" class="custom-file-input" name="file" id="file_id">                                                                                                                           
                                  <label class="custom-file-label" for="inputGroupFile03">Choose Excel File to Upload</label>
                                </div>                                                                                                                                                      
                            </div>
                        </form>
                        <span class="text-info">Note: The duplicated username and email by row are not recorded ang being skip.</span>
                    </div>
                    
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{route('view.student.add')}}" class="btn btn-primary text-white">Add Student</a>
                    </div>
                    <table class="table table-sm table-responsive table-fixed" id="student_table_id">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach ($student as $student)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$student->username}}</td>
                                    <td>{{$student->first_name}}</td>
                                    <td>{{$student->middle_name}}</td>
                                    <td>{{$student->last_name}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>{{$student->created_at->format('m-d-Y')}}</td>
                                    <td style="white-space: nowrap;width:1%">
                                        <a href="{{url('administrator/student/edit/'.$student->id)}}" class="btn btn-primary btn-sm text-white">Edit</a>
                                        <a href="{{url('administrator/student/delete/'.$student->id)}}" class="btn btn-danger btn-sm text-white">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                </div>
              </div>
        </div>


    {{-- Scripts --}}
    @section('scripts.admin.student')
        <script type="text/javascript">
            $(document).ready( function () {
                $('#student_table_id').DataTable();
            } );
        </script>
        <script>
            $('#file_id').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });
            $('input[type=file]').change(function(){
                if($('input[type=file]').val()==''){
                    $('button').attr('disabled',true)
                } 
                else{
                $('button').attr('disabled',false);
                }
            });
        </script>
        @if(Session::has('success'))
            <script>
                toastr.success("{{Session::get('success')}}");
            </script>
        @endif
    @endsection
</x-app-layout>

