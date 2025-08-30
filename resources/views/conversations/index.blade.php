@extends('layouts.template')

@section('content')
    <div class="col-lg-12">
        <div class="row chat-window">
            <div class="col-lg-5 col-xl-4 chat-cont-left">
                <div class="card mb-0 contacts_card flex-fill">
                    <div class="card-header chat-search">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="search_btn"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" placeholder="Search" class="form-control search-chat rounded-pill">
                        </div>
                    </div>

                    <!-- Tabs for Conversations and Users -->
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="conversations-tab" data-bs-toggle="tab" data-bs-target="#conversations" type="button" role="tab" aria-controls="conversations" aria-selected="true">Conversations</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="false">Utilisateurs</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <!-- Conversations Tab Content -->
                        <div class="tab-pane fade show active" id="conversations" role="tabpanel" aria-labelledby="conversations-tab">
                            <div class="card-body contacts_body chat-users-list chat-scroll">
                                @forelse ($conversations as $conversation)
                                    @php
                                        $latestMessage = $conversation->messages->first();
                                        $participantNames = $conversation->users->filter(function($user) { return $user->id !== Auth::id(); })->pluck('prenom')->implode(', ');
                                        $isUnread = !$conversation->users->find(Auth::id())->pivot->read_at;
                                    @endphp
                                    <a href="javascript:void(0);" class="media d-flex conversation-item {{ $isUnread ? 'active' : '' }}" data-conversation-id="{{ $conversation->id }}">
                                        <div class="media-img-wrap flex-shrink-0">
                                            <div class="avatar {{ $isUnread ? 'avatar-online' : 'avatar-away' }}">
                                                <img src="{{ asset('assets/img/customer/customer1.jpg') }}" alt="User Image" class="avatar-img rounded-circle">
                                            </div>
                                        </div>
                                        <div class="media-body flex-grow-1">
                                            <div>
                                                <div class="user-name">{{ $conversation->subject ?? $participantNames }}</div>
                                                <div class="user-last-chat">{{ $latestMessage ? Str::limit($latestMessage->body, 50) : 'Aucun message' }}</div>
                                            </div>
                                            <div>
                                                <div class="last-chat-time">{{ $latestMessage ? $latestMessage->created_at->diffForHumans() : '' }}</div>
                                                @if($isUnread)
                                                    <div class="badge badge-success badge-pill">New</div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-center text-muted">Aucune conversation trouvée.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Users Tab Content -->
                        <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                            <div class="card-body contacts_body chat-users-list chat-scroll">
                                @forelse ($allUsers as $user)
                                    <a href="javascript:void(0);" class="media d-flex user-item" data-user-id="{{ $user->id }}" data-user-name="{{ $user->prenom }} {{ $user->nom }}">
                                        <div class="media-img-wrap flex-shrink-0">
                                            <div class="avatar avatar-online">
                                                <img src="{{ asset('assets/img/customer/customer1.jpg') }}" alt="User Image" class="avatar-img rounded-circle">
                                            </div>
                                        </div>
                                        <div class="media-body flex-grow-1">
                                            <div>
                                                <div class="user-name">{{ $user->prenom }} {{ $user->nom }}</div>
                                                <div class="user-last-chat">Démarrer une conversation</div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-center text-muted">Aucun utilisateur trouvé.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-xl-8 chat-cont-right">
                <div class="card mb-0">
                    <!-- Chat Header -->
                    <div class="card-header msg_head" id="chat-header" style="display: none;">
                        <div class="d-flex bd-highlight">
                            <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <div class="img_cont">
                                <img class="rounded-circle user_img" src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="" id="chat-user-avatar">
                            </div>
                            <div class="user_info">
                                <span><strong id="receiver_name"></strong></span>
                                <p class="mb-0">Messages</p>
                            </div>
                        </div>
                    </div>

                    <!-- Chat Messages -->
                    <div class="card-body msg_card_body chat-scroll" id="chat-messages">
                        <div class="d-flex align-items-center justify-content-center h-100" id="no-chat-selected">
                            <p class="text-muted">Sélectionnez une conversation ou un utilisateur pour commencer à discuter.</p>
                        </div>
                        <ul class="list-unstyled" id="messages-list" style="display: none;">
                            <!-- Messages will be loaded here -->
                        </ul>
                    </div>

                    <!-- Chat Footer -->
                    <div class="card-footer" id="chat-footer" style="display: none;">
                        <form id="message-form">
                            @csrf
                            <input type="hidden" id="conversation_id" name="conversation_id">
                            <input type="hidden" id="recipient_user_id" name="recipient_user_id">
                            <div class="input-group">
                                <input class="form-control type_msg mh-auto" placeholder="Tapez votre message..." id="message-input" name="message">
                                <button type="submit" class="btn btn-primary btn_send">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
                let currentConversationId = null;
                let currentUserId = null;
                
                // Click sur un utilisateur pour démarrer une conversation
                $('.user-item').click(function() {
                    const userId = $(this).data('user-id');
                    const userName = $(this).data('user-name');
                    
                    // Marquer l'utilisateur comme sélectionné
                    $('.user-item, .conversation-item').removeClass('active');
                    $(this).addClass('active');
                    
                    // Requête AJAX pour trouver ou créer la conversation
                    $.ajax({
                        url: `/conversations/find-or-create/${userId}`,
                        method: 'GET',
                        success: function(response) {
                            if (response.success) {
                                currentConversationId = response.conversation_id;
                                $('#conversation_id').val(response.conversation_id);
                                $('#recipient_user_id').val(''); // Clear recipient_user_id once conversation is established
                                
                                // Load messages for the newly found/created conversation
                                loadConversation(response.conversation_id);
                                
                                // Update header with actual conversation participants
                                let participantNames = response.participants.filter(p => p.id != {{ Auth::id() }}).map(p => p.prenom + ' ' + p.nom).join(', ');
                                $('#receiver_name').text(response.conversation_subject || participantNames);

                            } else {
                                console.error('Erreur lors de la recherche/création de conversation:', response.message);
                                alert('Erreur lors de la recherche/création de conversation.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Erreur AJAX lors de la recherche/création de conversation:', error);
                            alert('Erreur AJAX lors de la recherche/création de conversation.');
                        }
                    });
                });

                // Click sur une conversation existante
                $('.conversation-item').click(function() {
                    const conversationId = $(this).data('conversation-id');
                    
                    // Marquer la conversation comme sélectionnée
                    $('.user-item, .conversation-item').removeClass('active');
                    $(this).addClass('active');
                    
                    loadConversation(conversationId);
                });

                // Charger une conversation existante
                function loadConversation(conversationId) {
                    currentConversationId = conversationId;
                    currentUserId = null;
                    
                    // Requête AJAX pour charger les messages
                    $.ajax({
                        url: `/conversations/${conversationId}/messages`,
                        method: 'GET',
                        success: function(response) {
                            if (response.success) {
                                displayMessages(response.messages);
                                showChatInterface(response.conversation.subject || 'Conversation');
                                $('#conversation_id').val(conversationId);
                                $('#recipient_user_id').val('');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Erreur lors du chargement de la conversation:', error);
                        }
                    });
                }

                // Afficher l'interface de chat
                function showChatInterface(title) {
                    $('#no-chat-selected').hide();
                    $('#chat-header').show();
                    $('#chat-footer').show();
                    $('#messages-list').show();
                    $('#receiver_name').text(title);
                }

                // Afficher les messages
                function displayMessages(messages) {
                    const messagesList = $('#messages-list');
                    messagesList.empty();
                    
                    messages.forEach(function(message) {
                        const isCurrentUser = message.user_id == {{ Auth::id() }};
                        const messageClass = isCurrentUser ? 'sent' : 'received';
                        const avatarSrc = '{{ asset("assets/img/customer/customer1.jpg") }}';
                        
                        const messageHtml = `
                            <li class="media ${messageClass} d-flex">
                                <div class="avatar flex-shrink-0">
                                    <img src="${avatarSrc}" alt="User Image" class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body flex-grow-1">
                                    <div class="msg-box">
                                        <div>
                                            <p>${message.body}</p>
                                            <ul class="chat-msg-info">
                                                <li>
                                                    <div class="chat-time">
                                                        <span>${new Date(message.created_at).toLocaleTimeString()}</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        `;
                        
                        messagesList.append(messageHtml);
                    });
                    
                    // Faire défiler vers le bas
                    scrollToBottom();
                }

                // Envoyer un message
                $('#message-form').submit(function(e) {
                    e.preventDefault();
                    
                    const messageText = $('#message-input').val().trim();
                    if (!messageText) return;
                    
                    const formData = {
                        body: messageText,
                        conversation_id: $('#conversation_id').val(),
                        recipient_user_id: $('#recipient_user_id').val(),
                        _token: $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val()
                    };
                    
                    $.ajax({
                        url: '{{ route("messages.store") }}',
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                // Ajouter le message à la liste
                                addMessageToList(response.message_data, response.message_data.user_id == {{ Auth::id() }});
                                
                                // Vider le champ de saisie
                                $('#message-input').val('');
                                
                                // Mettre à jour l'ID de conversation si c'est un nouveau chat
                                if (response.is_new_conversation) {
                                    currentConversationId = response.conversation_id;
                                    $('#conversation_id').val(response.conversation_id);
                                    $('#recipient_user_id').val('');
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Erreur lors de l\'envoi du message:', error);
                            alert('Erreur lors de l\'envoi du message');
                        }
                    });
                });

                // Ajouter un message à la liste
                function addMessageToList(message, isCurrentUser) {
                    const messageClass = isCurrentUser ? 'sent' : 'received';
                    const avatarSrc = '{{ asset("assets/img/customer/customer1.jpg") }}';
                    
                    const messageHtml = `
                        <li class="media ${messageClass} d-flex">
                            <div class="avatar flex-shrink-0">
                                <img src="${avatarSrc}" alt="User Image" class="avatar-img rounded-circle">
                            </div>
                            <div class="media-body flex-grow-1">
                                <div class="msg-box">
                                    <div>
                                        <p>${message.body}</p>
                                        <ul class="chat-msg-info">
                                            <li>
                                                <div class="chat-time">
                                                    <span>${new Date(message.created_at).toLocaleTimeString()}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    `;
                    
                    $('#messages-list').append(messageHtml);
                    scrollToBottom();
                }

                // Faire défiler vers le bas
                function scrollToBottom() {
                    const chatMessages = document.getElementById('chat-messages');
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }

                // Bouton retour
                $('#back_user_list').click(function() {
                    $('#no-chat-selected').show();
                    $('#chat-header').hide();
                    $('#chat-footer').hide();
                    $('#messages-list').hide();
                    $('.user-item, .conversation-item').removeClass('active');
                    currentConversationId = null;
                    currentUserId = null;
                });
            });
    </script>
@endpush