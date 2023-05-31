@extends('layouts.cLayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Notifications</div>

                    <div class="card-body">
                    <div class="d-flex mb-3">
                    @if(count($notifications) > 0)
                            <form action="{{ route('counselor.notifications.markAsRead') }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-primary mr-3">Mark all as read</button>
                            </form>
                            <form action="{{ route('counselor.notifications.deleteAll') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete all</button>
                            </form>
                            @endif
                        </div>
                        <ul class="list-group">
                            @forelse ($notifications as $notification)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('counselor.referrals') }}" style="text-decoration:none;">{{ $notification->data['data'] }}</a>
                                    <span class="text-muted">{{ $notification->created_at->format('M d, Y \a\t h:i A') }}</span>
                                    <div class="btn-group">
                                        <form action="{{ route('counselor.notifications.markAsRead', $notification->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn{{ $notification->read_at ? ' disabled' : '' }}"><i class="fas fa-check text-green-500"></i></button>
                                        </form>
                                        <form action="{{ route('counselor.notifications.delete', $notification->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn"><i class="fas fa-trash-alt text-red-500"></i></button>
                                        </form>
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
