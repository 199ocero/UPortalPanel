<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Subject-Instructor Management') }}
        </h2>
    </x-slot>

    {{-- Create Admin --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                           <h4>Edit Assign Subject to Instructor</h4>
                        </div>
                        <hr>
                        <form method="POST" action="{{route('view.update.subject.instructor',$assign[0]->subject_id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label>Subject</label>
                                    <select class="selectpicker subject form-control" name="subject_id" data-style="btn-primary" data-live-search="true" title="Select Subject">
                                       @foreach($subject as $subject)
                                            <option value="{{$subject->id}}" {{($assign[0]->subject_id==$subject->id)?"selected":""}}>{{$subject->subject}}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Instructor</label>
                                      <select class="selectpicker instructor form-control" name="instructor_id[]" multiple data-style="btn-primary" data-live-search="true" title="Select Instructor">

                                        @foreach ($instructor as $instructor)
                                            @for ($i=0;$i<count($assign);$i++)
                                                @if ($instructor->id==$assign[$i]->role_user_id)
                                                    <option value="{{$instructor->id}}" selected>{{$instructor->first_name}} {{$instructor->last_name}}</option>
                                                    @break
                                                @endif      
                                            @endfor
                                            <option value="{{$instructor->id}}">{{$instructor->first_name}} {{$instructor->last_name}}</option>  
                                        @endforeach

                                        
                                      </select>
                                      @error('instructor_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>
                            </div>
                            <div class="form-group d-flex justify-content-end align-items-baseline">
                                <button type="submit" class="btn btn-primary text-white" style="margin-right: 5px">Update</button>
                                <a href="{{route('view.administrator.assign.subject.instructor')}}" class="btn btn-danger text-white">Cancel</a>
                              </div>
                        </form>
                        
                  </div>
            </div>
            
        </div>
    </div>
    @section('scripts.admin.assign.subject-instructor.edit')
        <script type="text/javascript">

            $(function () {
                $('.subject').selectpicker();
                $('.instructor').selectpicker();
            });
            var map = {};
            $('.instructor option').each(function () {
                if (map[this.value]) {
                    $(this).remove()
                }
                map[this.value] = true;
            })
        </script>
@endsection
</x-app-layout>



