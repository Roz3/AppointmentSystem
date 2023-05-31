@extends('layouts.adminLayout')

@section('content')
<div class="container">
    <h5 class="text-2xl font-bold mb-6">Admin ({{ $userTypeCounts[3] }})</h5>


    <div class="table-data">
                
                <table class="w-full border-collapse bg-gray-100">
  <thead>
                <tr class="text-left bg-gray-300">
                    <th class="px-6 py-3 border-b-2 border-gray-400">No.</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Name</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Email</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($admins as $key=>$admin)
                <tr class="hover:bg-gray-200">
                    <td class="px-6 border-b-2 border-gray-300">{{ $key+1 }}</td>
                    <td class="px-6 border-b-2 border-gray-300">{{ $admin->name }}</td>
                    <td class="px-6 border-b-2 border-gray-300">{{ $admin->email }}</td>
                    <td class="px-6 border-b-2 border-gray-300">
                        <button class="btn view-admin" data-id="{{ $admin->id }}" data-toggle="modal" data-target="#viewModal">
                        <i class="fas fa-eye text-blue-500"></i>
                        </button>

                        <a href="" 
                            class="btn update_admin_form"
                            data-bs-toggle="modal" 
                            data-bs-target="#updateAdminModal"
                            data-id="{{ $admin->id }}"
                            data-name="{{ $admin->name }}"
                            data-email="{{ $admin->email }}"
                            data-password="{{ $admin->password }}"
                            data-user_type="{{ $admin->user_type }}"
                        
                            >
                            <i class="fas fa-edit text-green-500"></i>
                            </a>

                            <a href="" 
                            class="btn delete_admin"
                            data-id="{{ $admin->id }}">
                            <i class="fas fa-trash-alt text-red-500"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
@include('/admin/view_admin_modal')
@include('/admin/update_admin_modal')
@include('/admin/admin_js')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
@endsection
