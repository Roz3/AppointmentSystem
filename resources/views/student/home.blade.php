@extends('layouts.studentLayout')

@section('content')

    <h2 class="text-2xl font-bold mb-4">Counseling Sessions History</h2>

    @if(count($callslips) > 0)
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold  uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold  uppercase tracking-wider">Time</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold  uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($callslips as $callslip)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ date('F d, Y', strtotime($callslip->date)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ date('h:i A', strtotime($callslip->time)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap" style="color:
                    @if($callslip->status == 'pending')
                        green
                    @elseif($callslip->status == 'completed')
                        blue
                    @elseif($callslip->status == 'cancelled')
                        red
                    @endif">{{ $callslip->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p>No appointment history.</p>
    @endif

@endsection
