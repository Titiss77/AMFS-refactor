<?php declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Item;
use App\Models\ItemModel;

class ItemController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new ItemModel();
    }

    public function form($id = null)
    {
        $data = [
            'headers' => $this->model->getHeaders(),
            'divisions' => $this->model->getDivisions(),
            'item' => null,
            'view' => 'item_form',
            // On mémorise la page précédente (Referer) pour le retour
            'redirect_url' => $this->request->getUserAgent()->getReferrer() ?? site_url('/')
        ];

        if ($id !== null) {
            $data['item'] = $this->model->find($id);
            // ... reste du code inchangé ...
        }
        return view('layout', $data);
    }

    public function save()
    {
        if ($this->request->is('post')) {
            if (!auth()->loggedIn())
                return redirect()->to('login');

            // 1. Validation CI4
            $rules = [
                'titre' => 'required|max_length[100]',
                'id_division' => 'required|numeric',
                'status' => 'in_list[Aucun,À voir,En cours,En pause,Terminé]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'Erreur dans le formulaire.');
            }

            // 2. Traitement des données (LA CORRECTION EST ICI)
            // On récupère tout ce qui vient du formulaire dans un tableau
            $data = $this->request->getPost();

            // On y injecte nos propres valeurs systèmes de façon sécurisée
            $data['id_user'] = auth()->id();
            $data['is_public'] = $this->request->getPost('is_public') ? 1 : 0;

            // On instancie l'entité avec TOUTES les données d'un coup
            $item = new Item($data);

            $id = $this->request->getPost('id');

            // 3. Sauvegarde
            if ($id) {
                $existing = $this->model->find($id);
                if ($existing && (int) $existing->id_user === (int) auth()->id()) {
                    $this->model->save($item);
                }
            } else {
                // L'ajout se fera avec le bon id_user désormais !
                $this->model->save($item);
            }

            // 4. Redirection avec ouverture du menu déroulant
            $backUrl = $this->request->getPost('redirect_url') ?: site_url('/');
            $separator = (strpos($backUrl, '?') !== false) ? '&' : '?';
            return redirect()->to($backUrl . $separator . 'open=' . $item->id_division . '#div-' . $item->id_division);
        }
    }

    public function delete($id = null)
    {
        if ($id !== null) {
            $item = $this->model->find($id);
            if ($item && (int) $item->id_user === (int) auth()->id()) {
                $id_div = $item->id_division;
                $this->model->where('id', $id)->delete();

                // On repart d'où on vient (Referer direct car pas de formulaire)
                $backUrl = $this->request->getUserAgent()->getReferrer() ?: site_url('/');
                $separator = (strpos($backUrl, '?') !== false) ? '&' : '?';
                return redirect()->to($backUrl . $separator . 'open=' . $id_div . '#div-' . $id_div);
            }
        }
        return redirect()->back();
    }

    public function incrementEpisode($id)
    {
        if (!auth()->loggedIn())
            return $this->response->setJSON(['success' => false]);

        $item = $this->model->find($id);
        if ($item && (int) $item->id_user === (int) auth()->id()) {
            $newEp = (string) ((int) $item->episode + 1);
            $this->model->update($id, ['episode' => $newEp]);
            return $this->response->setJSON(['success' => true, 'new_episode' => $newEp]);
        }
        return $this->response->setJSON(['success' => false]);
    }
}