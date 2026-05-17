<?php declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Item;
use App\Models\ItemModel;
use App\Models\ItemRevisionModel;

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
            $isSuperAdmin = auth()->user()->inGroup('superadmin');

            // --- NOUVELLE LOGIQUE DE MODÉRATION (Nouvelle carte) ---
            $wantsPublic = $this->request->getPost('is_public');

            if ($wantsPublic) {
                // Si c'est un superadmin, publication directe (1). Sinon, en inspection (2)
                $data['is_public'] = $isSuperAdmin ? 1 : 2;
            } else {
                // Sinon elle reste ou devient privée (0)
                $data['is_public'] = 0;
            }

            // Gestion de la date de sortie
            $data['date_sortie'] = empty($this->request->getPost('date_sortie')) ? null : $this->request->getPost('date_sortie');

            // --- GESTION DU PROPRIÉTAIRE & DES RÉVISIONS ---
            $existing = null;
            if ($id) {
                $existing = $this->model->find($id);
                if ($existing) {
                    $data['id_user'] = $existing->id_user; // On conserve le propriétaire original
                }
            } else {
                $data['id_user'] = auth()->id(); // Nouvelle carte
            }

            $backUrl = $this->request->getPost('redirect_url') ?: site_url('/');
            $separator = (str_contains($backUrl, '?')) ? '&' : '?';

            // 3. Sauvegarde ou mise en révision
            if ($id) {
                // Sécurité : Propriétaire ou admin
                $canEdit = $existing && ((int) $existing->id_user === (int) auth()->id() || $isAdmin);

                if (!$canEdit) {
                    return redirect()->back()->with('error', "Vous n'avez pas les droits pour modifier cette carte.");
                }

                // --- LOGIQUE DE DRAFTING ---
                // Si la carte est DÉJÀ publique et que ce n'est PAS un superadmin qui modifie
                if ($existing->is_public == 1 && !$isSuperAdmin) {
                    
                    $revisionModel = new ItemRevisionModel();
                    
                    $revisionData = [
                        'original_item_id' => $id,
                        'id_user'          => auth()->id(), // Celui qui fait la modif
                        'titre'            => $data['titre'],
                        'status'           => $data['status'],
                        'image'            => $data['image'] ?? $existing->image,
                        'lien'             => $data['lien'] ?? null,
                        'description'      => $data['description'] ?? null,
                        'episode'          => $data['episode'] ?? null,
                        'saison'           => empty($data['saison']) ? null : $data['saison'],
                        'position'         => $existing->position, // on garde la position actuelle
                        'date_sortie'      => $data['date_sortie'],
                        'revision_status'  => 'pending'
                    ];

                    $revisionModel->save($revisionData);

                    return redirect()->to($backUrl . $separator . 'open=' . $existing->id_division . '#div-' . $existing->id_division)
                                     ->with('message', 'Votre modification a été soumise au SuperAdmin pour validation.');
                } else {
                    // C'est une carte privée OU c'est un superadmin -> Mise à jour directe
                    $item = new Item($data);
                    $this->model->save($item);
                }

            } else {
                // Nouvelle carte
                $item = new Item($data);
                $this->model->save($item);
            }

            return redirect()->to($backUrl . $separator . 'open=' . $data['id_division'] . '#div-' . $data['id_division']);
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
                $this->model->delete($id);

                $backUrl = $this->request->getUserAgent()->getReferrer() ?: site_url('/');
                $separator = (str_contains($backUrl, '?')) ? '&' : '?';

                return redirect()->to($backUrl . $separator . 'open=' . $id_div . '#div-' . $id_div);
            }
        }

        return redirect()->back();
    }

    public function incrementEpisode($id)
    {
        $item = $this->model->find($id);

        if ($item) {
            $newEpisode = (int) $item->episode + 1;
            $this->model->update($id, ['episode' => $newEpisode]);

            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'new_episode' => $newEpisode,
                    'csrf_token' => csrf_hash()
                ]);
            }
        }
        return redirect()->back();
    }

    public function searchTmdb()
    {
        $query = $this->request->getGet('q');
        $apiKey = env('TMDB_API_KEY') ?? 'ba55da0439797150ed58c4e524584823';

        $client = \Config\Services::curlrequest();
        $url = 'https://api.themoviedb.org/3/search/multi?query=' . urlencode($query) . "&api_key={$apiKey}&language=fr-FR";

        try {
            $response = $client->get($url);
            return $this->response->setJSON(json_decode($response->getBody()));
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Impossible de contacter TMDB']);
        }
    }

    public function updateOrder()
    {
        if ($this->request->isAJAX()) {
            $json = $this->request->getJSON();

            if (isset($json->order) && is_array($json->order)) {
                $userId = auth()->id();
                $isAdmin = auth()->user()->inGroup('admin', 'superadmin');

                foreach ($json->order as $index => $itemId) {
                    $item = $this->model->find($itemId);

                    if ($item && ((int) $item->id_user === (int) $userId || $isAdmin)) {
                        $this->model->update($itemId, ['position' => $index]);
                    }
                }

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Ordre sauvegardé',
                    'csrf_token' => csrf_hash()
                ]);
            }
        }

        return $this->response->setJSON([
            'success' => false,
            'error' => 'Requête invalide ou données manquantes.'
        ]);
    }
}