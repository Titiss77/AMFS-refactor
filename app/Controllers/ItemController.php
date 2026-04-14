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
            // ... validation et logique de sauvegarde inchangée ...

            // 3. Sauvegarde
            $item = new Item($this->request->getPost());
            // ... (ton code de sauvegarde existant) ...
            $this->model->save($item);

            // 4. RÉSOLUTION : On récupère l'URL d'origine envoyée par le formulaire
            $backUrl = $this->request->getPost('redirect_url') ?: site_url('/');

            // On ajoute les paramètres d'ouverture à l'URL d'origine
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