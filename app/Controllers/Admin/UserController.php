<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        // Récupère le UserModel de Shield
        $users = auth()->getProvider();
        
        $data = [
            'users' => $users->findAll(),
            'title' => 'Gestion des utilisateurs'
        ];

        return view('admin/users/index', $data);
    }

    public function edit($id)
    {
        $users = auth()->getProvider();
        $user = $users->findById($id);

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'Utilisateur introuvable.');
        }

        $data = [
            'user' => $user,
            'title' => 'Modifier l\'utilisateur',
            // On récupère les groupes configurés dans AuthGroups
            'availableGroups' => config('AuthGroups')->groups 
        ];

        return view('admin/users/edit', $data);
    }

    public function update($id)
    {
        $users = auth()->getProvider();
        $user = $users->findById($id);

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'Utilisateur introuvable.');
        }

        // Met à jour le rôle (groupe) de l'utilisateur
        $newGroup = $this->request->getPost('group');
        
        if ($newGroup) {
            // syncGroups supprime les anciens groupes et applique le nouveau
            $user->syncGroups($newGroup); 
        }

        return redirect()->to('admin/users')->with('message', 'Utilisateur mis à jour avec succès.');
    }

    public function delete($id)
    {
        $users = auth()->getProvider();
        
        // Empêcher l'admin de se supprimer lui-même
        if ($id == auth()->id()) {
            return redirect()->to('admin/users')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $users->delete($id, true); // Le `true` force la suppression définitive (hard delete)

        return redirect()->to('admin/users')->with('message', 'Utilisateur supprimé.');
    }
}