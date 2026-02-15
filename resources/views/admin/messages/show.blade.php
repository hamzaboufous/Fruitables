@extends('admin.layouts.app')

@section('title', 'Détails du Message')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Détails du Message</h1>
    <div>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $message->subject }}</h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Nom:</strong> {{ $message->name }}</p>
                <p><strong>Email:</strong> <a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
            </div>
            <div class="col-md-6">
                <p><strong>Date:</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Statut:</strong> {!! $message->status_badge !!}</p>
            </div>
        </div>
        
        <div class="border-top pt-3">
            <h6>Message:</h6>
            <div class="bg-light p-3 rounded">
                <p class="mb-0">{{ nl2br($message->message) }}</p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message?')">
                <i class="fas fa-trash"></i> Supprimer
            </button>
        </form>
        <a href="mailto:{{ $message->email }}" class="btn btn-primary">
            <i class="fas fa-reply"></i> Répondre
        </a>
    </div>
</div>
@endsection
