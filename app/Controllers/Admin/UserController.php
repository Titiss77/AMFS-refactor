<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemModel;

class UserController extends BaseController
{
    public function index()
    {
        $users = auth()->getProvider();

        $data = [
            // Implémentation de la pagination (20 par page) au lieu de findAll()
            'users' => $users->where('id !=', 0)->paginate(20),
            'pager' => $users->pager,
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
            'user'            => $user,
            'title'           => "Modifier l'utilisateur",
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

        // Verrouillage de l'élévation de privilèges
        if ($user->inGroup('superadmin') && !$currentUser->inGroup('superadmin')) {
            return redirect()->to('admin/users')->with('error', 'Accréditation insuffisante pour modifier cette cible.');
        }

        // Génération dynamique des groupes autorisés pour la validation
        $availableGroups = implode(',', array_keys(config('AuthGroups')->groups));
        
        $rules = [
            'username' => "required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username,id,{$id}]",
            'group'    => "permit_empty|in_list[{$availableGroups}]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Injection des données validées
        $user->fill([
            'username' => $this->request->getPost('username'),
        ]);

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('error', 'Échec de l\'enregistrement en base.');
        }

        $newGroup = $this->request->getPost('group');
        if ($newGroup) {
            // Blocage de la distribution sauvage du rôle Super Admin
            if ($newGroup === 'superadmin' && !$currentUser->inGroup('superadmin')) {
                return redirect()->to('admin/users')->with('error', 'Déploiement du grade Super Admin refusé.');
            }
            $user->syncGroups($newGroup);
        }

        return redirect()->to('admin/users')->with('message', 'Paramètres utilisateurs synchronisés.');
    }

    public function delete($id)
    {
        $users = auth()->getProvider();
        $user = $users->findById($id);
        $currentUser = auth()->user();

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'Utilisateur introuvable.');
        }

        if ($id == $currentUser->id) {
            return redirect()->to('admin/users')->with('error', 'Auto-neutralisation impossible.');
        }

        if ($user->inGroup('superadmin') && !$currentUser->inGroup('superadmin')) {
            return redirect()->to('admin/users')->with('error', 'Accréditation insuffisante pour interdire ce profil.');
        }

        // Réassignation des entités liées à l'utilisateur système (0)
        $itemModel = new ItemModel();
        $itemModel->where('id_user', $id)->set(['id_user' => 0])->update();

        // Application du bannissement Shield (Audit Trail)
        $user->ban('Accès révoqué par l\'administration.');

        return redirect()->to('admin/users')->with('message', 'Profil verrouillé et ressources réattribuées.');
    }
}