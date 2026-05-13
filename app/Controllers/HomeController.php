<?php declare(strict_types=1);

namespace App\Controllers;

use App\Models\ItemModel;

class HomeController extends BaseController
{
    public function index()
    {
        $model = new ItemModel();
        $headers = $model->getHeaders();

        if (!empty($headers)) {
            return redirect()->to('categorie/' . $headers[0]['id']);
        }

        return view('home', ['headers' => [], 'groupedItems' => []]);
    }

    public function categorie($headerId)
    {
        $model = new ItemModel();
        $userId = auth()->loggedIn() ? auth()->id() : null;

        $headers = $model->getHeaders();
        $groupedItems = $model->getItemsGroupedByHeaderAndDivision($userId, $headerId);

        return view('home', [
            'headers' => $headers,
            'groupedItems' => $groupedItems,
            'currentHeaderId' => $headerId,
        ]);
    }
}
