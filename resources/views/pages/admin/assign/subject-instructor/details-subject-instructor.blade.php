<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Subject-Instructor Management') }}
        </h2>
    </x-slot>
    

    {{-- Instructor Table --}}
        <div class="row justify-content-center">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-10">
                                <h4>Instructor Assigned in this Subject - {{$subject->subject}}</h4>
                            </div>
                            <div class="col-md-2">
                                <a href="{{route('view.administrator.assign.subject.instructor')}}" class="btn btn-danger float-right">Back</a>
                            </div>
                        </div>
                        
                        
                    </div>
                    <table class="table table-sm" id="assign_table_id">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Last Name</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach ($assign as $assign)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$assign['instructor']['first_name']}}</td>
                                    <td>{{$assign['instructor']['middle_name']}}</td>
                                    <td>{{$assign['instructor']['last_name']}}</td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                </div>
              </div>
        </div>


    {{-- Scripts --}}
    @section('scripts.admin.assign.subject-instructor.details')
        <script type="text/javascript">
            $(document).ready( function () {
                $('#assign_table_id').DataTable();
            } );
        </script>
    @endsection
</x-app-layout>

