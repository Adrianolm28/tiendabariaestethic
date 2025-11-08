<?php

namespace App\Controllers;

class VisitorController extends BaseController
{
    public function registerVisitor()
    {
        $db = \Config\Database::connect();
        $ip = $this->request->getIPAddress();
        $page = current_url();
        $now = date('Y-m-d H:i:s');
        $today = date('Y-m-d');

        // Cookie para visitante único
        $visitorId = $this->request->getCookie('visitor_id');
        if (!$visitorId) {
            $visitorId = bin2hex(random_bytes(16));
            setcookie('visitor_id', $visitorId, time() + 60*60*24*365, "/");
        }

        $exists = $db->table('visits')
            ->where('visitor_id', $visitorId)
            ->where('page_name', $page)
            ->where('DATE(visited_at)', $today)
            ->countAllResults();

        if ($exists == 0) {
            $visitModel = new \App\Models\VisitModel();
            $visitModel->insert([
                'page_name' => $page,
                'visited_at' => $now,
                'ip_address' => $ip,
                'user_agent' => $this->request->getUserAgent(),
                'visitor_id' => $visitorId
            ]);
        }

        return $this->response->setJSON(['status' => 'success']);
    }

    public function getMostVisited()
    {
        $visitModel = new \App\Models\VisitModel();
        $data = $visitModel->getMostVisitedPages();
        return $this->response->setJSON($data);
    }

    public function getVisitsByDateRange()
    {
        $startDate = $this->request->getVar('startDate');
        $endDate = $this->request->getVar('endDate');

        $visitModel = new \App\Models\VisitModel();
        $data = $visitModel->getVisitsByDateRange($startDate, $endDate);
        return $this->response->setJSON($data);
    }

    public function totalVisitas()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('visits');
        $total = $builder->countAllResults();
        return $this->response->setJSON(['total_visitas' => $total]);
    }
}