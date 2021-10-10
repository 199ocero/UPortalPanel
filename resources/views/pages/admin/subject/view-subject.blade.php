<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Subject Management') }}
        </h2>
    </x-slot>
    

    {{-- Subject Table --}}
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mt-4">
                    <div class="card-body">
                        <form method="POST" action="{{route('view.add.subject')}}">
                            @csrf
                            <div>
                                <label>Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter Subject Name">
                                @error('subject')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary text-white btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-sm" id="subject_table_id">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Subject Name</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach ($subject as $subject)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$subject->subject}}</td>
                                        <td>
                                            <a href="{{url('administrator/subject/edit/'.$subject->id)}}" class="btn btn-primary btn-sm text-white">Edit</a>
                                            <a href="{{url('administrator/subject/delete/'.$subject->id)}}" class="btn btn-danger btn-sm text-white">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                              
                            </tbody>
                          </table>
                    </div>
                  </div>
            </div>
            
            
        </div>


    {{-- Scripts --}}
    @section('scripts.admin.subject')
        <script type="text/javascript">
            $(document).ready( function () {
                $('#subject_table_id').DataTable();
            } );
        </script>
        @if(Session::has('success'))
            <script>
                toastr.success("{{Session::get('success')}}");
            </script>
        @endif
    @endsection
</x-app-layout>

