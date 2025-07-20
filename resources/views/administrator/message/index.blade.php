<x-admin.auth-layout>
    @include('administrator.message.style')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Message</h1>
    </div>

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Message</h6>
                </div>
                <div class="card-body">
                    <div class="chat-area">
                        <!-- chatlist -->
                        <div class="chatlist">
                            <div class="modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="chat-header">
                                        <div class="msg-search">
                                            {{-- <input type="text" class="w-100 form-control" id="inlineFormInputGroup" placeholder="Search" aria-label="search"> --}}
                                        </div>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <span class="nav-link active" style="padding-bottom:20px;" id="Open-tab"
                                                    data-bs-toggle="tab" data-bs-target="#Open"
                                                    type="button" role="tab" aria-controls="Open"
                                                    aria-selected="true">List of Users</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="modal-body">
                                        <!-- chat-list -->
                                        <div class="chat-lists">
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="Open"
                                                    role="tabpanel" aria-labelledby="Open-tab">
                                                    <!-- chat-list -->
                                                    <div class="chat-list">
                                                        @foreach ($users as $user)
                                                            <a 
                                                                {{-- href="?uuid?={{ $user->uuid }}&id={{ $user->id }}"  --}}
                                                                onclick="get_chat({{ $user->id }})"
                                                                class="d-flex align-items-center {{ request()->id == $user->id ? 'bg-whitesmoke' : '' }} px-3 py-2" style="cursor: pointer">
                                                                <div class="flex-shrink-0">
                                                                    @if ($user->buyer_detail && $user->buyer_detail->profile_pict)
                                                                        <img src="{{ url('storage/'.$user->buyer_detail->profile_pict) }}" class="rounded-circle" style="width: 50px; height: 50px;" alt="">
                                                                    @else
                                                                        <img src="{{ asset("/img/temp-img-profile.png") }}" class="rounded-circle" style="width: 50px; height: 50px;" alt="">
                                                                    @endif
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h3>{{ $user->fname }}</h3>
                                                                    <p>{{ $user->type == 'seller' ? 'Seller' : 'Buyer' }}</p>
                                                                </div>
                                                                <div class="flex-grow-1 ms-3 text-end">
                                                                    @php
                                                                        $count_chat_user = $user->services()->where('state', null)->where('owner', 'user')->count();
                                                                    @endphp
                                                                    {!! $count_chat_user > 0 ? '<span id="userBadgeMessage" class="badge badge-danger">' . $count_chat_user . '</span>' : '' !!}
                                                                </div>
                                                            </a>                                                                                                                   
                                                        @endforeach
                                                    </div>
                                                    <!-- chat-list -->
                                                </div>
                                            </div>

                                        </div>
                                        <!-- chat-list -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- chatlist -->

                        <!-- chatbox -->
                        <div class="chatbox">
                            <div class="modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="msg-head">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="d-flex align-items-center">
                                                    <span class="chat-icon">
                                                        <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg" alt="image title">
                                                    </span>
                                                    <div class="flex-grow-1 ms-3" id="chatboxUserInfo">
                                                        <h3>Message History</h3>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <ul class="moreoption">
                                                    <li class="navbar nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </a>
                                                        {{-- <ul class="dropdown-menu">
                                                            <li>
                                                                <a id="removeChat" class="dropdown-item" href="#">Remove Chat</a>
                                                            </li>
                                                        </ul> --}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="chatBoxModla" class="modal-body">
                                        <div class="msg-body">
                                            <ul id="messageItem">
                                                @if ($services)
                                                    @include('administrator.message.item')
                                                @else
                                                    Please Click User
                                                @endif
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="send-box">
                                        <form action="{{ route('administrator.message.store') }}" id="send-message" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id">
                                            <input type="text" class="form-control" id="message-input" name="message" aria-label="message…" placeholder="Write message…">
                                            <button id="btn-submit" type="submit" disabled class="btn btn-primary">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i> 
                                                Send
                                            </button>
                                        </form>

                                        <div class="send-btns">
                                            <div class="attach">
                                                <div class="button-wrapper">
                                                    <span class="label">
                                                        <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/upload.svg" alt="image title"> 
                                                        Upload Image
                                                    </span>
                                                    <input type="file" name="upload" form="send-message" id="upload" class="upload-box" placeholder="Upload File" aria-label="Upload File" accept="image/jpeg, image/png">
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
    </div>

    @push('after-scripts')
        <script>

            function get_chat(id) {
                $.ajax({
                    url: `?id=${id}`,
                    type: "GET",
                    cache: false,
                    success:function(response) { 
                        render(response, id)
                        scrollToId($('#lastQuery').val())
                        updateBadgeMessage(response)
                    }
                });
            }
            
            function render(response, id) {
                var type = response.sender.type == 'seller' ? 'Seller' : 'Buyer';
                var name = response.sender.fname || response.sender.email || response.sender.phone;
                $("#messageItem").html("")
                $("#messageItem").append(response.html);
                $('#chatboxUserInfo p').text(type)
                $('#chatboxUserInfo h3').text(name)
                $('#btn-submit').prop('disabled', false);
                $('input[name=id').val(id)
            }

            function scroll_to_the_end() {
                var modalBody = $('.modal-body');
                modalBody.scrollTop(modalBody[0].scrollHeight);
            }

            function scrollToId(elementId) {
                var targetElement = $('#' + elementId);
                if (targetElement.length > 0) {
                    var scrollTopValue = targetElement.offset().top - $('#chatBoxModla').offset().top + $('#chatBoxModla').scrollTop();
                    $('#chatBoxModla').animate({
                        scrollTop: scrollTopValue
                    }, 0); // Adjust the duration as needed
                }
            }

            function updateBadgeMessage(response) {
                var badge_message = parseInt($('#badgeMessage').text());
                var new_count_chat_user = response.new_count_chat_user;
                var result = badge_message - new_count_chat_user;
                if (result == 0) {
                    $('#badgeMessage').remove();
                }
                $('#userBadgeMessage').remove();
                $('#badgeMessage').text(result);
            }

            $(document).ready(function() {

                $('#upload').on('change', function() {
                    var fileName = $(this).val().split('\\').pop();
                    if (fileName) {
                        $('.label').html('<img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/upload.svg" alt="image title">' + fileName);
                    } else {
                        $('.label').html('<img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/upload.svg" alt="image title"> Upload Image');
                    }
                });

                $(".chat-list a").click(function() {
                    $(".chatbox").addClass('showbox');
                    return false;
                });

                $(".chat-icon").click(function() {
                    $(".chatbox").removeClass('showbox');
                });

                $('#btn-submit').on('click', function(e) {
                    e.preventDefault();
                    var messageInput = $('#message-input');
                    if (messageInput.val() === '') {
                        messageInput.css('border-color', 'red');
                            return;
                        } else {
                            messageInput.css('border-color', '');
                        }
                    var formData = new FormData($('#send-message')[0]);
                    $.ajax({
                        url: "{{ route('administrator.message.store') }}",
                        type: "POST",
                        data: formData,
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(response) {
                            render(response, response.id)
                            $('#send-message')[0].reset();
                            scrollToId($('#lastQuery').val())
                        },
                        error: function(xhr, status, error) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = "";
                            $.each(errors, function(key, value) {
                                errorMessage += value + "\n";
                            });

                            alert("Errors: \n" + errorMessage);
                        }
                    });
                });

            });
        </script>
    @endpush
</x-admin.auth-layout>
