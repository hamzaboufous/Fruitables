@extends('admin.layouts.app')

@section('title', 'Messages')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Messages</h1>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des Messages</h5>
    </div>
    <div class="card-body">
        @if($messages->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Sujet</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->short_message }}</td>
                        <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        <td>{!! $message->status_badge !!}</td>
                        <td>
                            <div class="d-flex gap-1 justify-content-center">
                                <!-- Bouton View (vert) -->
                                <a href="{{ route('admin.messages.show', $message) }}" 
                                   class="btn btn-sm btn-success text-white"
                                   style="padding: 4px 10px; font-size: 13px; border-radius: 4px;"
                                   title="Voir">
                                    <i class="fas fa-eye me-1"></i>View
                                </a>
                                
                                <!-- Bouton Delete (rouge) -->
                                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger text-white" 
                                            style="padding: 4px 8px; font-size: 13px; border-radius: 4px;"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')"
                                            title="Supprimer">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-4">
            <i class="fas fa-envelope fa-3x text-muted mb-3"></i>
            <p class="text-muted">Aucun message trouvé</p>
        </div>
        @endif
    </div>
</div>
@endsection