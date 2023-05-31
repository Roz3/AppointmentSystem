@extends('layouts.cLayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> 
                    <div class="logo-container">
                        <a class="logo" href="#">
                            <img src="{{ asset('assets/LOGO.jpg') }}" height="90" alt="BISU LOGO" loading="lazy" />
                        </a>
                    <div class="text-container">
                        <p class="university">Bohol Island State University</p>
                        <p class="address">Cogtong, Candijay, Bohol</p>
                        <p class="guidance"><strong>Guidance Center</strong></p>
                    </div>
                </div>
            </div>
                <div class="card-body">
                <div class="call-slip-letter">
                    <div class="header">
                        <h2>Call Slip Form</h2>
                    </div>
                    <p style="text-indent: 30em;">{{ $callslip->created_at->format('F j, Y') }}</p>
                    <div class="content">
                        <p>Dear {{ App\Models\User::find($callslip->student_id)->name }},</p>

                        <p style="text-indent: 4em;">Please see your guidance counselor at the Guidance Center on <strong>{{ date('m/d/y', strtotime($callslip->date)) }}</strong> at <strong>{{ date('h:i A', strtotime($callslip->time)) }}</strong>. This is a reminder that attendance is mandatory.</p>

                        <p style="text-indent: 4em;">Please arrive promptly at the scheduled time to avoid any unnecessary delays.</p>

                        <p style="text-indent: 4em;">Should you have any questions or concerns, please do not hesitate to contact me.</p>

                        <div style="text-indent: 30em;">
                            <p>Best regards,</p>
                            <p>{{ App\Models\User::find($callslip->counselor_id)->name }}</p>
                        </div>
                    </div>
                </div>

                <hr>

                <a href="{{ route('counselor.callslips') }}" class="btn btn-secondary">Go Back</a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection