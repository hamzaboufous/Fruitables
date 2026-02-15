<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            // Redirect based on user role
            if (Auth::user()->is_admin) {
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Connexion administrateur réussie !');
            }
            
            return redirect()->intended(route('home'))->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->withInput($request->only('email', 'remember'));
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'city' => $validated['city'] ?? null,
            'state' => $validated['state'] ?? null,
            'postal_code' => $validated['postal_code'] ?? null,
            'country' => $validated['country'] ?? null,
        ]);

        Auth::login($user);

        // Créer une notification admin pour le nouveau client
        \App\Models\AdminNotification::create([
            'type' => 'new_customer',
            'related_id' => $user->id,
            'is_read' => false
        ]);

        return redirect()->route('home')->with('success', 'Inscription réussie ! Bienvenue sur Fruitables.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Déconnexion réussie !');
    }

    public function account()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('orderItems')->latest()->get();
        
        return view('account', compact('user', 'orders'));
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $user->update($validated);

        return back()->with('success', 'Votre profil a été mis à jour avec succès !');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'Le mot de passe actuel est incorrect.',
            ]);
        }

        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return back()->with('success', 'Votre mot de passe a été changé avec succès !');
    }

    public function cancelOrder(Request $request, Order $order)
    {
        // Vérifier que la commande appartient à l'utilisateur connecté
        if ($order->user_id !== Auth::id()) {
            return back()->with('error', 'Vous n\'êtes pas autorisé à annuler cette commande.');
        }

        // Vérifier que la commande peut être annulée
        if (!in_array($order->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'Cette commande ne peut plus être annulée.');
        }

        $order->update(['status' => 'cancelled']);

        return back()->with('success', 'Votre commande a été annulée avec succès.');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        // Vérifier le mot de passe avant suppression
        $request->validate([
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Le mot de passe est incorrect pour supprimer votre compte.',
            ]);
        }

        // Supprimer l'utilisateur
        Auth::logout();
        $user->delete();

        return redirect()->route('home')->with('success', 'Votre compte a été supprimé avec succès.');
    }
}
