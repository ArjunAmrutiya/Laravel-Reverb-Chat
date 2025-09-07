<?php

namespace App\Livewire;

use App\Models\Message;
use App\Events\MessageSent;
use Livewire\Component;
use Livewire\Attributes\On;

class Chat extends Component
{
    public $message = '';
    public $messages = [];

    // protected $listeners = ['messageReceived'];

    public function mount()
    {
        // Load existing messages
        $this->messages = Message::with('user')->latest()->take(50)->get()->reverse()->values()->all();
    }

    public function sendMessage()
    {
        // Validate message
        $this->validate([
            'message' => 'required|min:1'
        ]);

        // Create and save message
        $message = Message::create([
            'user_id' => auth()->id(),
            'content' => $this->message
        ]);

        // Load user relationship
        $message->load('user');

        // Add to messages array
        $this->messages[] = $message;

        // Clear input
        $this->message = '';

        // Broadcast the message
        broadcast(new MessageSent($message))->toOthers();
    }

    // Update the incoming message handler
    #[On('echo:chat,message.sent')]
    public function handleMessageSent($message)
    {
        if ($message['user_id'] !== auth()->id()) {
            // $messageData = new Message($message);
            // $messageData->load('user');
            $messageData = Message::with('user')->find($message['id']);
            $this->messages[] = $messageData;
        }
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
