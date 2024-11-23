<?php

declare(strict_types=1);

namespace Com\FernandezFran\Models;

class AuxRolModel extends \Com\FernandezFran\Core\BaseModel{

    function getAll() : array{
        $stmt = $this->pdo->query('SELECT * FROM aux_rol ORDER BY nombre_rol');
        return $stmt->fetchAll();
    }

}
