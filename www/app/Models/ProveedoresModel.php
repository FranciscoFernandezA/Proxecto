<?php

declare(strict_types=1);

namespace Com\FernandezFran\Models;

class ProveedoresModel extends \Com\FernandezFran\Core\BaseModel{

    function getAll() : array{
        $stmt = $this->pdo->query('SELECT * FROM proveedor');
        return $stmt->fetchAll();
    }


    function getStandard() : array{
        $stmt = $this->pdo->query("SELECT * FROM proveedor WHERE rol='standard'");
        return $stmt->fetchAll();
    }

    function getCarlos() : array{
        $stmt = $this->pdo->query("SELECT * FROM proveedor WHERE username LIKE 'Carlos%'");
        return $stmt->fetchAll();
    }
}
