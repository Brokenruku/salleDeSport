<?php

namespace App\Models;

use CodeIgniter\Model;

class CreneauModel extends Model
{
    protected $table      = 'creneaux';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ressource_id', 'date_debut', 'date_fin', 'places_dispo', 'actif'];

    /**
     * Retourne les créneaux actifs à venir, joints avec la table ressources.
     * Utilise du SQL brut pour compatibilité SQLite3 (pas d'alias de table dans le builder).
     */
    public function getCreneauxDisponibles(?string $type = null): array
    {
        $now    = date('Y-m-d H:i:s');
        $params = [$now];

        $sql = "SELECT c.id, c.date_debut, c.date_fin, c.places_dispo, c.actif,
                       r.nom AS ressource_nom, r.type AS ressource_type,
                       r.capacite, r.description
                FROM creneaux c
                JOIN ressources r ON r.id = c.ressource_id
                WHERE c.actif = 1
                  AND c.date_debut >= ?";

        if ($type !== null) {
            $sql     .= ' AND r.type = ?';
            $params[] = $type;
        }

        $sql .= ' ORDER BY c.date_debut ASC';

        return $this->db->query($sql, $params)->getResultArray();
    }

    /**
     * Compte les créneaux actifs sur les 7 prochains jours.
     */
    public function countCreneauxSemaine(): int
    {
        $today    = date('Y-m-d 00:00:00');
        $nextWeek = date('Y-m-d 23:59:59', strtotime('+7 days'));

        $count = $this->where('actif', 1)
                      ->where('date_debut >=', $today)
                      ->where('date_debut <=', $nextWeek)
                      ->countAllResults();

        return $count > 0 ? $count : 0;
    }

    /**
     * Retourne la liste distincte des types de ressources ayant des créneaux actifs.
     * Utilise une requête SQL brute pour compatibilité SQLite3.
     */
    public function getTypesDisponibles(): array
    {
        $now = date('Y-m-d H:i:s');

        $query = $this->db->query(
            "SELECT DISTINCT r.type
             FROM creneaux c
             JOIN ressources r ON r.id = c.ressource_id
             WHERE c.actif = 1
               AND c.date_debut >= ?
             ORDER BY r.type ASC",
            [$now]
        );

        return array_column($query->getResultArray(), 'type');
    }
}