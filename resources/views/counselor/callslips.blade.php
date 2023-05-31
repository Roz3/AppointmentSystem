@extends('layouts.cLayout')

@section('content')
        <div class="row">
            <div class="col-md-2"></div>
            <div class="row">
    <div class="col-md-4">
        <form class="flex items-center" method="GET" action="{{ route('counselorSearch') }}">
            <input class="rounded-l-lg py-2 px-4 border-t border-l border-b border-gray-400 text-gray-800 bg-white" type="search" name="query" placeholder="Search" aria-label="Search" style="border-right: none;">
            <button class="px-4 bg-blue-500 text-white font-bold py-2 rounded-r-lg" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>

    </div>
    <div class="col-md-8">
        <form method="GET" action="{{ route('counselor.callslips') }}" class="d-flex align-items-center mb-3">
            <div class="me-2">
                <label for="filter_date" class="form-label">Filter by Date:</label>
                <input type="date" class="form-control" id="filter_date" name="filter_date" value="{{ $filter_date }}">
            </div>
            <div class="me-2">
                <label for="filter_status" class="form-label">Filter by Status:</label>
                <select class="form-select" id="filter_status" name="filter_status">
                    <option value="">All</option>
                    <option value="pending for counseling" {{ $filter_status == 'pending for counseling' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $filter_status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $filter_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('counselor.callslips') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>
               
                <div class="table-data">
                @if(count($callslips) > 0)
                
    <table class="table-auto w-full border border-collapse border-gray-700 shadow mt-10">
        <thead>
            <tr class="bg-blue-600 text-white">
                <th scope="col" class="px-4 py-2">No.</th>
                <th scope="col" class="px-4 py-2">Student Name</th>
                <th scope="col" class="px-4 py-2">Date</th>
                <th scope="col" class="px-4 py-2">Time</th>
                <th scope="col" class="px-4 py-2">Status</th>
                <th scope="col" class="px-4 py-2">Action</th>
            </tr>
        </thead>
  
        <tbody>
            @foreach($callslips as $key=>$callslip)
            @if($callslip->status == 'completed')
                @continue
            @endif
            <tr>
                <td class="border px-4 py-2">{{ $key+1 }}</td>
                <td class="border px-4 py-2">{{ App\Models\User::find($callslip->student_id)->name }}</td>
                <td class="border px-4 py-2">{{ date('m/d/y', strtotime($callslip->date)) }}</td>
                <td class="border px-4 py-2">{{ date('h:i A', strtotime($callslip->time)) }}</td>
                <td class="border px-4 py-2" style="color:
                    @if($callslip->status == 'pending for counseling')
                        green
                    @elseif($callslip->status == 'completed')
                        blue
                    @elseif($callslip->status == 'cancelled')
                        red
                    @endif">
                    {{ $callslip->status}}
                </td>
                <td class="px-4 py-2">

               <a href="#" class="complete-callslip-btn btn btn-primary no-underline" data-id="{{ $callslip->id }}">
            Done
                </a>

          
                        <a href="" 
                            class="btn btn-success update_callslip_form"
                            data-bs-toggle="modal" 
                            data-bs-target="#updateModal"
                            data-id="{{ $callslip->id }}"
                            data-student_id="{{ $callslip->student_id }}"
                            data-instructor_id="{{ $callslip->instructor_id}}"
                            data-date="{{ $callslip->date }}"
                            data-time="{{ $callslip->time }}"
                        >
                        Reschedule
                        </a>

                        <a href="#" class="cancel-callslip-btn btn btn-warning " data-id="{{ $callslip->id }}">
                       Cancel
                        </a>

                        <a href="" 
                            class="btn btn-danger delete_callslip"
                            data-id="{{ $callslip->id }}"
                        >
                        Delete
                        </a>
                    </td>

            </tr>
        @endforeach
  </tbody>
                </table>
                @php echo $callslips->links(); @endphp

                </div>
                
                @else
                <p>No appointments found.</p>
                @endif
        </div>
    

    @include('/counselor/add_callslip_modal')
    @include('/counselor/update_callslip_modal')
    @include('/counselor/callslip_js')
    @include('/counselor/add_notes_modal')
    @include('/counselor/note_js')
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    
  @endsection
