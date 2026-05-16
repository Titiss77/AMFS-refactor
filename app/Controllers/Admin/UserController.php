<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        $users = auth()->getProvider();

        $data = [
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

        if ($user->inGroup('superadmin') && !$currentUser->inGroup('superadmin')) {
            return redirect()->to('admin/users')->with('error', 'Accréditation insuffisante pour modifier cette cible.');
        }

        $availableGroups = implode(',', array_keys(config('AuthGroups')->groups));
        
        $rules = [
            'username' => "required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username,id,{$id}]",
            'group'    => "permit_empty|in_list[{$availableGroups}]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user->fill([
            'username' => $this->request->getPost('username'),
        ]);

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('error', 'Échec de l\'enregistrement en base.');
        }

        $newGroup = $this->request->getPost('group');
        if ($newGroup) {
            if ($newGroup === 'superadmin' && !$currentUser->inGroup('superadmin')) {
                return redirect()->to('admin/users')->with('error', 'Déploiement du grade Super Admin refusé.');
            }
            $user->syncGroups($newGroup);
        }

        return redirect()->to('admin/users')->with('message', 'Paramètres utilisateurs synchronisés.');
    }

    /**
     * Suspendre (bannir) un utilisateur sans toucher à ses cartes
     */
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

        // Bannissement via Shield. Les cartes restent associées à son id_user en base de données.
        $user->ban('Accès révoqué par l\'administration.');

        return redirect()->to('admin/users')->with('message', 'Le profil a été suspendu avec succès. Ses cartes ont été conservées.');
    }

    /**
     * Réhabiliter (débannir) un utilisateur
     */
    public function unban($id)
    {
        $users = auth()->getProvider();
        $user = $users->findById($id);
        $currentUser = auth()->user();

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'Utilisateur introuvable.');
        }

        if ($user->inGroup('superadmin') && !$currentUser->inGroup('superadmin')) {
            return redirect()->to('admin/users')->with('error', 'Accréditation insuffisante pour réhabiliter ce profil.');
        }

        // Levée du bannissement via Shield
        $user->unBan();

        return redirect()->to('admin/users')->with('message', 'Le compte a été réhabilité. L\'utilisateur peut à nouveau se connecter et accorder ses cartes.');
    }
}