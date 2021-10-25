<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Assign Management') }}
        </h2>
    </x-slot>
    

    {{-- Assign Table --}}
        <div class="row justify-content-center">
            <div class="card mt-4">
                <div class="card-body">
                    <form method="POST" action="{{route('view.add.instructor.section.subject')}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Section</label>
                                  <select class="selectpicker section form-control" name="section_id" data-style="btn-primary" data-live-search="true" title="Select Section">
                                     @foreach($section as $section)
                                          <option value="{{$section->id}}">{{$section->section}}</option>
                                      @endforeach
                                  </select>
                                  @error('section_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Subject</label>
                                <select class="selectpicker subject form-control" name="subject_id" data-style="btn-primary" data-live-search="true" title="Select Subject">
                                   @foreach($subject as $subject)
                                        <option value="{{$subject->id}}">{{$subject->subject}}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-secondary text-white btn-block">Submit</button>
                            </div>   
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <table class="table table-sm" id="assign_table_id">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Section</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach ($assign as $assign)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$assign['subject']['subject']}}</td>
                                    <td>
                                        <a href="{{url('instructor/assign/section-subject/details/'.$assign->section_id.'/'.$assign['subject']['id'])}}" class="btn btn-primary btn-sm text-white">{{$assign['section']['section']}}</a>  
                                    </td>
                                    <td>
                                        <a href="{{url('instructor/announcement/view/'.$assign->section_id.'/'.$assign->subject_id)}}" class="btn btn-secondary btn-sm text-white">Announcement</a> 
                                        <a href="{{url('instructor/assign/section-subject/delete/'.$assign->id.'/'.$assign->section_id.'/'.$assign->subject_id)}}" class="btn btn-danger btn-sm text-white">Delete</a>  
                                    </td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                </div>
            </div>
        </div>


    {{-- Scripts --}}
    @section('scripts.instructor.section.subject')
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

