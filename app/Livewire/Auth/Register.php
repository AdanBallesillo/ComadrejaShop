<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'comprador';

    protected function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:comprador,vendedor',
        ];
    }

    protected array $messages = [
        'name.required'      => 'El nombre es obligatorio.',
        'email.required'     => 'El correo es obligatorio.',
        'email.email'        => 'Ingresa un correo valido.',
        'email.unique'       => 'Este correo ya esta registrado.',
        'password.required'  => 'La contrasena es obligatoria.',
        'password.min'       => 'La contrasena debe tener al menos 8 caracteres.',
        'password.confirmed' => 'Las contrasenas no coinciden.',
        'role.required'      => 'Selecciona un rol.',
    ];

    public function register(): void
    {
        $this->validate();

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'role'     => $this->role,
            'active'   => true,
        ]);

        Auth::login($user);

        if ($user->role === 'vendedor') {
            $this->redirect('/vendor/dashboard');
        } else {
            $this->redirect('/catalog');
        }
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.guest');
    }
}
