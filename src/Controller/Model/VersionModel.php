<?php
declare(strict_types=1);

namespace carry0987\Template\Controller\Model;

use carry0987\Sanite\Models\DataCreateModel;
use carry0987\Template\Exception\ControllerException;

class VersionModel extends DataCreateModel
{
    public static string $table = 'template';

    public function upsertVersion(string $tpl_path, string $tpl_name, string $tpl_type, string $tpl_hash, int $tpl_expire_time, string $tpl_verhash): bool
    {
        $query = match ($this->connectdb->getAttribute(\PDO::ATTR_DRIVER_NAME)) {
            'pgsql' => 'INSERT INTO '.self::$table.' (tpl_path, tpl_name, tpl_type, tpl_hash, tpl_expire_time, tpl_verhash)
                VALUES (?, ?, ?, ?, ?, ?)
                ON CONFLICT (tpl_path, tpl_name, tpl_type) DO UPDATE
                SET tpl_hash = EXCLUDED.tpl_hash,
                    tpl_expire_time = EXCLUDED.tpl_expire_time,
                    tpl_verhash = EXCLUDED.tpl_verhash',
            'mysql' => 'INSERT INTO '.self::$table.' (tpl_path, tpl_name, tpl_type, tpl_hash, tpl_expire_time, tpl_verhash)
                VALUES (?, ?, ?, ?, ?, ?) AS new
                ON DUPLICATE KEY UPDATE
                tpl_hash = new.tpl_hash,
                tpl_expire_time = new.tpl_expire_time,
                tpl_verhash = new.tpl_verhash',
            default => throw new ControllerException('Unsupported database driver', 500),
        };
        $queryArray = [
            'query' => $query,
            'bind' => 'ssssis',
        ];
        $dataArray = [$tpl_path, $tpl_name, $tpl_type, $tpl_hash, $tpl_expire_time, $tpl_verhash];

        return $this->createSingleData($queryArray, $dataArray);
    }
}
