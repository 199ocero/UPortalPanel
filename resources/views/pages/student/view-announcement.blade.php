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
                    <table class="table table-sm" id="assign_table_id">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Activity Title</th>
                            <th scope="col">Section</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @php($x=0)
                            @foreach ($announcement as $announcement)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$announcement->deadline->format('F j, Y')}}</td>
                                    <td>{{$announcement->deadline->format('h:i A')}}</td>
                                    <td>{{$announcement->act_title}}</td>
                                    <td>{{$announcement['section']['section']}}</td>
                                    <td>{{$announcement['subject']['subject']}}</td>
                                    @if(count($status)==0)
                                        <td><span class="badge badge-success">Regular</span></td>
                                    @elseif ($status[$x]=='Irregular')
                                        <td><span class="badge badge-info">Irregular</span></td>
                                        @php($x++)
                                    @else
                                        <td><span class="badge badge-success">Regular</span></td>
                                        @php($x++)
                                    @endif
                                    <td>
                                        <a href="{{url('student/announcement/details/'.$announcement->id)}}" class="btn btn-primary btn-sm text-white">Details</a> 
                                    </td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                </div>
            </div>
        </div>


    {{-- Scripts --}}
    @section('scripts.student.section.subject.announcement')
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

