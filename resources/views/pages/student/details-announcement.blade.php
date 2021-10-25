<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Announcement') }}
        </h2>
    </x-slot>
    

    {{-- Announcement Table --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Announcement Details - {{$announcement['subject']['subject']}}</h4>
                        </div>
                        <hr>
                        <p><strong>Date:</strong> {{$announcement->deadline->format('F j, Y')}}</p>
                        <p><strong>Time:</strong> {{$announcement->deadline->format('h:i A')}}</p>
                        <p><strong>Activity Title:</strong> {{$announcement->act_title}}</p>
                        <p><strong>Instruction:</strong></p>
                        <p>{!!nl2br($announcement->instruction)!!}</p>
                        <p><strong>Activity Link/Resources:</strong> <a href="{{$announcement->resources}}" target="_blank">{{$announcement->resources}}</a></p>
                        <div class="form-group d-flex justify-content-end align-items-baseline">
                            <a href="{{url('student/announcement/view/')}}" class="btn btn-danger text-white">Back</a>
                        </div>
                    </div>
                </div>

            
            </div>
        </div>
</x-app-layout>

