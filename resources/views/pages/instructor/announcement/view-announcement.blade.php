<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Announcement') }}
        </h2>
    </x-slot>
    

    {{-- Announcement Table --}}
        <div class="row justify-content-center">
                
            <div class="card mt-4">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-10">
                                <h4>{{$section->section}} - {{$subject->subject}}</h4>
                            </div>
                            <div class="col-md-2">
                                <a href="{{url('instructor/announcement/add/view/'.$section_id.'/'.$subject_id)}}" class="btn btn-primary float-right">Add Announcement</a>
                            </div>
                        </div>
                    </div>
                    
                    <table class="table table-sm" id="assign_table_id">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Activity Title</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach ($announcement as $announcement)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$announcement->deadline->format('F j, Y')}}</td>
                                    <td>{{$announcement->deadline->format('h:i A')}}</td>
                                    <td>{{$announcement->act_title}}</td>
                                    <td>
                                        <a href="{{url('instructor/announcement/edit/'.$announcement->id)}}" class="btn btn-primary btn-sm text-white">Edit</a>
                                        <a href="{{url('instructor/announcement/delete/'.$section_id.'/'.$subject_id.'/'.$announcement->id)}}" class="btn btn-danger btn-sm text-white">Delete</a>   
                                    </td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                </div>
            </div>
        </div>


    {{-- Scripts --}}
    @section('scripts.instructor.section.subject.announcement')
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

