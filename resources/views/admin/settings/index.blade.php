@extends('admin.layouts.app')

@section('title', 'Paramètres du Site')

@push('styles')
<style>
.settings-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 30px;
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
}

.settings-header h1 {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
}

.settings-header p {
    margin: 10px 0 0 0;
    opacity: 0.9;
    font-size: 1rem;
}

.settings-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 25px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.settings-card:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    transform: translateY(-2px);
}

.settings-card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 20px 25px;
    border-bottom: 2px solid #28a745;
}

.settings-card-header h5 {
    margin: 0;
    color: #2c3e50;
    font-weight: 600;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
}

.settings-card-header h5 i {
    margin-right: 12px;
    color: #28a745;
    font-size: 1.3rem;
}

.settings-card-body {
    padding: 30px 25px;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    font-size: 0.95rem;
}

.form-label i {
    margin-right: 8px;
    color: #28a745;
    width: 20px;
}

.form-label .required {
    color: #dc3545;
    margin-left: 4px;
}

.form-control, .form-select {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.15);
}

textarea.form-control {
    min-height: 100px;
    resize: vertical;
}

.btn-save {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border: none;
    color: white;
    padding: 14px 40px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1rem;
    box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    transition: all 0.3s ease;
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.4);
}

.btn-save i {
    margin-right: 8px;
}

.alert-custom {
    border-radius: 12px;
    border: none;
    padding: 18px 20px;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.alert-custom i {
    font-size: 24px;
    margin-right: 15px;
}

.section-divider {
    height: 2px;
    background: linear-gradient(to right, #28a745, transparent);
    margin: 35px 0;
}
</style>
@endpush

@section('content')
<!-- Header -->
<div class="settings-header">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h1><i class="fas fa-cog me-3"></i>Paramètres du Site</h1>
            <p>Gérez les informations et configurations de votre boutique</p>
        </div>
        <div>
            <i class="fas fa-store fa-3x opacity-50"></i>
        </div>
    </div>
</div>



@if(session('error'))
    <div class="alert alert-danger alert-custom">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')
    
    <!-- Configuration Générale -->
    <div class="settings-card">
        <div class="settings-card-header">
            <h5>
                <i class="fas fa-info-circle"></i>
                Informations Générales
            </h5>
        </div>
        <div class="settings-card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-store"></i>
                        Nom du site <span class="required">*</span>
                    </label>
                    <input type="text" 
                           class="form-control @error('site_name') is-invalid @enderror" 
                           name="site_name" 
                           value="{{ old('site_name', $settings['site_name'] ?? 'Fruitables') }}" 
                           placeholder="Nom de votre boutique"
                           required>
                    @error('site_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i>
                        Email de contact <span class="required">*</span>
                    </label>
                    <input type="email" 
                           class="form-control @error('contact_email') is-invalid @enderror" 
                           name="contact_email" 
                           value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" 
                           placeholder="contact@exemple.com"
                           required>
                    @error('contact_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-align-left"></i>
                    Description du site <span class="required">*</span>
                </label>
                <textarea class="form-control @error('site_description') is-invalid @enderror" 
                          name="site_description" 
                          rows="3" 
                          placeholder="Description de votre boutique..."
                          required>{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                @error('site_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-phone"></i>
                        Téléphone de contact <span class="required">*</span>
                    </label>
                    <input type="text" 
                           class="form-control @error('contact_phone') is-invalid @enderror" 
                           name="contact_phone" 
                           value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" 
                           placeholder="+33 1 23 45 67 89"
                           required>
                    @error('contact_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="fas fa-coins"></i>
                        Devise <span class="required">*</span>
                    </label>
                    <select class="form-select @error('currency') is-invalid @enderror" name="currency" required>
                        <option value="EUR" {{ (old('currency', $settings['currency'] ?? 'EUR') == 'EUR') ? 'selected' : '' }}>EUR (€)</option>
                        <option value="USD" {{ (old('currency', $settings['currency'] ?? 'EUR') == 'USD') ? 'selected' : '' }}>USD ($)</option>
                        <option value="GBP" {{ (old('currency', $settings['currency'] ?? 'EUR') == 'GBP') ? 'selected' : '' }}>GBP (£)</option>
                        <option value="MAD" {{ (old('currency', $settings['currency'] ?? 'EUR') == 'MAD') ? 'selected' : '' }}>MAD (DH)</option>
                    </select>
                    @error('currency')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-map-marker-alt"></i>
                    Adresse <span class="required">*</span>
                </label>
                <input type="text" 
                       class="form-control @error('address') is-invalid @enderror" 
                       name="address" 
                       value="{{ old('address', $settings['address'] ?? '') }}" 
                       placeholder="123 Rue des Fruits, 75001 Paris, France"
                       required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    
    <!-- Configuration Commerciale -->
    <div class="settings-card">
        <div class="settings-card-header">
            <h5>
                <i class="fas fa-shopping-cart"></i>
                Configuration Commerciale
            </h5>
        </div>
        <div class="settings-card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        <i class="fas fa-percent"></i>
                        Taux de TVA (%) <span class="required">*</span>
                    </label>
                    <input type="number" 
                           class="form-control @error('tax_rate') is-invalid @enderror" 
                           name="tax_rate" 
                           value="{{ old('tax_rate', $settings['tax_rate'] ?? '20') }}" 
                           step="0.1" 
                           min="0" 
                           max="100"
                           placeholder="20.0"
                           required>
                    @error('tax_rate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        <i class="fas fa-truck"></i>
                        Frais de port (€) <span class="required">*</span>
                    </label>
                    <input type="number" 
                           class="form-control @error('shipping_cost') is-invalid @enderror" 
                           name="shipping_cost" 
                           value="{{ old('shipping_cost', $settings['shipping_cost'] ?? '5.99') }}" 
                           step="0.01" 
                           min="0"
                           placeholder="5.99"
                           required>
                    @error('shipping_cost')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        <i class="fas fa-gift"></i>
                        Livraison gratuite à partir de (€) <span class="required">*</span>
                    </label>
                    <input type="number" 
                           class="form-control @error('free_shipping_threshold') is-invalid @enderror" 
                           name="free_shipping_threshold" 
                           value="{{ old('free_shipping_threshold', $settings['free_shipping_threshold'] ?? '50') }}" 
                           step="0.01" 
                           min="0"
                           placeholder="50.00"
                           required>
                    @error('free_shipping_threshold')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bouton Enregistrer -->
    <div class="text-end">
        <button type="submit" class="btn btn-save">
            <i class="fas fa-save"></i>
            Enregistrer les paramètres
        </button>
    </div>
</form>
@endsection