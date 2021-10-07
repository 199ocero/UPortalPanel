<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Section Management') }}
        </h2>
    </x-slot>
    

    {{-- Section Table --}}
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mt-4">
                    <div class="card-body">
                        <form method="POST" action="{{route('view.add.section')}}">
                            @csrf
                            <div>
                                <label>Section</label>
                                <input type="text" class="form-control" name="section" id="section" placeholder="Enter Section Name">
                                @error('section')
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
                        <table class="table table-sm table-responsive table-fixed" id="section_table_id">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Section Name</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach ($section as $section)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$section->section}}</td>
                                        <td style="white-space: nowrap;width:1%">
                                            <a href="{{url('administrator/section/edit/'.$section->id)}}" class="btn btn-primary btn-sm text-white">Edit</a>
                                            <a href="{{url('administrator/section/delete/'.$section->id)}}" class="btn btn-danger btn-sm text-white">Delete</a>
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
        @if(Session::has('success'))
            <script>
                toastr.success("{{Session::get('success')}}");
            </script>
        @endif
    @endsection
</x-app-layout>

