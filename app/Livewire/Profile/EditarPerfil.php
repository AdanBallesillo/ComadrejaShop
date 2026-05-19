<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditarPerfil extends Component
{
    public string $name = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
    }

    protected function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'password' => 'nullable|min:8|confirmed',
        ];
    }

    protected array $messages = [
        'name.required'      => 'El nombre es obligatorio.',
        'password.min'       => 'La contrasena debe tener al menos 8 caracteres.',
        'password.confirmed' => 'Las contrasenas no coinciden.',
    ];

    public function save(): void
    {
        $this->validate();

        $user = Auth::user();
        $user->name = $this->name;

        if (!empty($this->password)) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        $this->password = '';
        $this->password_confirmation = '';

        session()->flash('success', 'Perfil actualizado correctamente.');
        $this->redirect(route('profile'));
    }

    public function render()
    {
        return view('livewire.profile.editar-perfil')
            ->layout('layouts.guest');
    }
}
