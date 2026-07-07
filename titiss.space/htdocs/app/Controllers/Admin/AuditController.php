<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AuditLogModel;

class AuditController extends BaseController
{
    public function index()
    {
        $auditModel = new AuditLogModel();

        $data = [
            // Récupère les 200 dernières actions pour éviter de surcharger la page
            'logs' => $auditModel->getRecentLogs(200),
        ];

        return view('admin/audit/index', $data);
    }
}
