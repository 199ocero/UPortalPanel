<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Section Management') }}
        </h2>
    </x-slot>

    {{-- Edit and Update Student --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                           <h4>Edit and Update Section</h4>
                        </div>
                        <hr>
                        <form method="POST" action="{{url('administrator/section/update/'.$section->id)}}">
                            @csrf
                            <div class="form-group mb-3">
                              <label>Section</label>
                              <input type="text" class="form-control" name="section" id="section_id" placeholder="Enter Section Name" value="{{$section->section}}">
                              @error('section')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                              <div class="form-group d-flex justify-content-end align-items-baseline">
                                <button type="submit" class="btn btn-primary text-white" style="margin-right: 5px">Update</button>
                                <a href="{{route('view.administrator.section')}}" class="btn btn-danger text-white">Cancel</a>
                              </div>
                        </form>
                        
                  </div>
            </div>
            
        </div>
    </div>
</x-app-layout>

