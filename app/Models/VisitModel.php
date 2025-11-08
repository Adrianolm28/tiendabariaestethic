<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitModel extends Model
{
    protected $table = 'visits';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'page_name', 'visited_at', 'ip_address', 'user_agent', 'visitor_id'
    ];

    // Métodos de reporte (antes en MostVisitedModel)
    public function getMostVisitedPages()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $select = "
            CASE
                WHEN page_name LIKE 'https://tegnex.pe/shop%' THEN 'https://tegnex.pe/shop'
                WHEN page_name LIKE 'https://tegnex.pe/tienda/verproducto/%' THEN 'https://tegnex.pe/tienda/verproducto/'
                ELSE page_name
            END as page_base,
            COUNT(*) as visits
        ";

        $builder->select($select, false)
            ->groupBy('page_base')
            ->orderBy('visits', 'DESC');

        return $builder->get()->getResultArray();
    }

    public function getVisitsByDateRange($startDate, $endDate)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $select = "
            DATE(visited_at) as fecha,
            CASE
                WHEN page_name LIKE 'https://tegnex.pe/shop%' THEN 'https://tegnex.pe/shop'
                WHEN page_name LIKE 'https://tegnex.pe/tienda/verproducto/%' THEN 'https://tegnex.pe/tienda/verproducto/'
                ELSE page_name
            END as page_base,
            COUNT(*) as visitas
        ";

        $builder->select($select, false)
            ->where('visited_at >=', $startDate)
            ->where('visited_at <=', $endDate)
            ->groupBy('fecha, page_base')
            ->orderBy('fecha', 'ASC');

        return $builder->get()->getResultArray();
    }

    public function getMostVisitedPagesUnique()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $select = "
            CASE
                WHEN page_name LIKE 'https://tegnex.pe/shop%' THEN 'https://tegnex.pe/shop'
                WHEN page_name LIKE 'https://tegnex.pe/tienda/verproducto/%' THEN 'https://tegnex.pe/tienda/verproducto/'
                ELSE page_name
            END as page_base,
            COUNT(DISTINCT ip_address) as unique_visits
        ";

        $builder->select($select, false)
            ->groupBy('page_base')
            ->orderBy('unique_visits', 'DESC');

        return $builder->get()->getResultArray();
    }

    public function getVisitsByDateRangeWithUnique($startDate, $endDate)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $select = "
            DATE(visited_at) as fecha,
            CASE
                WHEN page_name LIKE 'https://tegnex.pe/shop%' THEN 'https://tegnex.pe/shop'
                WHEN page_name LIKE 'https://tegnex.pe/tienda/verproducto/%' THEN 'https://tegnex.pe/tienda/verproducto/'
                ELSE page_name
            END as page_base,
            COUNT(*) as visitas,
            COUNT(DISTINCT ip_address) as visitas_unicas
        ";

        $builder->select($select, false)
            ->where('visited_at >=', $startDate . ' 00:00:00')
            ->where('visited_at <=', $endDate . ' 23:59:59')
            ->groupBy('fecha, page_base')
            ->orderBy('fecha', 'ASC');

        return $builder->get()->getResultArray();
    }

    public function getUniqueVisitsByDateRange($startDate, $endDate)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $select = "
            DATE(visited_at) as fecha,
            CASE
                WHEN page_name LIKE 'https://tegnex.pe/shop%' THEN 'https://tegnex.pe/shop'
                WHEN page_name LIKE 'https://tegnex.pe/tienda/verproducto/%' THEN 'https://tegnex.pe/tienda/verproducto/'
                ELSE page_name
            END as page_base,
            COUNT(DISTINCT ip_address) as visitas_unicas
        ";

        $builder->select($select, false)
            ->where('visited_at >=', $startDate . ' 00:00:00')
            ->where('visited_at <=', $endDate . ' 23:59:59')
            ->groupBy('fecha, page_base')
            ->orderBy('fecha', 'ASC');

        return $builder->get()->getResultArray();
    }
}
