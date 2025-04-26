<div class="chat-container">
    <style>
        .chat-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            max-width: 500px;
            margin: 0 auto;
            height: 400px;
            display: flex;
            flex-direction: column;
        }

        .messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 10px;
        }

        .message {
            margin: 5px;
            padding: 8px 12px;
            border-radius: 18px;
            max-width: 70%;
        }

        .my-message {
            background: #007bff;
            color: white;
            margin-left: auto;
        }

        .input-area {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .input-area input {
            flex-grow: 1;
            margin-right: 10px;
        }
    </style>

    <div class="messages">
        @foreach($messages as $msg)
        <div class="message @if($msg->user_id == auth()->id()) my-message @endif">
            {{ $msg->content }}
        </div>
        @endforeach
    </div>

    <div class="input-area">
        <input type="text" wire:model="message" wire:keydown.enter="sendMessage">
        <button wire:click="sendMessage">إرسال</button>
    </div>
</div>