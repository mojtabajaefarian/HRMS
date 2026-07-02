<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Database;

class DashboardController extends Controller {
    public function index(): string {
        Auth::requireLogin();
        $db = Database::connection();
        $stats = [
            'personnel' => (int)$db->query("SELECT COUNT(*) FROM personnel")->fetchColumn(),
            'open_deficiencies' => (int)$db->query("SELECT COUNT(*) FROM personnel_deficiencies WHERE deficiency_status='باز'")->fetchColumn(),
            'open_followups' => (int)$db->query("SELECT COUNT(*) FROM personnel_followups WHERE followup_status='باز'")->fetchColumn(),
            'open_actions' => (int)$db->query("SELECT COUNT(*) FROM personnel_actions WHERE action_status='باز'")->fetchColumn(),
        ];
        return $this->view('dashboard/index', ['title' => 'داشبورد', 'stats' => $stats]);
    }
}
