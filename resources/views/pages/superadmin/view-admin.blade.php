<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"> 
            {{ __('Administrator Management') }}
        </h2>
    </x-slot>

    {{-- Admin Table --}}
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="mb-2">
                    <a href="{{route('view.super.administrator.add')}}" class="btn btn-primary text-white">Add Admin</a>
                </div>
                <table class="table table-sm table-responsive table-fixed" id="admin_table_id">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Middle Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach ($admin as $admin)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td>{{$admin->username}}</td>
                                <td>{{$admin->first_name}}</td>
                                <td>{{$admin->middle_name}}</td>
                                <td>{{$admin->last_name}}</td>
                                <td>{{$admin->email}}</td>
                                <td>{{$admin->created_at->format('m-d-Y')}}</td>
                                <td style="white-space: nowrap;width:1%">
                                    <a href="{{url('super/administrator/edit/'.$admin->id)}}" class="btn btn-primary btn-sm text-white">Edit</a>
                                    <a href="{{url('super/administrator/delete/'.$admin->id)}}" class="btn btn-danger btn-sm text-white">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                    </table>
            </div>
            </div>
    </div>


    {{-- Scripts --}}
    @section('scripts.superadmin')
        <script type="text/javascript">
            $(document).ready( function () {
                $('#admin_table_id').DataTable();
            } );
        </script>
        @if(Session::has('success'))
            <script>
                toastr.success("{{Session::get('success')}}");
            </script>
        @endif
    @endsection
</x-app-layout>

