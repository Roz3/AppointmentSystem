@extends('layouts.studentLayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Notifications</div>

                    <div class="card-body">
                    <div class="d-flex mb-3">
                    @if(count($notifications) > 0)
                            <form action="{{ route('student.notifications.markAsRead') }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-primary mr-3">Mark all as read</button>
                            </form>
                            <form action="{{ route('student.notifications.deleteAll') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete all</button>
                            </form>
                            @endif
                        </div>
                        <ul class="list-group">
                        @forelse ($notifications as $notification)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @if ($notification->type === 'App\Notifications\CallslipNotification')
                                    <a href="{{ route('student.callslips') }}">{{ $notification->data['data'] }}</a>
                                    <span class="text-muted">{{ $notification->created_at->format('M d, Y \a\t h:i A') }}</span>
                                @endif
                                @if ($notification->type === 'App\Notifications\CallSlipCancelled')
                                    <a href="{{ route('student.callslips') }}">{{ $notification->data['data'] }}</a>
                                    <span class="text-muted">{{ $notification->created_at->format('M d, Y \a\t h:i A') }}</span>
                                @endif
                                @if ($notification->type === 'App\Notifications\CallSlipReschedule')
                                    <a href="{{ route('student.callslips') }}">{{ $notification->data['data'] }}</a>
                                    <span class="text-muted">{{ $notification->created_at->format('M d, Y \a\t h:i A') }}</span>
                                @endif
                                @if ($notification->type === 'App\Notifications\ReferredNotification')
                                    <a href="">{{ $notification->data['data'] }}</a>
                                    <span class="text-muted">{{ $notification->created_at->format('M d, Y \a\t h:i A') }}</span>
                                @endif
                                
                               <div class="btn-group">
                               @if(count($notifications) > 0)
                               <form action="{{ route('student.notifications.markAsRead', $notification->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn{{ $notification->read_at ? ' disabled' : '' }}"><i class="fas fa-check text-green-500"></i></button>
                                        </form>
                                <form action="{{ route('student.notifications.delete', $notification->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn"><i class="fas fa-trash-alt text-red-500"></i></button>
                                </form>
                            @endif

                                    </div>
                            </li>
                        @empty
                            <li class="list-group-item">No notifications found.</li>
                        @endforelse

                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
