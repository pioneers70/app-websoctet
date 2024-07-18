<?php

namespace App\Events;

use App\Http\Resources\Message\MessageResource;
use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreMessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;


    public function __construct(Message $message)
    {
        //
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('store_message'),
        ];
    }

    public function broadcastAs()
    {
        return 'store_message';
    }

    public function broadcastWith()
    {
        return [
            'message' => MessageResource::make($this->message)->resolve()
        ];
    }
}
