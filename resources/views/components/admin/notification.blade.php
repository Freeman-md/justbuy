<div>
    @switch($notification->data['type'])
        @case('Subscriber')
            <div class="flex flex-col">
                <span>We've got a new subscriber, <strong>{{ $notification->data['data']['email'] }}</strong>
            </div>
            @break
        @case('Feedback')
            <div class="flex flex-col">
                <span>We've got a new message from <strong>{{$notification->data['data']['name']}}</strong>.</span>
                <span>Email Address: <strong>{{$notification->data['data']['email']}}</strong></span>.
                <span>Subject: <strong>{{$notification->data['data']['subject']}}</strong></span>
            </div>
            @break
        @default
    @endswitch
</div>