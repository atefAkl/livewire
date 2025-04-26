<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use \App\Events\NewMessage;
use Illuminate\Support\Facades\Auth;

class ChatBox extends Component
{
    public $message = '';
    public $messages = [];

    public function mount()
    {
        $this->messages = Message::latest()->take(10)->get()->reverse();
    }

    public function sendMessage()
    {
        if ($this->message != '') {
            $newMessage = Message::create([
                'user_id' => Auth::user()->id(),
                'content' => $this->message
            ]);

            array_push($this->messages, ($newMessage));
            $this->message = '';

            // بث الحدث للآخرين
            broadcast(new NewMessage($newMessage))->toOthers();
        }
    }

    protected function getListeners()
    {
        return [
            "echo-private:chat.{$this->chatId},NewMessage" => 'addMessage'
        ];
    }

    public function addMessage($message)
    {
        array_push($this->messages, (Message::find($message['id'])));
    }

    public function render()
    {
        return view('livewire.chat-box');
    }
}
