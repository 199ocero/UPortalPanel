<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Student-Subject Management') }}
        </h2>
    </x-slot>

    {{-- Create Admin --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                           <h4>Assign Student to Subject</h4>
                        </div>
                        <hr>
                        <form method="POST" action="{{route('view.add.subject.student')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label>Subject and Instructor</label>
                                    <select class="selectpicker instructor_subject form-control" name="instructor_subject_id" data-style="btn-primary" data-live-search="true" title="Select Subject">
                                        @php($x=0)
                                        @php($y=0)
                                        @foreach($instructorSubject as $instructorSubject)
                                            <option value="{{$instructorSubject->id}}">{{$subjectName[$x++]}} - {{$instructorName[$y++]}}</option>
                                        @endforeach
                                    </select>
                                    @error('instructor_subject_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Student</label>
                                      <select class="selectpicker student form-control" name="student_id[]" multiple data-style="btn-primary" data-live-search="true" title="Select Student">
                                         @foreach($student as $student)
                                              <option value="{{$student->id}}">{{$student->first_name}} {{$student->last_name}}</option>
                                          @endforeach
                                      </select>
                                      @error('student_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                  </div>
                            </div>
                            <div class="form-group d-flex justify-content-end align-items-baseline">
                                <button type="submit" class="btn btn-primary text-white" style="margin-right:5px">Submit</button>
                                <a href="{{route('view.administrator.assign.subject.student')}}" class="btn btn-danger text-white">Cancel</a>
                              </div>
                        </form>
                        
                  </div>
            </div>
            
        </div>
    </div>
    
    @section('scripts.admin.assign.student-subject.create')
    <script type="text/javascript">

        $(function () {
            $('.instructor_subject').selectpicker();
            $('.student').selectpicker();
        });
    </script>
    @endsection
</x-app-layout>


