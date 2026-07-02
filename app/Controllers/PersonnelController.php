<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Session;
use App\Models\Personnel;
use App\Models\SimpleList;

class PersonnelController extends Controller {
    public function index(): string {
        Auth::requireLogin();
        return $this->view('personnel/index', [
            'title' => 'مدیریت پرسنل',
            'rows' => (new Personnel())->all(),
            'flash' => Session::flash('success')
        ]);
    }

    public function create(): string {
        Auth::requireLogin();
        $l = new SimpleList();
        return $this->view('personnel/create', [
            'title' => 'ثبت پرسنل جدید',
            'teams' => $l->all('teams'),
            'categories' => $l->all('categories')
        ]);
    }

    public function store(): string {
        Auth::requireLogin();
        (new Personnel())->create([
            'personnel_code' => trim($_POST['personnel_code'] ?? ''),
            'row_no' => trim($_POST['row_no'] ?? ''),
            'full_name' => trim($_POST['full_name'] ?? ''),
            'national_code' => trim($_POST['national_code'] ?? ''),
            'mobile' => trim($_POST['mobile'] ?? ''),
            'category_id' => trim($_POST['category_id'] ?? ''),
            'team_id' => trim($_POST['team_id'] ?? ''),
            'file_status' => trim($_POST['file_status'] ?? 'ناقص'),
            'completion_percent' => trim($_POST['completion_percent'] ?? '0'),
            'notes' => trim($_POST['notes'] ?? '')
        ]);
        Session::flash('success', 'پرسنل با موفقیت ثبت شد.');
        $this->redirect('/personnel');
        return '';
    }

    public function show(int $id): string {
        Auth::requireLogin();
        $m = new Personnel();
        $person = $m->find($id);
        if (!$person) {
            http_response_code(404);
            return 'پرسنل یافت نشد';
        }
        $lists = new SimpleList();
        return $this->view('personnel/show', [
            'title' => 'جزئیات پرسنل',
            'person' => $person,
            'deficiencies' => $m->deficiencies($id),
            'followups' => $m->followups($id),
            'actions' => $m->actions($id),
            'positions' => $m->positions($id),
            'allPositions' => $lists->all('positions'),
            'flash' => Session::flash('success')
        ]);
    }

    public function addDeficiency(int $id): string {
        Auth::requireLogin();
        (new Personnel())->addDeficiency($id, [
            'deficiency_title' => trim($_POST['deficiency_title'] ?? ''),
            'deficiency_description' => trim($_POST['deficiency_description'] ?? ''),
            'deficiency_status' => trim($_POST['deficiency_status'] ?? 'باز'),
            'due_at' => trim($_POST['due_at'] ?? '')
        ]);
        Session::flash('success', 'نقص پرونده ثبت شد.');
        $this->redirect('/personnel/' . $id);
        return '';
    }

    public function addFollowup(int $id): string {
        Auth::requireLogin();
        (new Personnel())->addFollowup($id, [
            'followup_text' => trim($_POST['followup_text'] ?? ''),
            'followup_status' => trim($_POST['followup_status'] ?? 'باز'),
            'followup_at' => trim($_POST['followup_at'] ?? date('Y-m-d H:i:s')),
            'result_text' => trim($_POST['result_text'] ?? '')
        ]);
        Session::flash('success', 'پیگیری ثبت شد.');
        $this->redirect('/personnel/' . $id);
        return '';
    }

    public function addAction(int $id): string {
        Auth::requireLogin();
        (new Personnel())->addAction($id, [
            'action_title' => trim($_POST['action_title'] ?? ''),
            'action_description' => trim($_POST['action_description'] ?? ''),
            'action_status' => trim($_POST['action_status'] ?? 'باز'),
            'action_at' => trim($_POST['action_at'] ?? date('Y-m-d H:i:s')),
            'result_text' => trim($_POST['result_text'] ?? '')
        ]);
        Session::flash('success', 'اقدام ثبت شد.');
        $this->redirect('/personnel/' . $id);
        return '';
    }

    public function savePositions(int $id): string {
        Auth::requireLogin();
        (new Personnel())->syncPositions($id, is_array($_POST['position_ids'] ?? null) ? $_POST['position_ids'] : []);
        Session::flash('success', 'سمت‌ها ذخیره شدند.');
        $this->redirect('/personnel/' . $id);
        return '';
    }
}
