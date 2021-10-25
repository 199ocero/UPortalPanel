<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Section Management') }}
        </h2>
    </x-slot>
    

    {{-- Section Table --}}
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card mt-4">
                    <div class="card-body">
                        <form method="POST" action="{{route('view.add.section')}}" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label>Section</label>
                                <input type="text" class="form-control" name="section" id="section" placeholder="Enter Section Name">
                                @error('section')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="input-group mb-3 mt-3">
                                    <div class="custom-file">                                                                                                                                                                               
                                      <input type="file" class="custom-file-input" name="file" id="file_id">                                                                                                                           
                                      <label class="custom-file-label" for="inputGroupFile03">Choose Student Excel File</label>
                                    </div>                                                                                                                                                      
                                </div>
                                
                                @error('file')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="mt-3 mb-3">
                                <button type="submit" class="btn btn-primary text-white btn-block">Submit</button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-sm" id="section_table_id">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Section Name</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach ($studentSection as $studentSection)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$studentSection['section']['section']}}</td>
                                        <td>
                                            <a href="{{url('administrator/section/edit/'.$studentSection['section']['id'])}}" class="btn btn-primary btn-sm text-white">Edit</a>
                                            <a href="{{url('administrator/section/delete/'.$studentSection['section']['id'])}}" class="btn btn-danger btn-sm text-white">Delete</a>
                                            <a href="{{url('administrator/section/details/'.$studentSection['section']['id'])}}" class="btn btn-secondary btn-sm text-white">Details</a>
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
    @section('scripts.admin.section')
        <script type="text/javascript">
            $(document).ready( function () {
                $('#section_table_id').DataTable();
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
        @if(Session::has('failed'))
            <script>
                toastr.error("{{Session::get('failed')}}");
            </script>
        @endif
    @endsection
</x-app-layout>

