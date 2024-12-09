@extends('layout.master')
@section('content')
    <div class="col-span-12">
        <div class="chat-wrapper flex">
            <div
                class="group offcanvas 2xl:!left-0 2xl:visible 2xl:shadow-none 2xl:bg-transparent dark:2xl:bg-transparent !w-auto 2xl:relative offcanvas-start chat-offcanvas"
                tabindex="-1"
                id="offcanvas_User_list"
            >
                <div class="offcanvas-header 2xl:!hidden !justify-end">
                    <button
                        data-pc-dismiss="#offcanvas_User_list"
                        class="text-lg flex items-center justify-center rounded w-7 h-7 text-secondary-500 hover:bg-danger-500/10 hover:text-danger-500"
                    >
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <div class="offcanvas-body !p-0">
                    <div id="chat-user_list" class="show collapse-horizontal">
                        <div class="chat-user_list w-[310px] ltr:mr-6 ltr:max-2xl:ml-6 rtl:ml-6 rtl:max-2xl:mr-6">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <h5 class="mb-4">
                                        Messages
                                    </h5>
                                </div>
                                <div class="scroll-block h-[calc(100vh_-_480px)] group-[.show]:h-[calc(100vh_-_410px)]">
                                    <div class="card-body !p-0">
                                        <div
                                            class="list-group *:block *:px-[25px] divide-y divide-inherit border-theme-border dark:border-themedark-border"
                                        >
                                            @foreach($conversations as $conversation)
                                            <a href="{{ route('messaging.show', $conversation->id) }}" class="list-group-item list-group-item-action p-3">
                                                <div class="flex items-center">
                                                    <div class="chat-avtar relative">
                                                        <img class="rounded-full w-10" src="https://ui-avatars.com/api/?name={{ $conversation->name }}" alt="User image" />
                                                    </div>
                                                    <div class="grow mx-2">
                                                        <h6 class="mb-0">
                                                            {{ $conversation->name }}
                                                            <span class="ltr:float-right rtl:float-left text-sm text-muted f-w-400">{{ \Carbon\Carbon::parse($conversation->updated_at)->diffForHumans() }}</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body !p-0">
                                    <div
                                        class="list-group *:block *:px-[25px] *:py-3 divide-y divide-inherit border-theme-border dark:border-themedark-border"
                                    >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-content flex-auto min-w-[1%]">
                <div class="card mb-0">
                    <div class="card-header !p-3">
                        <div class="flex items-center">
                            <ul class="flex items-center *:mr-1 ltr:mr-auto rtl:ml-auto mb-0">
                                <li class="list-inline-item align-bottom">
                                    <a
                                        href="#"
                                        class="2xl:hidden w-10 h-10 rounded-xl inline-flex items-center justify-center btn-link-secondary"
                                        data-pc-toggle="offcanvas"
                                        data-pc-target="#offcanvas_User_list"
                                    >
                                        <i class="ti ti-menu-2 text-lg leading-none"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="hidden 2xl:inline-flex w-10 h-10 rounded-xl items-center justify-center btn-link-secondary"
                                        data-pc-toggle="collapse"
                                        data-pc-target="#chat-user_list"
                                    >
                                        <i class="ti ti-menu-2 text-lg leading-none"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="flex items-center *:ml-1 ltr:ml-auto rtl:mr-auto mb-0">
                                <li class="list-inline-item">
                                    <a
                                        href="#"
                                        class="2xl:hidden w-10 h-10 rounded-xl inline-flex items-center justify-center btn-link-secondary"
                                        data-pc-toggle="offcanvas"
                                        data-pc-target="#offcanvas_User_info"
                                    >
                                        <i class="ti ti-info-circle text-lg leading-none"></i>
                                    </a>
                                    <a
                                        href="#"
                                        class="hidden 2xl:inline-flex w-10 h-10 rounded-xl items-center justify-center btn-link-secondary"
                                        data-pc-toggle="collapse"
                                        data-pc-target="#chat-user_info"
                                    >
                                        <i class="ti ti-info-circle text-lg leading-none"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="scroll-block chat-message h-[calc(100vh_-_480px)]">
                        <div class="card-body">
                            @foreach($currentConversation->messages as $message)
                                @if($message->sender->id === auth()->user()->id)
                                <div class="message-out mb-3" data-messageid="{{ $message->id }}">
                                    <div class="flex items-end flex-col">
                                        <div class="message flex items-end flex-col">
                                            <div class="group flex items-center mb-1 chat-msg">
                                                <div class="shrink-0">
                                                    <ul class="opacity-0 group-hover:opacity-100 flex items-center ml-auto mb-0 *:mr-1 chat-msg-option">
                                                        <li class="list-inline-item">
                                                            <a
                                                                id="messageInfoBtn"
                                                                data-messageId="{{ $message->id }}"
                                                                href="#"
                                                                class="2xl:hidden w-10 h-10 rounded-xl inline-flex items-center justify-center btn-link-secondary"
                                                                data-pc-toggle="offcanvas"
                                                                data-pc-target="#offcanvas_Message_info"
                                                            >
                                                                <i class="ti ti-info-circle text-lg leading-none"></i>
                                                            </a>
                                                            <a
                                                                id="messageInfoBtn"
                                                                data-messageId="{{ $message->id }}"
                                                                href="#"
                                                                class="hidden 2xl:inline-flex w-10 h-10 rounded-xl items-center justify-center btn-link-secondary"
                                                                data-pc-toggle="collapse"
                                                                data-pc-target="#chat-message_info"
                                                            >
                                                                <i class="ti ti-info-circle text-lg leading-none"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="grow ml-3">
                                                    <div class="msg-content py-3 px-4 bg-primary-500 text-white rounded">
                                                        <p class="mb-0">{{ $message->content }}</p>
                                                        @foreach($message->attachments as $attachment)
                                                            <a href="{{ $attachment->file_path }}" download=""><span class="ti ti-paperclip"></span> {{ $attachment->file_name }} </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="fa fa-check-double text-success {{ !$message->isReadByAnyone() ?  'hidden' : ''}}" id="readIcon"></span>
                                            <p class="mb-1 text-muted inline"><small>{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</small></p>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="message-in mb-3" data-messageid="{{ $message->id }}">
                                    <div class="flex">
                                        <div class="shrink-0">
                                            <div class="chat-avtar shrink-0 relative">
                                                <img class="rounded-full w-10" src="https://ui-avatars.com/api/?name={{ $message->sender->name }}" alt="User image" />
                                            </div>
                                        </div>
                                        <div class="grow mx-3">
                                            <div class="d-flex align-items-start flex-column">
                                                <div class="message flex items-start flex-col">
                                                    <div class="group flex items-center mb-1 chat-msg">
                                                        <div class="flex-grow-1 me-3">
                                                            <div class="msg-content py-3 px-4 rounded card mb-0">
                                                                <p class="mb-0">{{ $message->content }}</p>
                                                                @foreach($message->attachments as $attachment)
                                                                    <a href="{{ $attachment->file_path }}" download=""><span class="ti ti-paperclip"></span> {{ $attachment->file_name }} </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <ul class="opacity-0 group-hover:opacity-100 flex items-center ml-auto mb-0 *:ml-1 chat-msg-option">
                                                                <li class="list-inline-item">
                                                                    <a
                                                                        id="messageInfoBtn"
                                                                        data-messageId="{{ $message->id }}"
                                                                        href="#"
                                                                        class="2xl:hidden w-10 h-10 rounded-xl inline-flex items-center justify-center btn-link-secondary"
                                                                        data-pc-toggle="offcanvas"
                                                                        data-pc-target="#offcanvas_Message_info"
                                                                    >
                                                                        <i class="ti ti-info-circle text-lg leading-none"></i>
                                                                    </a>
                                                                    <a
                                                                        id="messageInfoBtn"
                                                                        data-messageId="{{ $message->id }}"
                                                                        href="#"
                                                                        class="hidden 2xl:inline-flex w-10 h-10 rounded-xl items-center justify-center btn-link-secondary"
                                                                        data-pc-toggle="collapse"
                                                                        data-pc-target="#chat-message_info"
                                                                    >
                                                                        <i class="ti ti-info-circle text-lg leading-none"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mb-1 text-muted">
                                                    {{ $message->sender->name }}
                                                    <small>{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer !py-2 px-3">
                        <textarea class="form-control border-0 shadow-none" id="newMessageText" placeholder="Type a Message" rows="2"></textarea>
                        <hr class="my-2 border-0 border-t border-theme-border dark:border-themedark-border" />
                        <div class="flex items-center">
                            <ul class="flex items-center *:ml-1 mr-auto mb-0">
                                <li class="list-inline-item">
                                    <a href="#" class="w-8 h-8 rounded-md inline-flex items-center justify-center btn-link-secondary" id="attachmentIcon">
                                        <i class="ti ti-paperclip text-lg leading-none"></i>
                                    </a>
                                    <input type="file" id="messageAttachment" class="hidden" />
                                    <span class="hidden badge bg-primary text-white" id="attachmentName"></span>
                                </li>
                            </ul>
                            <ul class="flex items-center ml-auto mb-0">
                                <li class="list-inline-item">
                                    <a href="#" id="sendMessageButton" class="w-10 h-10 rounded-xl inline-flex items-center justify-center btn-link-primary">
                                        <i class="ti ti-send text-lg leading-none"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="group offcanvas 2xl:!right-0 2xl:visible 2xl:shadow-none 2xl:bg-transparent dark:2xl:bg-transparent !w-auto 2xl:relative offcanvas-end chat-offcanvas"
                tabindex="-1"
                id="offcanvas_User_info"
            >
                <div class="offcanvas-header 2xl:!hidden !justify-end">
                    <button
                        data-pc-dismiss="#offcanvas_User_info"
                        class="text-lg flex items-center justify-center rounded w-7 h-7 text-secondary-500 hover:bg-danger-500/10 hover:text-danger-500"
                    >
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <div class="offcanvas-body !p-0">
                    <div id="chat-user_info" class="collapse-horizontal 2xl:hidden">
                        <div class="chat-user_info w-[300px] ltr:ml-6 ltr:max-2xl:mr-6 rtl:mr-6 rtl:max-2xl:ml-6">
                            <div class="card">
                                <div class="text-center card-body position-relative pb-0">
                                    <h5 class="text-start">Conversation Details</h5>
                                    <div class="absolute ltr:right-0 rtl:left-0 top-0 p-[25px] hidden 2xl:inline-flex">
                                        <a
                                            class="w-6 h-6 rounded-xl inline-flex items-center justify-center btn-link-danger dropdown-toggle arrow-none"
                                            href="#"
                                            data-pc-toggle="collapse"
                                            data-pc-target="#chat-user_info"
                                        >
                                            <i class="ti ti-x text-lg leading-none"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="scroll-block h-[calc(100vh_-500px)] group-[.show]:h-[calc(100vh_-_415px)]">
                                    <div class="card-body">
                                        <div class="grid grid-cols-12 gap-2 mb-3">
                                            <div class="col-span-6">
                                                <div class="p-3 rounded-lg bg-primary-500/10">
                                                    <p class="mb-1 text-primary-500">Files</p>
                                                    <div class="flex items-center">
                                                        <i class="ti ti-folder text-2xl leading-none text-primary-500"></i>
                                                        <h4 class="mb-0 ms-2">{{ $currentConversation->messageAttachments()->count() }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-6">
                                                <div class="p-3 rounded-lg bg-secondary-500/10">
                                                    <p class="mb-1 text-secondary-500">Messages</p>
                                                    <div class="flex items-center">
                                                        <i class="ti ti-message text-2xl leading-none text-secondary-500"></i>
                                                        <h4 class="mb-0 ms-2">{{ $currentConversation->messages->count() }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-3 border-0 border-t border-theme-border dark:border-themedark-border" />
                                        <button
                                            class="btn border-0 p-0 text-left w-full flex items-center justify-between"
                                            type="button"
                                            data-pc-toggle="collapse"
                                            data-pc-target="#participants"
                                            aria-expanded="false"
                                            aria-controls="participants"
                                        >
                                            <span class="h5">Participants</span>
                                            <i class="ti ti-chevron-down"></i>
                                        </button>
                                        <div class="show" id="participants">
                                            <div class="py-3">
                                                @foreach($currentConversation->users as $user)
                                                <div id="participantContainer" class="flex items-center justify-between mb-2">
                                                    <p class="mb-0">{{ $user->name }}</p>
                                                    <p class="mb-0 text-muted">
                                                        <a href="#" data-userid="{{ $user->id }}" class="w-8 h-8 rounded-md inline-flex items-center justify-center btn-link-secondary" id="removeUserBtn">
                                                            <i class="ti ti-circle-x text-lg leading-none"></i>
                                                        </a>
                                                    </p>
                                                </div>
                                                <hr class="my-3 border-0 border-t border-theme-border dark:border-themedark-border" />
                                                @endforeach
                                                <div class="flex items-center justify-between mb-2" id="AddparticipantsContainer">
                                                        <select
                                                            class="form-control"
                                                            name="user_id"
                                                            id="Addparticipants"
                                                        ></select>
                                                    </div>
                                            </div>
                                        </div>
                                        <hr class="my-3 border-0 border-t border-theme-border dark:border-themedark-border" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="group offcanvas 2xl:!right-0 2xl:visible 2xl:shadow-none 2xl:bg-transparent dark:2xl:bg-transparent !w-auto 2xl:relative offcanvas-end chat-offcanvas"
                tabindex="-1"
                id="offcanvas_Message_info"
            >
                <div class="offcanvas-header 2xl:!hidden !justify-end">
                    <button
                        data-pc-dismiss="#offcanvas_Message_info"
                        class="text-lg flex items-center justify-center rounded w-7 h-7 text-secondary-500 hover:bg-danger-500/10 hover:text-danger-500"
                    >
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <div class="offcanvas-body !p-0">
                    <div id="chat-message_info" class="collapse-horizontal 2xl:hidden">
                        <div class="chat-message_info w-[300px] ltr:ml-6 ltr:max-2xl:mr-6 rtl:mr-6 rtl:max-2xl:ml-6">
                            <div class="card">
                                <div class="text-center card-body position-relative pb-0">
                                    <h5 class="text-start">Message Reads</h5>
                                    <div class="absolute ltr:right-0 rtl:left-0 top-0 p-[25px] hidden 2xl:inline-flex">
                                        <a
                                            class="w-6 h-6 rounded-xl inline-flex items-center justify-center btn-link-danger dropdown-toggle arrow-none"
                                            href="#"
                                            data-pc-toggle="collapse"
                                            data-pc-target="#chat-message_info"
                                        >
                                            <i class="ti ti-x text-lg leading-none"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="scroll-block h-[calc(100vh_-500px)] group-[.show]:h-[calc(100vh_-_415px)]">
                                    <div class="card-body">
                                        <div class="show" id="messageReads">
                                            <div class="py-3" id="messageReadsContainer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('post-scripts')
    <!-- [Page Specific JS] start -->
    <script>
        // scroll-block
        var tc = document.querySelectorAll('.scroll-block');
        for (var t = 0; t < tc.length; t++) {
            new SimpleBar(tc[t]);
        }
        setTimeout(function () {
            var element = document.querySelector('.chat-content .scroll-block .simplebar-content-wrapper');
            var elementheight = document.querySelector('.chat-content .scroll-block .simplebar-content');
            var off = elementheight.getBoundingClientRect();
            var h = off.height;
            element.scrollTop += h;
        }, 100);

        // Send message on button click
        document.getElementById('sendMessageButton').addEventListener('click', sendMessage);

        // Send message on Enter key press
        document.getElementById('newMessageText').addEventListener('keydown', (event) => {
            if (event.key === 'Enter' && !event.shiftKey) { // Prevent Shift+Enter from submitting
                event.preventDefault();
                sendMessage();
            }
        });

        function sendMessage() {
            const content = document.getElementById('newMessageText').value.trim();
            const fileInput = document.getElementById('messageAttachment');  // Get the file input element
            const file = fileInput.files[0]; // Get the selected file

            if (content === "" && !file) return; // Prevent empty messages and no file

            const formData = new FormData();  // Create a FormData object

            formData.append('content', content); // Append the message content
            formData.append('conversation_id', '{{ $currentConversation->id }}'); // Add conversation ID

            if (file) {
                formData.append('attachments', file); // Append the file (if any)
            }

            // Send the message and file using fetch
            fetch('/api/conversations/{{ $currentConversation->id }}/messages', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,  // Use FormData as the body
            })
                .then(response => {
                    if (!response.ok) {
                        Toast.fire({
                            icon: 'error',
                            title: `HTTP error! Status: ${response.status}`
                        });                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('newMessageText').value = ""; // Clear the textarea
                    fileInput.value = ""; // Clear the file input
                })
                .catch(error => console.error('Error:', error));
        }

    </script>
@endsection

@section('pre-scripts')
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="{{ asset('js/plugins/choices.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.Echo.private(`conversations.{{ $currentConversation->id }}`)
                .listen('MessageSent', (message) => {
                    // Check if the message sender is the current user
                    const currentUserId = {{ auth()->id() }};
                    const isSender = message.sender_id === currentUserId;

                    // Build the HTML template
                    const template = isSender
                        ? `
                        <div class="message-out mb-3" data-messageid="${message.id}">
                            <div class="flex items-end flex-col">
                                <div class="message flex items-end flex-col">
                                    <div class="group flex items-center mb-1 chat-msg">
                                                <div class="shrink-0">
                                                    <ul class="opacity-0 group-hover:opacity-100 flex items-center ml-auto mb-0 *:mr-1 chat-msg-option">
                                                        <li class="list-inline-item">
                                                            <a
                                                                id="messageInfoBtn"
                                                                data-messageId="${message.id}"
                                                                href="#"
                                                                class="2xl:hidden w-10 h-10 rounded-xl inline-flex items-center justify-center btn-link-secondary"
                                                                data-pc-toggle="offcanvas"
                                                                data-pc-target="#offcanvas_Message_info"
                                                            >
                                                                <i class="ti ti-info-circle text-lg leading-none"></i>
                                                            </a>
                                                            <a
                                                                id="messageInfoBtn"
                                                                data-messageId="${message.id}"
                                                                href="#"
                                                                class="hidden 2xl:inline-flex w-10 h-10 rounded-xl items-center justify-center btn-link-secondary"
                                                                data-pc-toggle="collapse"
                                                                data-pc-target="#chat-message_info"
                                                            >
                                                                <i class="ti ti-info-circle text-lg leading-none"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                        <div class="grow ml-3">
                                            <div class="msg-content py-3 px-4 bg-primary-500 text-white rounded">
                                                <p class="mb-0">${message.content}</p>
                                                ${message.attachments.map(attachment => `
                                                    <a href="${attachment.file_path}" download>
                                                        <span class="ti ti-paperclip"></span> ${attachment.file_name}
                                                    </a>
                                                `).join('')}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="fa fa-check-double hidden text-success" id="readIcon"></span>
                                    <p class="mb-1 text-muted inline">
                                        <small>${message.created_at}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        `
                        : `
                <div class="message-in mb-3" data-messageid="${message.id}">
                    <div class="flex">
                        <div class="shrink-0">
                            <div class="chat-avtar shrink-0 relative">
                                <img class="rounded-full w-10" src="https://ui-avatars.com/api/?name=${encodeURIComponent(message.sender_name)}" alt="User image" />
                            </div>
                        </div>
                        <div class="grow mx-3">
                            <div class="d-flex align-items-start flex-column">
                                <div class="message flex items-start flex-col">
                                    <div class="group flex items-center mb-1 chat-msg">
                                        <div class="flex-grow-1 me-3">
                                            <div class="msg-content py-3 px-4 rounded card mb-0">
                                                <p class="mb-0">${message.content}</p>
                                                ${message.attachments.map(attachment => `
                                                    <a href="${attachment.file_path}" download>
                                                        <span class="ti ti-paperclip"></span> ${attachment.file_name}
                                                    </a>
                                                `).join('')}
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="opacity-0 group-hover:opacity-100 flex items-center ml-auto mb-0 *:ml-1 chat-msg-option">
                                                <li class="list-inline-item">
                                                    <a
                                                        id="messageInfoBtn"
                                                        data-messageId="${message.id}"
                                                        href="#"
                                                        class="2xl:hidden w-10 h-10 rounded-xl inline-flex items-center justify-center btn-link-secondary"
                                                        data-pc-toggle="offcanvas"
                                                        data-pc-target="#offcanvas_Message_info"
                                                    >
                                                        <i class="ti ti-info-circle text-lg leading-none"></i>
                                                    </a>
                                                    <a
                                                        id="messageInfoBtn"
                                                        data-messageId="${message.id}"
                                                        href="#"
                                                        class="hidden 2xl:inline-flex w-10 h-10 rounded-xl items-center justify-center btn-link-secondary"
                                                        data-pc-toggle="collapse"
                                                        data-pc-target="#chat-message_info"
                                                    >
                                                        <i class="ti ti-info-circle text-lg leading-none"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <p class="mb-1 text-muted">
                                    ${message.sender_name}
                                    <small>${message.created_at}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                    // Append the new message to the container
                    const container = document.querySelector('.chat-content .scroll-block .simplebar-content .card-body');
                    if (container) {
                        container.insertAdjacentHTML('beforeend', template);
                        // Optionally, scroll to the bottom of the container
                        var element = document.querySelector('.chat-content .scroll-block .simplebar-content-wrapper');
                        var elementheight = document.querySelector('.chat-content .scroll-block .simplebar-content');
                        var off = elementheight.getBoundingClientRect();
                        var h = off.height;
                        element.scrollTop += h;
                        if (!isSender) {
                            markMessageAsRead(message.id);
                        }
                    }
                })
            window.Echo.private(`conversations.{{ $currentConversation->id }}`)
                .listen('MessageRead', (read) => {
                    let readMessage = document.querySelector('.message-out[data-messageid="'+read.message_id+'"]');
                    readMessage?.querySelector('#readIcon').classList.remove('hidden');
                });



            const conversationId = {{ $currentConversation->id }};

            fetch(`{{ route('messaging.markAllAsRead', $currentConversation->id) }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    conversation_id: conversationId,
                }),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Failed to mark messages as read');
                    }
                    return response.json();
                })
                .then((data) => {
                })
                .catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error marking messages as read.'
                    });
                });

        });
        function markMessageAsRead(messageId) {
            fetch(`/messaging/${messageId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    message_id: messageId,
                }),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Failed to mark message as read');
                    }
                    return response.json();
                })
                .then((data) => {
                    // Optionally update UI to reflect the read status
                    const messageElement = document.querySelector(`#message-${messageId}`);
                    if (messageElement) {
                        messageElement.querySelector('#readIcon').classList.remove('hidden');
                    }
                })
                .catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error marking message as read:', error
                    });
                });
        }

        document.getElementById('attachmentIcon').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('messageAttachment').click(); // Trigger the file input
        });

        document.addEventListener('click', function(e) {
            const removeUserButton = e.target.closest('#removeUserBtn');
            if (removeUserButton) {
                e.preventDefault();
                const conversationId = {{ $currentConversation->id }};
                const userId = removeUserButton.dataset.userid;

                // Ensure both conversation ID and user ID are available
                if (!conversationId || !userId) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Conversation ID or User ID is missing.'
                    });
                    return;
                }

                // Send the API request to remove the user
                fetch(`/conversations/${conversationId}/remove-user/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                    .then(response => {
                        if (!response.ok) {
                            Toast.fire({
                                icon: 'error',
                                title: `HTTP error! Status: ${response.status}`
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        Toast.fire({
                            icon: 'success',
                            title: 'User removed successfully'
                        });
                        // Optionally update the UI to reflect the change
                        const parentDiv = e.target.closest('#participantContainer');
                        // Remove the parent element and its following <hr>
                        if (parentDiv) {
                            const hrElement = parentDiv.nextElementSibling;
                            if (hrElement && hrElement.tagName === 'HR') {
                                hrElement.remove();
                            }
                            parentDiv.remove();
                        }
                    })
                    .catch(error => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Error removing user.'
                        });
                    });
            }

            const messageInfoBtn = e.target.closest('#messageInfoBtn');
            if (messageInfoBtn) {
                const messageId = messageInfoBtn.dataset.messageid;
                document.querySelector('#messageReadsContainer').innerHTML = '';
                fetch(`/api/messages/${messageId}/reads`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // If using CSRF
                    },
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.reads.length) {
                            data.reads.forEach((read) => {
                                let template = `
                                            <div class="flex items-center justify-between mb-2">
                                                <p class="mb-0">${read.user.name}</p>
                                                <p class="mb-0 text-muted">
                                                        ${read.read_at}
                                                </p>
                                            </div>
                                            <hr class="my-3 border-0 border-t border-theme-border dark:border-themedark-border" />`;

                                document.querySelector('#messageReadsContainer').innerHTML += template;
                            });
                        } else {
                            let template = `
                                            <div class="flex flex-col items-center justify-between mb-2">
                                                <p class="mb-0"><span class="ti ti-mood-empty text-5xl"></span> </p>
                                                <p class="mb-0 text-muted mt-3">
                                                        None read the message yet.
                                                </p>
                                            </div>
                                            <hr class="my-3 border-0 border-t border-theme-border dark:border-themedark-border" />`;
                            document.querySelector('#messageReadsContainer').innerHTML += template;

                        }
                    })
                    .catch(error => console.error('Error fetching message reads:', error));
            }
        });

        let participants = document.querySelector('#Addparticipants');
        var participantsChoices = new Choices('#Addparticipants', {
            placeholder: true,
            placeholderValue: 'Select User To Add To Chat',
            maxItemCount: 5,
            itemSelectText: '',
            shouldSort: false, // Optional: keeps the order of items as provided
        });
        participantsChoices.setChoices(function () {
            return fetch('{{ route('api.users.exclude', $currentConversation->id) }}')
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    return data.map(function (user) {
                        return {
                            value: user.id,
                            label: user.name,
                        }
                    });
                });
        });
        participants.addEventListener('choice', function(event) {
            const conversationId = {{ $currentConversation->id }};
            const userId = event.detail.value;
            const userName = event.detail.label;

            // Ensure both conversation ID and user ID are available
            if (!conversationId || !userId) {
                Toast.fire({
                    icon: 'error',
                    title: 'Conversation ID or User ID is missing.'
                });
                return;
            }

            // Send the API request to add the user
            fetch(`{{ route('conversation.addUser', $currentConversation->id) }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    user_id: userId,
                }),
            })
                .then(response => {
                    if (!response.ok) {
                        Toast.fire({
                            icon: 'error',
                            title: `HTTP error! Status: ${response.status}`
                        });                    }
                    return response.json();
                })
                .then(data => {
                    Toast.fire({
                        icon: 'success',
                        title: 'User added successfully'
                    });
                    // Optionally update the UI to reflect the change
                    // Build the HTML template
                    const template = `
                                                <div id="participantContainer" class="flex items-center justify-between mb-2">
                                                    <p class="mb-0">${userName}</p>
                                                    <p class="mb-0 text-muted">
                                                        <a href="#" data-userid="${userId}" class="w-8 h-8 rounded-md inline-flex items-center justify-center btn-link-secondary" id="removeUserBtn">
                                                            <i class="ti ti-circle-x text-lg leading-none"></i>
                                                        </a>
                                                    </p>
                                                </div>
                                                <hr class="my-3 border-0 border-t border-theme-border dark:border-themedark-border" />
                        `;
                    const addParticipantsContainer = document.querySelector('#AddparticipantsContainer');
                    if (addParticipantsContainer) {
                        // Insert the template before the #AddparticipantsContainer element
                        addParticipantsContainer.parentNode.insertBefore(
                            document.createRange().createContextualFragment(template),
                            addParticipantsContainer
                        );
                    }
                    participantsChoices.removeChoice(userId);
                })
                .catch(error => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error adding user.'
                    });
                });
        });


        // Optional: Handle file selection
        document.getElementById('messageAttachment').addEventListener('change', function(e) {
            const file = e.target.files[0];
            let attachmentNameContainer = document.querySelector('#attachmentName');

            if (file) {
                attachmentNameContainer.classList.remove('hidden');
                attachmentNameContainer.innerText = file.name;
            } else {
                attachmentNameContainer.classList.add('hidden');
                attachmentNameContainer.innerText = '';
            }
        });

    </script>
@endsection

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/choices.min.css') }}" />
@endsection
