@extends('layouts.cLayout')

@section('content')
    <div class="container">
    <h5 class="text-2xl font-bold mb-6">Instructors ({{ $userTypeCounts[1] }})</h5>


        <div class="table-data">
                
                <table class="w-full border-collapse bg-gray-100">
  <thead>
                <tr class="text-left text-white bg-blue-600">
                    <th class="px-6 py-3 border-b-2 border-gray-400">No.</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Name</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Address</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Contact Number</th>
                    <th class="px-6 py-3 border-b-2 border-gray-400">Email</th>
                </tr>
            </thead>
            <tbody>
            @foreach($instructors as $key=>$instructor)
                <tr class="hover:bg-gray-200">
                    <td  class="px-6 border-b-2 border-gray-300">{{ $key+1 }}</td>
                    <td  class="px-6 border-b-2 border-gray-300">{{ $instructor->name }}</td>
                    <td  class="px-6 border-b-2 border-gray-300">{{ $instructor->municipal }}</td>
                    <td  class="px-6 border-b-2 border-gray-300">{{ $instructor->contact }}</td>
                    <td  class="px-6 border-b-2 border-gray-300">{{ $instructor->email }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    {{ $instructors->links('custom-pagination') }}
</div>
@endsection
