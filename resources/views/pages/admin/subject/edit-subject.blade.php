<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Subject Management') }}
        </h2>
    </x-slot>

    {{-- Edit and Update Student --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                           <h4>Edit and Update Subject</h4>
                        </div>
                        <hr>
                        <form method="POST" action="{{url('administrator/subject/update/'.$subject->id)}}">
                            @csrf
                            <div class="form-group mb-3">
                              <label>Username</label>
                              <input type="text" class="form-control" name="subject" id="username_id" placeholder="Enter Subject Name" value="{{$subject->subject}}">
                              @error('subject')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                              <div class="form-group d-flex justify-content-end align-items-baseline">
                                <button type="submit" class="btn btn-primary text-white" style="margin-right: 5px">Update</button>
                                <a href="{{route('view.administrator.subject')}}" class="btn btn-danger text-white">Cancel</a>
                              </div>
                        </form>
                        
                  </div>
            </div>
            
        </div>
    </div>
</x-app-layout>

