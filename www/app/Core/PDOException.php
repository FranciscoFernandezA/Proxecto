<?php
declare(strict_types=1);
namespace Com\FernandezFran\Core;

use \PDOException;

class CustomPDOException extends PDOException
{
    // Atributo para almacenar el query que causó el error

    private ?string $sqlQuery;

    public function __construct(string $message, int $code = 0, ?string $sqlQuery = null, ?\Throwable $previous = null)
    {
        $this->sqlQuery = $sqlQuery;
        // Llama al constructor de la clase padre
        parent::__construct($message, $code, $previous);
    }

    public function getSqlQuery(): ?string
    {
        return $this->sqlQuery;
    }

    public function logError(string $logFile = 'pdo_errors.log'): void
    {
        $logMessage = sprintf(
            "[%s] Error Code: %d\nMessage: %s\nSQL Query: %s\n\n",
            date('Y-m-d H:i:s'),
            $this->getCode(),
            $this->getMessage(),
            $this->sqlQuery ?? 'N/A'
        );
        file_put_contents($logFile, $logMessage, FILE_APPEND);
    }
    public function __toString(): string
    {
        return sprintf(
            "PDOException [%d]: %s\nSQL Query: %s\n",
            $this->getCode(),
            $this->getMessage(),
            $this->sqlQuery ?? 'N/A'
        );
    }
}
