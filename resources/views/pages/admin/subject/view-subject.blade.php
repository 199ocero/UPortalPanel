<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Subject Management') }}
        </h2>
    </x-slot>
    

    {{-- Subject Table --}}
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        
                            <form method="POST" action="{{url('administrator/subject/excel')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary" type="button" disabled>Upload</button>
                                    </div>
                                    <div class="custom-file">                                                                                                                                                                               
                                    <input type="file" class="custom-file-input" name="file" id="file_id">                                                                                                                           
                                    <label class="custom-file-label" for="inputGroupFile03">Choose Excel File to Upload</label>
                                    </div>                                                                                                                                                      
                                </div>
                            </form>
                            <span class="text-info">Note: The duplicated subjects are not recorded ang being skip.</span>
                    </div>
                </div>
            </div>
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
        <script>
            $('#file_id').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });
            $('input[type=file]').change(function(){
                if($('input[type=file]').val()==''){
                    $('button').attr('disabled',true)
                } 
                else{
                $('button').attr('disabled',false);
                }
            });
        </script>
        @if(Session::has('success'))
            <script>
                toastr.success("{{Session::get('success')}}");
            </script>
        @endif
    @endsection
</x-app-layout>

