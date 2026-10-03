<?php
declare(strict_types=1);

namespace carry0987\Template\Controller;

use carry0987\Template\Exception\ControllerException;
use carry0987\Template\Controller\Model\ {
    ReadModel,
    VersionModel
};
use carry0987\Sanite\Sanite;

class DBController
{
    private Sanite $sanite;
    private ReadModel $read;
    private VersionModel $version;

    public function __construct(array|\PDO|Sanite $dbConfig)
    {
        if ($dbConfig instanceof Sanite) {
            $this->sanite = $dbConfig;
        } else {
            $this->sanite = new Sanite($dbConfig);
        }
        $this->read = new ReadModel($this->sanite);
        $this->version = new VersionModel($this->sanite);
    }

    public function isConnected(): bool
    {
        return !empty($this->sanite->getConnection());
    }

    public function setTableName(string $table): void
    {
        if ($this->read === null || $this->version === null) {
            throw new ControllerException('Model is not set', 500);
        }

        $this->read::$table = $table;
        $this->version::$table = $table;
    }

    public function getVersion(string $tpl_path, string $tpl_name, string $tpl_type): array|false
    {
        $version = $this->read->getVersion($tpl_path, $tpl_name, $tpl_type);

        return empty($version) ? false : $version;
    }

    public function upsertVersion(string $tpl_path, string $tpl_name, string $tpl_type, string $tpl_hash, int $tpl_expire_time, string $tpl_verhash): bool
    {
        return $this->version->upsertVersion($tpl_path, $tpl_name, $tpl_type, $tpl_hash, $tpl_expire_time, $tpl_verhash);
    }
}
