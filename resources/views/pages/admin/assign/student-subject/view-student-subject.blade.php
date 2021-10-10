<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Student-Subject Management') }}
        </h2>
    </x-slot>
    

    {{-- Instructor Table --}}
        <div class="row justify-content-center">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{route('view.assign.subject.student.add')}}" class="btn btn-primary text-white">Add Assign</a>
                    </div>
                    <table class="table table-sm table-fixed" id="assign_table_id">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Instructor</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @php($x=0)
                            @php($y=0)
                            @foreach ($assign as $assign)
                                
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$subjectName[$x++]}}</td>
                                    <td>{{$instructorName[$y++]}}</td>
                                    <td style="white-space: nowrap;width:1%;">
                                        <a href="{{url('administrator/assign/student-subject/edit/'.$assign['instructorSubjectId']['id'])}}" class="btn btn-primary btn-sm text-white">Edit</a>
                                        <a href="{{url('administrator/assign/student-subject/delete/'.$assign['instructorSubjectId']['id'])}}" class="btn btn-danger btn-sm text-white">Delete</a>
                                        <a href="{{url('administrator/assign/student-subject/details/'.$assign['instructorSubjectId']['id'])}}" class="btn btn-secondary btn-sm text-white">Details</a>
                                    </td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                </div>
              </div>
        </div>


    {{-- Scripts --}}
    @section('scripts.admin.assign.student-subject')
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

