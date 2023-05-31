@extends('layouts.insLayout')

@section('content')
    <h5 class="text-xl font-bold mb-4">Search Results for "{{ $query }}"</h5>

    @if ($results1->count() > 0)
        <div class="bg-white rounded-lg shadow-md mb-4">
            <table class="table-auto w-full">
                <thead>
                    <tr class="border-b-2 border-gray-300">
                        <th class="px-4 py-2 font-bold text-gray-600">Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results1 as $result)
                        <tr class="border-b border-gray-300">
                            <td class="px-4 py-2">{{ $result->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if ($results2->count() > 0)
        <div class="bg-white rounded-lg shadow-md mb-4">
            <table class="table-auto w-full">
                <thead>
                    <tr class="border-b-2 border-gray-300">
                        <th class="px-4 py-2 font-bold text-gray-600">Results</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results2 as $result)
                        <tr class="border-b border-gray-300">
                            <td class="px-4 py-2">{{ $result->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if ($results1->count() == 0 && $results2->count() == 0)
    <p>No results found</p>
@endif
@endsection
