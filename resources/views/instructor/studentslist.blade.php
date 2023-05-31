@extends('layouts.insLayout')

@section('content')
    <div class="container">
    <h5 class="text-2xl font-bold mb-6">Students ({{ $userTypeCounts[0] }})</h5>


        <div class="table-data">
                
                <table class="w-full border-collapse bg-gray-100">
  <thead>
                <tr class="text-left text-white bg-blue-600">
                    <th class="px-6 py-3 border-b-2 border-gray-400">No.</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Name</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Year</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Course</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Contact No.</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Address</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Email</th>
                </tr>
            </thead>
            <tbody>
            @foreach($students as $key=>$student)
                <tr class="hover:bg-gray-200">
                    <td  class="px-6 border-b-2 border-gray-300">{{ $key+1 }}</td>
                    <td  class="px-6 border-b-2 border-gray-300">{{ $student->name }}</td>
                    <td  class="px-6 border-b-2 border-gray-300">{{ $student->year_level }}</td>
                    <td  class="px-6 border-b-2 border-gray-300">{{ $student->course_id ? App\Models\Course::find($student->course_id)->abbreviation : '' }}</td>
                    <td  class="px-6 border-b-2 border-gray-300">{{ $student->contact }}</td>
                    <td  class="px-6 border-b-2 border-gray-300">{{ $student->municipal }} {{ $student->province }}</td>
                    <td  class="px-6 border-b-2 border-gray-300">{{ $student->email }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    {{ $students->links('custom-pagination') }}
</div>

@endsection
