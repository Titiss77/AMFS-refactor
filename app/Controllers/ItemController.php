<?php

declare(strict_types=1);

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
            'redirect_url' => $this->request->getUserAgent()->getReferrer() ?? site_url('/'),
        ];

        if (null !== $id) {
            $data['item'] = $this->model->find($id);
        }

        return view('item_form', $data);
    }

    public function save()
    {
        if ($this->request->is('post')) {
            if (!auth()->loggedIn()) {
                return redirect()->to('login');
            }

            // 1. Validation CI4
            $rules = [
                'titre' => 'required|max_length[100]',
                'id_division' => 'required|numeric',
                'status' => 'in_list[Aucun,À voir,En cours,En pause,Terminé]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'Erreur dans le formulaire.');
            }

            // 2. Traitement des données
            $data = $this->request->getPost();
            $id = $this->request->getPost('id');
            $isAdmin = auth()->user()->inGroup('admin', 'superadmin');

            // --- NOUVELLE LOGIQUE DE MODÉRATION ---
            $wantsPublic = $this->request->getPost('is_public');

            if ($wantsPublic) {
                // Si c'est un admin, publication directe (1). Sinon, en inspection (2)
                $data['is_public'] = $isAdmin ? 1 : 2;
            } else {
                // Sinon elle reste ou devient privée (0)
                $data['is_public'] = 0; 
            }
            // --------------------------------------

            // Gestion de la date de sortie (convertit la chaîne vide en NULL)
            $data['date_sortie'] = empty($this->request->getPost('date_sortie')) ? null : $this->request->getPost('date_sortie');

            // --- GESTION DU PROPRIÉTAIRE ---
            $existing = null;
            if ($id) {
                $existing = $this->model->find($id);
                if ($existing) {
                    // On conserve le propriétaire original en cas de modification
                    $data['id_user'] = $existing->id_user; 
                }
            } else {
                // Nouvelle carte = l'utilisateur connecté est le propriétaire
                $data['id_user'] = auth()->id(); 
            }

            // On instancie l'entité avec TOUTES les données d'un coup
            $item = new Item($data);

            // 3. Sauvegarde
            if ($id) {
                // Sécurité : Seul le propriétaire OU un admin peut modifier cette carte
                $canEdit = $existing && ((int) $existing->id_user === (int) auth()->id() || $isAdmin);
                
                if ($canEdit) {
                    $this->model->save($item);
                } else {
                    return redirect()->back()->with('error', 'Vous n\'avez pas les droits pour modifier cette carte.');
                }
            } else {
                $this->model->save($item);
            }

            // 4. Redirection avec ouverture du menu déroulant
            $backUrl = $this->request->getPost('redirect_url') ?: site_url('/');
            $separator = (str_contains($backUrl, '?')) ? '&' : '?';

            return redirect()->to($backUrl.$separator.'open='.$item->id_division.'#div-'.$item->id_division);
        }
    }

    public function delete($id = null)
    {
        if (null !== $id) {
            $item = $this->model->find($id);
            $isAdmin = auth()->user()->inGroup('admin', 'superadmin');

            // Seul le propriétaire ou un admin peut supprimer
            if ($item && ((int) $item->id_user === (int) auth()->id() || $isAdmin)) {
                $id_div = $item->id_division;
                $this->model->where('id', $id)->delete();

                // On repart d'où on vient (Referer direct car pas de formulaire)
                $backUrl = $this->request->getUserAgent()->getReferrer() ?: site_url('/');
                $separator = (str_contains($backUrl, '?')) ? '&' : '?';

                return redirect()->to($backUrl.$separator.'open='.$id_div.'#div-'.$id_div);
            }
        }

        return redirect()->back();
    }

    public function incrementEpisode($id)
    {
        $itemModel = new \App\Models\ItemModel();
        $item = $itemModel->find($id);

        if ($item) {
            $newEpisode = (int)$item->episode + 1;
            $itemModel->update($id, ['episode' => $newEpisode]);

            // Si la requête vient de JavaScript (AJAX/Fetch)
            if ($this->request->isAJAX()) {
                // On génère un nouveau token CSRF pour les futures requêtes
                return $this->response->setJSON([
                    'success' => true, 
                    'new_episode' => $newEpisode,
                    'csrf_token' => csrf_hash() 
                ]);
            }
        }
        return redirect()->back(); // Fallback si pas de JS
    }

    public function searchTmdb()
    {
        $query = $this->request->getGet('q');
        // Tu devras mettre TMDB_API_KEY=TaClef dans ton fichier .env
        $apiKey = env('TMDB_API_KEY') ?? 'ba55da0439797150ed58c4e524584823'; 

        $client = \Config\Services::curlrequest();
        $url = "https://api.themoviedb.org/3/search/multi?query=" . urlencode($query) . "&api_key={$apiKey}&language=fr-FR";
        
        try {
            $response = $client->get($url);
            return $this->response->setJSON(json_decode($response->getBody()));
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Impossible de contacter TMDB']);
        }
    }
}