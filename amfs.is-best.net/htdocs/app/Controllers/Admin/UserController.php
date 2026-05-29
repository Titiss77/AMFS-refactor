<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AuditLogModel;  // Ajout de l'audit

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
        $currentUser = auth()->user();

        if (!$user) {
            return redirect()->to('users')->with('error', 'Utilisateur introuvable.');
        }

        if ($user->inGroup('superadmin') && !$currentUser->inGroup('superadmin')) {
            $audit = new AuditLogModel();
            $audit->logAction('Alerte Sécurité', "L'admin ID {$currentUser->id} a tenté d'accéder à la page d'édition du SuperAdmin ID {$id}.");

            return redirect()->to('users')->with('error', 'Accréditation insuffisante pour modifier cette cible.');
        }

        $availableGroups = config('AuthGroups')->groups;

        if (!$currentUser->inGroup('superadmin')) {
            unset($availableGroups['superadmin']);
        }

        $data = [
            'user' => $user,
            'title' => "Modifier l'utilisateur",
            'availableGroups' => $availableGroups,
        ];

        return view('admin/users/edit', $data);
    }

    public function update($id)
    {
        $users = auth()->getProvider();
        $user = $users->findById($id);
        $currentUser = auth()->user();
        $audit = new AuditLogModel();

        if (!$user) {
            return redirect()->to('users')->with('error', 'Utilisateur introuvable.');
        }

        if ($user->inGroup('superadmin') && !$currentUser->inGroup('superadmin')) {
            return redirect()->to('users')->with('error', 'Accréditation insuffisante pour modifier cette cible.');
        }

        $availableGroups = implode(',', array_keys(config('AuthGroups')->groups));

        $rules = [
            'username' => "required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username,id,{$id}]",
            'group' => "permit_empty|in_list[{$availableGroups}]",
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $oldUsername = $user->username;
        $newUsername = $this->request->getPost('username');

        $user->fill([
            'username' => $newUsername,
        ]);

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('error', "Échec de l'enregistrement en base.");
        }

        $logDetails = "Mise à jour du compte ID {$id}. ";
        if ($oldUsername !== $newUsername) {
            $logDetails .= "Pseudo: '{$oldUsername}' -> '{$newUsername}'. ";
        }

        $newGroup = $this->request->getPost('group');
        if ($newGroup) {
            if ('superadmin' === $newGroup && !$currentUser->inGroup('superadmin')) {
                $audit->logAction('Alerte Sécurité', "Tentative d'élévation de privilèges vers SuperAdmin bloquée pour la cible ID {$id}.");

                return redirect()->to('users')->with('error', 'Déploiement du grade Super Admin refusé.');
            }
            $user->syncGroups($newGroup);
            $logDetails .= "Nouveau groupe de sécurité assigné: [{$newGroup}].";
        }

        $audit->logAction('Modification Profil', $logDetails);

        return redirect()->to('users')->with('message', 'Paramètres utilisateurs synchronisés.');
    }

    public function delete($id)
    {
        $users = auth()->getProvider();
        $user = $users->findById($id);
        $currentUser = auth()->user();
        $audit = new AuditLogModel();

        if (!$user) {
            return redirect()->to('users')->with('error', 'Utilisateur introuvable.');
        }

        if ($id == $currentUser->id) {
            return redirect()->to('users')->with('error', 'Auto-neutralisation impossible.');
        }

        if ($user->inGroup('superadmin') && !$currentUser->inGroup('superadmin')) {
            return redirect()->to('users')->with('error', 'Accréditation insuffisante pour interdire ce profil.');
        }

        $user->ban("Accès révoqué par l'administration.");

        $audit->logAction('Sanction : Bannissement', "Le compte ID {$id} ('{$user->username}') a été suspendu de la plateforme.");

        return redirect()->to('users')->with('message', 'Le profil a été suspendu avec succès. Ses cartes ont été conservées.');
    }

    public function unban($id)
    {
        $users = auth()->getProvider();
        $user = $users->findById($id);
        $currentUser = auth()->user();
        $audit = new AuditLogModel();

        if (!$user) {
            return redirect()->to('users')->with('error', 'Utilisateur introuvable.');
        }

        if ($user->inGroup('superadmin') && !$currentUser->inGroup('superadmin')) {
            return redirect()->to('users')->with('error', 'Accréditation insuffisante pour réhabiliter ce profil.');
        }

        $user->unBan();

        $audit->logAction('Réhabilitation Compte', "Le bannissement du compte ID {$id} ('{$user->username}') a été levé.");

        return redirect()->to('users')->with('message', "Le compte a été réhabilité. L'utilisateur peut à nouveau se connecter et accorder ses cartes.");
    }
}
