<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Assign Management') }}
        </h2>
    </x-slot>

    {{-- Create Assign --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                           <h4>Edit Instructor - Section - Subject</h4>
                        </div>
                        <hr>
                        <form method="POST" action="{{route('view.update.instructor.section.subject',$assign->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Instructor</label>
                                      <select class="selectpicker instructor form-control" name="instructor_id" data-style="btn-primary" data-live-search="true" title="Select Instructor">
                                         @foreach($instructor as $instructor)
                                              <option value="{{$instructor->id}}" {{($assign->instructor_id==$instructor->id)?"selected":""}}>{{$instructor->first_name}} {{$instructor->last_name}}</option>
                                          @endforeach
                                      </select>
                                      @error('instructor_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Section</label>
                                      <select class="selectpicker section form-control" name="section_id" data-style="btn-primary" data-live-search="true" title="Select Section">
                                         @foreach($section as $section)
                                              <option value="{{$section->id}}" {{($assign->section_id==$section->id)?"selected":""}}>{{$section->section}}</option>
                                          @endforeach
                                      </select>
                                      @error('section_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label>Subject</label>
                                    <select class="selectpicker subject form-control" name="subject_id" data-style="btn-primary" data-live-search="true" title="Select Subject">
                                       @foreach($subject as $subject)
                                            <option value="{{$subject->id}}" {{($assign->subject_id==$subject->id)?"selected":""}}>{{$subject->subject}}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>
                                </div>   
                            </div>
                            <div class="form-group d-flex justify-content-end align-items-baseline">
                                <button type="submit" class="btn btn-primary text-white" style="margin-right:5px">Submit</button>
                                <a href="{{route('view.administrator.assign.instructor.section.subject')}}" class="btn btn-danger text-white">Cancel</a>
                              </div>
                        </form>
                        
                  </div>
            </div>
            
        </div>
    </div>
    
    @section('scripts.admin.assign.instructor-section-subject.create')
    <script type="text/javascript">

        $(function () {
            $('.subject').selectpicker();
            $('.instructor').selectpicker();
            $('.section').selectpicker();
        });
    </script>
    @endsection
</x-app-layout>


