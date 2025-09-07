<div>
    <div class="messages-container">
        @foreach($messages as $message)
            <div class="message {{ $message->user_id === auth()->id() ? 'mine' : '' }}">
                <div class="user">{{ $message->user->name }}</div>
                <div class="content">{{ $message->content }}</div>
                <div class="time">{{ $message->created_at->diffForHumans() }}</div>
            </div>
        @endforeach
    </div>

    <form wire:submit.prevent="sendMessage" class="flex items-center space-x-2 mt-4">
        <textarea
            wire:model="message"
            class="flex-1 p-2 border rounded resize-none focus:outline-none focus:ring-2 focus:ring-blue-500
                bg-white text-gray-900
                dark:bg-gray-800 dark:text-gray-100 dark:border-gray-700 dark:focus:ring-blue-400"
            rows="2"
            placeholder="Type your message..."></textarea>
        <button
            type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700
                dark:bg-blue-500 dark:hover:bg-blue-600 dark:text-white">
            Send
        </button>
    </form>
</div>
