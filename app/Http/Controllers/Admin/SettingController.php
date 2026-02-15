<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        // Récupérer tous les paramètres depuis la base de données
        $settings = Setting::getAll();
        
        // Valeurs par défaut si les paramètres n'existent pas encore
        $defaultSettings = [
            'site_name' => 'Fruitables',
            'site_description' => 'Votre boutique de fruits et légumes frais en ligne',
            'contact_email' => 'contact@fruitables.com',
            'contact_phone' => '+33 1 23 45 67 89',
            'address' => '123 Rue des Fruits, 75001 Paris, France',
            'currency' => 'EUR',
            'tax_rate' => 20,
            'shipping_cost' => 5.99,
            'free_shipping_threshold' => 50,
        ];

        // Fusionner les paramètres par défaut avec ceux de la base de données
        $settings = array_merge($defaultSettings, $settings);

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:500',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'currency' => 'required|string|size:3',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'shipping_cost' => 'required|numeric|min:0',
            'free_shipping_threshold' => 'required|numeric|min:0',
        ]);

        // Sauvegarder chaque paramètre dans la base de données
        Setting::set('site_name', $validated['site_name'], 'string', 'Nom du site');
        Setting::set('site_description', $validated['site_description'], 'string', 'Description du site');
        Setting::set('contact_email', $validated['contact_email'], 'string', 'Email de contact');
        Setting::set('contact_phone', $validated['contact_phone'], 'string', 'Téléphone de contact');
        Setting::set('address', $validated['address'], 'string', 'Adresse postale');
        Setting::set('currency', $validated['currency'], 'string', 'Devise utilisée');
        Setting::set('tax_rate', $validated['tax_rate'], 'float', 'Taux de TVA');
        Setting::set('shipping_cost', $validated['shipping_cost'], 'float', 'Frais de port');
        Setting::set('free_shipping_threshold', $validated['free_shipping_threshold'], 'float', 'Seuil de livraison gratuite');

        return back()->with('success', 'Paramètres mis à jour avec succès !');
    }
}
