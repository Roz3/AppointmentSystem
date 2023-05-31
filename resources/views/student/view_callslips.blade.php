@extends('layouts.studentLayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <div class="call-slip-letter">
                <div class="header" style="border-bottom: 1px solid black;">
            <div class="logo-container">
                <a class="logo" href="#">
                    <img src="{{ asset('assets/LOGO.jpg') }}" width="100" height="50" alt="BISU LOGO" loading="lazy" />
                </a>
            </div>
            <div class="text-container" style="text-align: left;">
                <p class="university">Bohol Island State University</p>
                <p class="address">Cogtong, Candijay, Bohol</p>
                <p class="guidance"><strong>Guidance Center</strong></p>
            </div>
            <div class="text-container" style="text-align: left;  border-left: 1px solid black;">
                <p class="university">Form No. BISU-F- GDC 012</p>
                <p class="address">Revision: 00</p>
                <p class="guidance"><strong>Effectivity Date: 09-01-18</strong></p>
                <p class="guidance"><strong>CALL SLIP</strong></p>
            </div>
        </div>

                    
                    <p style="text-indent: 30em;">{{ $callslip->created_at->format('F j, Y') }}</p>
                    
                    <div class="content">
                        <p>Dear {{ App\Models\User::find($callslip->student_id)->name }},</p>

                        <p style="text-indent: 4em;">Please see your guidance counselor at the Guidance Center on <strong>{{ date('m/d/y', strtotime($callslip->date)) }}</strong> at <strong>{{ date('h:i A', strtotime($callslip->time)) }}</strong>.</p>

                        <div class="name" style="text-indent: 30em;">
                            <p>{{ App\Models\User::find($callslip->counselor_id)->name }}</p>
                            <p>Guidance Counselor</p>
                        </div>
                    </div>
                </div>

                <hr>

                <a href="{{ route('student.callslips') }}" class="btn btn-secondary">Go Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
