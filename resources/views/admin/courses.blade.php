@extends('layouts.adminLayout')

@section('content')
<div class="container">
<div class="flex justify-between items-center mb-6">
        <h5 class="text-2xl font-bold mb-6">Courses ({{ $coursesCount }})</h5>
        <form class="flex items-center mr-4" method="GET" action="{{ route('adminSearch') }}">
            <input class="rounded-l-lg py-2 px-4 border-t border-l border-b border-gray-400 text-gray-800 bg-white" type="search" name="query" placeholder="Search" aria-label="Search" style="border-right: none;">
            <button class="px-4 bg-blue-500 text-white font-bold py-2 rounded-r-lg" type="submit">
                <i class="fas fa-search"></i>
        </button>
    </form>
</div>
                <a href="" class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus"></i> Add Course</a>
                
                @if(count($courses) > 0)
                
                <table class="w-full border border-collapse border-gray-200 shadow bg-gray-100">
              
                <thead>
                    <tr class="text-left text-white bg-blue-600">
                        <th class="px-6 py-3 border-b-2 border-gray-400">No.</th>
                        <th  class="px-6 py-3 border-b-2 border-gray-400" >Course</th>
                        <th  class="px-6 py-3 border-b-2 border-gray-400">Abbreviation</th>
                        <th  class="px-6 py-3 border-b-2 border-gray-400">College</th>
                        <th  class="px-6 py-3 border-b-2 border-gray-400">Action</th>
                    </tr>
  </thead>
  
  <tbody>
      @foreach($courses as $key=>$course)
            <tr class="hover:bg-gray-200">
                <td class="px-6 py-3 border-b-2 border-gray-400">{{ $key+1 }}</td>
                <td class="px-6 py-3 border-b-2 border-gray-400">{{ $course->course}}</td>
                <td class="px-6 py-3 border-b-2 border-gray-400">{{ $course->abbreviation ?? '' }}</td>
                <td class="px-6 py-3 border-b-2 border-gray-400"> {{ $course->department_id ? App\Models\Department::find($course->department_id)->abbreviation : '' }}</td>
                <td class="px-6 py-3 border-b-2 border-gray-400">

                <button class="btn view-course" data-id="{{ $course->id }}" data-toggle="modal" data-target="#viewCourseModal">
                <i class="fas fa-eye text-blue-500"></i>
              </button>

                <a href="" 
                        class="btn update_course_form"
                        data-bs-toggle="modal" 
                        data-bs-target="#updateModal"
                        data-id= "{{ $course->id }}"
                        data-course= "{{ $course->course }}"
                        data-abbreviation= "{{ $course->abbreviation }}"
                        >
                        <i class="fas fa-edit text-green-500"></i>
                    </a>
                    
                      <a href="" 
                            class="btn delete_course"
                            data-id= "{{ $course->id }}"
                            >
                            <i class="fas fa-trash-alt text-red-500"></i>
                  </a>
                </td>
            </tr>
        @endforeach
  </tbody>
</table>
{{ $courses->links('custom-pagination') }}
                @else
                <p>No courses found.</p>
                @endif
</div>
       
    

    @include('/admin/add_course_modal')
    @include('/admin/view_course_modal')
    @include('/admin/update_course_modal')
    @include('/admin/course_js')
    {!! Toastr::message() !!}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    
  @endsection
