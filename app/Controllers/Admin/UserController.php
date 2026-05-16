<?php declare(strict_types=1);

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
        $currentUser = auth()->user();

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'Utilisateur introuvable.');
        }

        // 1. Protection contre l'élévation de privilèges : on ne touche pas à un SuperAdmin si on ne l'est pas
        if ($user->inGroup('superadmin') && !$currentUser->inGroup('superadmin')) {
            return redirect()->to('admin/users')->with('error', "Action non autorisée sur ce niveau d'accréditation.");
        }

        // 2. Définition des règles de validation
        // L'implosion des clés de config permet de valider que le groupe posté existe bien dynamiquement
        $availableGroups = implode(',', array_keys(config('AuthGroups')->groups));
        $rules = [
            'username' => "required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username,id,{$id}]",
            'group' => "permit_empty|in_list[{$availableGroups}]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. Traitement sécurisé des données POST
        $user->fill([
            'username' => $this->request->getPost('username'),
        ]);

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('error', 'Erreur technique lors de la sauvegarde.');
        }

        // 4. Attribution des rôles avec sécurité additionnelle
        $newGroup = $this->request->getPost('group');
        if ($newGroup) {
            // Un admin normal ne peut pas nommer un autre utilisateur SuperAdmin
            if ($newGroup === 'superadmin' && !$currentUser->inGroup('superadmin')) {
                return redirect()->to('admin/users')->with('error', "Vous n'avez pas les droits pour accorder le rôle Super Admin.");
            }

            // syncGroups écrase les anciens rôles. Idéal pour une logique "1 utilisateur = 1 rôle principal"
            $user->syncGroups($newGroup);
        }

        return redirect()->to('admin/users')->with('message', 'Accréditations mises à jour avec succès.');
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
            ->update();

        // 2. Supprimer définitivement l'utilisateur
        $users->delete($id, true);  // Le `true` force la suppression définitive (hard delete)

        return redirect()->to('admin/users')->with('message', 'Utilisateur supprimé et ses cartes ont été archivées avec succès.');
    }
}