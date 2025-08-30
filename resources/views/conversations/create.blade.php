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
                            <div class="user_info">
                                <span><strong id="receiver_name">Nouvelle Conversation</strong></span>
                                <p class="mb-0">Démarrer un nouveau chat</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body msg_card_body chat-scroll">
                        <form action="{{ route('conversations.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="recipients" class="form-label">Destinataires</label>
                                <select name="recipient_ids[]" id="recipients" class="form-control" multiple required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ in_array($user->id, request('recipient_ids', [])) ? 'selected' : '' }}>{{ $user->prenom }} {{ $user->nom }}</option>
                                    @endforeach
                                </select>
                                @error('recipient_ids') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Sujet (Optionnel)</label>
                                <input type="text" name="subject" id="subject" class="form-control">
                                @error('subject') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message_body" class="form-label">Message</label>
                                <textarea name="body" id="message_body" class="form-control" rows="5" required></textarea>
                                @error('body') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Démarrer la conversation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection