@extends('layouts.adminLayout')

@section('content')
<div class="container">
<div class="flex justify-between items-center mb-6">
<h5 class="text-2xl font-bold mb-0">Total Users ({{ $userTypeCounts[0] + $userTypeCounts[1] + $userTypeCounts[2] + $userTypeCounts[3] }})</h5>
    <form class="flex items-center mr-4" method="GET" action="{{ route('adminSearch') }}">
        <input class="rounded-l-lg py-2 px-4 border-t border-l border-b border-gray-400 text-gray-800 bg-white" type="search" name="query" placeholder="Search" aria-label="Search" style="border-right: none;">
        <button class="px-4 bg-blue-500 text-white font-bold py-2 rounded-r-lg" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>

</div>

<form action="{{ route('import.users') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="file" class="form-label">Import User</label>
        <div class="d-flex align-items-center">
            <input type="file" class="form-control me-3" id="file" name="file">
            <select name="user_type" class="form-select" aria-label="User Type">
                <option value="">---choose user type---</option>
                <option value="admin">Admin</option>
                <option value="instructor">Instructor</option>
                <option value="counselor">Counselor</option>
                <option value="student">Student</option>
            </select>
            <button type="submit" class="btn btn-primary">Import</button>
        </div>
    </div>
</form>








    <a href="" class="btn btn-primary py-2 px-4 rounded-md mb-6" data-bs-toggle="modal"  data-bs-target="#addModal">
      <i class="fas fa-plus mr-2"></i> Add User
    </a>
 

    <div class="table-data">
                
                <table class="w-full border border-collapse border-gray-200 shadow bg-gray-100">
  <thead>
        <tr class="text-left text-white bg-blue-600">
          <th  class="px-6 py-3 border-b-2 border-gray-400">No.</th>
          <th  class="px-6 py-3 border-b-2 border-gray-400">Name</th>
          <th  class="px-6 py-3 border-b-2 border-gray-400">Email</th>
          <th  class="px-6 py-3 border-b-2 border-gray-400">User Type</th>
          <th  class="px-6 py-3 border-b-2 border-gray-400">Action</th>
        </tr>
      </thead>
      
      <tbody>
        @foreach($users as $key=>$user)
          <tr class="hover:bg-gray-200">
            <td class="px-6 border-b-2 border-gray-300">{{ $key+1 }}</td>
            <td class="px-6 border-b-2 border-gray-300">{{ $user->name }}</td>
            <td class="px-6 border-b-2 border-gray-300">{{ $user->email }}</td>
            <td class="px-6 border-b-2 border-gray-300">{{ $user->user_type }}</td>
            <td class="px-6 border-b-2 border-gray-300">
              <button class="btn view-user" data-id="{{ $user->id }}" data-toggle="modal" data-target="#viewModal">
                <i class="fas fa-eye text-blue-500"></i>
              </button>

              <a href="" 
                class="btn update_user_form"
                data-bs-toggle="modal" 
                data-bs-target="#updateModal"
                data-id="{{ $user->id }}"
                data-name="{{ $user->name }}"
                data-email="{{ $user->email }}"
                data-password="{{ $user->password }}"
                data-user_type="{{ $user->user_type }}">
                <i class="fas fa-edit text-green-500"></i>
              </a>

              <a href="" 
                class="btn delete_user"
                data-id="{{ $user->id }}">
                <i class="fas fa-trash-alt text-red-500"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>


  {{ $users->links('custom-pagination') }}

</div>

@include('/admin/add_user_modal')
@include('/admin/view_user_modal')
@include('/admin/update_user_modal')
@include('/admin/user_js')
{!! Toastr::message() !!}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
@endsection
