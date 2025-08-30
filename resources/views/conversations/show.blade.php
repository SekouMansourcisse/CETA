@extends('layouts.template')

@section('content')
    <div class="col-lg-12">
        <div class="row chat-window">
            <div class="col-lg-5 col-xl-4 chat-cont-left">
                <!-- This is the left panel, which should ideally be the conversation list -->
                <!-- For now, we'll just put a link back to the index -->
                <div class="card mb-sm-3 mb-md-0 contacts_card flex-fill d-flex align-items-center justify-content-center">
                    <a href="{{ route('conversations.index') }}" class="btn btn-primary">Retour à la liste des conversations</a>
                </div>
            </div>

            <div class="col-lg-7 col-xl-8 chat-cont-right">
                <div class="card mb-0">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <a id="back_user_list" href="{{ route('conversations.index') }}" class="back-user-list">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <div class="img_cont">
                                <img class="rounded-circle user_img" src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="">
                            </div>
                            <div class="user_info">
                                <span><strong id="receiver_name">
                                    @foreach ($conversation->users as $participant)
                                        @if ($participant->id !== Auth::id())
                                            {{ $participant->prenom }} {{ $participant->nom }}{{ !$loop->last ? ', ' : '' }}
                                        @endif
                                    @endforeach
                                </strong></span>
                                <p class="mb-0">Messages</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body msg_card_body chat-scroll">
                        <ul class="list-unstyled">
                            @forelse ($conversation->messages->sortBy('created_at') as $message)
                                <li class="media {{ $message->user_id === Auth::id() ? 'sent' : 'received' }} d-flex">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/customer/customer5.jpg') }}" alt="User Image" class="avatar-img rounded-circle">
                                    </div>
                                    <div class="media-body flex-grow-1">
                                        <div class="msg-box">
                                            <div>
                                                <p>{{ $message->body }}</p>
                                                <ul class="chat-msg-info">
                                                    <li>
                                                        <div class="chat-time">
                                                            <span>{{ $message->created_at->format('H:i A') }}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center text-muted">Aucun message dans cette conversation.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('conversations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                            <div class="input-group">
                                <input name="body" class="form-control type_msg mh-auto empty_check" placeholder="Type your message...">
                                <button type="submit" class="btn btn-primary btn_send"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection