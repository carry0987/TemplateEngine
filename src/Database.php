<?php
namespace carry0987\Template;

class Database
{
    private $db;

    public function __construct(array $dbSettings)
    {
        try {
            $this->db = new \PDO('mysql:host='.$dbSettings['host'].';port='.$dbSettings['port'].';dbname='.$dbSettings['database'], $dbSettings['username'], $dbSettings['password']);
        } catch (\PDOException $e) {
            die('Connection failed: '.$e->getMessage());
        }
    }

    public function getVersion($get_tpl_path, $get_tpl_name, $get_tpl_type)
    {
        $tpl_query = 'SELECT tpl_md5, tpl_expire_time, tpl_verhash FROM template WHERE tpl_path = :path AND tpl_name = :name AND tpl_type = :type';
        try {
            $tpl_stmt = $this->db->prepare($tpl_query);
            $tpl_stmt->execute([':path' => $get_tpl_path, ':name' => $get_tpl_name, ':type' => $get_tpl_type]);
            $tpl_row = $tpl_stmt->fetch(\PDO::FETCH_ASSOC);
            if ($tpl_row != false) {
                return $tpl_row;
            }
            return false;
        } catch (\PDOException $e) {
            self::throwDBError($e->getMessage(), $e->getCode());
            exit();
        }
    }

    public function createVersion($tpl_path, $tpl_name, $tpl_type, $tpl_md5, $tpl_expire_time, $tpl_verhash)
    {
        $tpl_query = 'INSERT INTO template (tpl_path, tpl_name, tpl_type, tpl_md5, tpl_expire_time, tpl_verhash) VALUES (:path, :name, :type, :md5, :expire_time, :verhash)';
        try {
            $tpl_stmt = $this->db->prepare($tpl_query);
            $tpl_stmt->execute([
                ':path' => $tpl_path,
                ':name' => $tpl_name,
                ':type' => $tpl_type,
                ':md5' => $tpl_md5,
                ':expire_time' => $tpl_expire_time,
                ':verhash' => $tpl_verhash
            ]);
        } catch (\PDOException $e) {
            self::throwDBError($e->getMessage(), $e->getCode());
            exit();
        }
    }

    public function updateVersion($tpl_path, $tpl_name, $tpl_type, $tpl_md5, $tpl_expire_time, $tpl_verhash)
    {
        $tpl_query = 'UPDATE template SET tpl_md5 = :md5, tpl_expire_time = :expire_time, tpl_verhash = :verhash WHERE tpl_path = :path AND tpl_name = :name AND tpl_type = :type';
        try {
            $tpl_stmt = $this->db->prepare($tpl_query);
            $tpl_stmt->execute([
                ':md5' => $tpl_md5,
                ':expire_time' => $tpl_expire_time,
                ':verhash' => $tpl_verhash,
                ':path' => $tpl_path,
                ':name' => $tpl_name,
                ':type' => $tpl_type
            ]);
        } catch (\PDOException $e) {
            self::throwDBError($e->getMessage(), $e->getCode());
            exit();
        }
    }

    //Throw database error excetpion
    private static function throwDBError($errorMessage, $errorCode)
    {
        $error = '<h1>Service unavailable</h1>'."\n";
        $error .= '<h2>Error Info :'.$errorMessage.'</h2>'."\n";
        $error .= '<h3>Error Code :'.$errorCode.'</h3>'."\n";
        throw new \Exception($error);
    }
}
