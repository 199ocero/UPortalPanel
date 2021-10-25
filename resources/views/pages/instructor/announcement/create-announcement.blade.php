<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Announcement') }}
        </h2>
    </x-slot>
    

    {{-- Announcement Table --}}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Add Announcement</h4>
                         </div>
                         <hr>
                         <form method="POST" action="{{url('instructor/announcement/add/'.$section_id.'/'.$subject_id)}}">
                             @csrf
                            <div class="row">
                                <div class="form-group mb-3">
                                     <label>Due Date</label>
                                     <input class="form-control" type="datetime-local" id="deadline" name="deadline">
                                     @error('deadline')
                                         <span class="text-danger">{{$message}}</span>
                                     @enderror
                                </div>
                                <div class="form-group mb-3">
                                     <label>Activity Title</label>
                                     <input type="text" class="form-control" name="act_title" id="act_title" placeholder="Enter Activity Title">
                                     @error('act_title')
                                         <span class="text-danger">{{$message}}</span>
                                     @enderror
                               </div>
                               <div class="form-group mb-3">
                                     <label>Activity Instruction</label>
                                     <textarea name="instruction" id="instruction" class="form-control" placeholder="Enter Instructions"></textarea>
                                     @error('instruction')
                                         <span class="text-danger">{{$message}}</span>
                                     @enderror
                               </div>
                               <div class="form-group mb-3">
                                     <label>Activity Resources</label>
                                     <input type="text" class="form-control" name="resources" id="resources" placeholder="Paste Activity Link">
                                     @error('resources')
                                         <span class="text-danger">{{$message}}</span>
                                     @enderror
                                 </div>
                               
                             </div>
                             <div class="form-group d-flex justify-content-end align-items-baseline">
                                <button type="submit" class="btn btn-primary text-white" style="margin-right: 5px">Submit</button>
                                <a href="{{url('instructor/announcement/view/'.$section_id.'/'.$subject_id)}}" class="btn btn-danger text-white">Cancel</a>
                              </div>
                         </form>
                        
                       
                    </div>
                </div>
            </div>
            
        </div>


    {{-- Scripts --}}
    @section('scripts.instructor.section.subject.announcement.create')
        <script type="text/javascript">
            $(document).ready( function () {
                $('#assign_table_id').DataTable();
            } );
            // $("input[type=date-time local]").flatpickr(optional_config);
        </script>
        @if(Session::has('success'))
            <script>
                toastr.success("{{Session::get('success')}}");
            </script>
        @endif
    @endsection
</x-app-layout>

