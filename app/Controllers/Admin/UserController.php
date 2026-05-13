<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemModel;

class UserController extends BaseController
{
    public function index()
    {
        // Récupère le UserModel de Shield
        $users = auth()->getProvider();

        $data = [
            'users' => $users->where('id !=', 0)->findAll(),
            'title' => 'Gestion des utilisateurs',
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
            'title' => "Modifier l'utilisateur",
            // On récupère les groupes configurés dans AuthGroups
            'availableGroups' => config('AuthGroups')->groups,
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

        // 1. Mise à jour du nom d'utilisateur (Username)
        $user->fill([
            'username' => $this->request->getPost('username'),
        ]);
        $users->save($user);

        // 2. Mise à jour du Rôle (Groupe)
        $newGroup = $this->request->getPost('group');
        if ($newGroup) {
            // syncGroups remplace les anciens rôles par le nouveau
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

        // 1. Réassigner toutes les cartes de cet utilisateur à l'utilisateur 0
        $itemModel = new ItemModel();
        $itemModel
            ->where('id_user', $id)
            ->set(['id_user' => 0])
            ->update()
        ;

        // 2. Supprimer définitivement l'utilisateur
        $users->delete($id, true);  // Le `true` force la suppression définitive (hard delete)

        return redirect()->to('admin/users')->with('message', 'Utilisateur supprimé et ses cartes ont été archivées avec succès.');
    }
}
