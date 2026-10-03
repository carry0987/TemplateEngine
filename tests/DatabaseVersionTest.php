<?php
declare(strict_types=1);

namespace carry0987\Template\Tests;

use PDO;
use PHPUnit\Framework\TestCase;
use carry0987\Template\Controller\DBController;

class DatabaseVersionTest extends TestCase
{
    private PDO $pdo;
    private DBController $database;

    protected function setUp(): void
    {
        $driver = getenv('DB_DRIVER');
        if ($driver === false) {
            $this->markTestSkipped('Set DB_DRIVER to run database integration tests.');
        }

        if (!in_array($driver, ['mysql', 'pgsql'], true)) {
            $this->fail('DB_DRIVER must be mysql or pgsql.');
        }

        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $port = getenv('DB_PORT') ?: ($driver === 'pgsql' ? '5432' : '3306');
        $database = getenv('DB_NAME') ?: 'template_engine';
        $username = getenv('DB_USERNAME') ?: ($driver === 'pgsql' ? 'postgres' : 'root');
        $password = getenv('DB_PASSWORD') ?: '';
        $dsn = "{$driver}:host={$host};port={$port};dbname={$database}";
        if ($driver === 'mysql') {
            $dsn .= ';charset=utf8mb4';
        }

        $this->pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $schema = $driver === 'pgsql' ? 'postgresql.sql' : 'mysql.sql';
        $this->pdo->exec((string) file_get_contents(dirname(__DIR__).'/database/'.$schema));
        $this->pdo->exec('DELETE FROM template');
        $this->database = new DBController($this->pdo);
    }

    public function testUpsertVersionReplacesTheExistingVersion(): void
    {
        $this->assertTrue($this->database->upsertVersion('templates', 'home.html', 'html', 'first-hash', 100, 'first-version'));
        $this->assertTrue($this->database->upsertVersion('templates', 'home.html', 'html', 'second-hash', 200, 'second-version'));

        $version = $this->database->getVersion('templates', 'home.html', 'html');

        $this->assertSame('second-hash', $version['tpl_hash']);
        $this->assertSame('200', (string) $version['tpl_expire_time']);
        $this->assertSame('second-version', $version['tpl_verhash']);
        $this->assertSame(1, (int) $this->pdo->query('SELECT COUNT(*) FROM template')->fetchColumn());
    }
}
