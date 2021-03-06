<?php
/**
 * @link https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils;

use OldTown\Workflow\PhpUnit\Test\Paths;
use Ramsey\Uuid\Uuid;


/**
 * Class DirUtilTrait
 *
 * @package OldTown\Workflow\Spi\Doctrine\PhpUnit\Utils
 */
trait DirUtilTrait
{
    /**
     * @var string
     */
    protected $pathToTestTmpDir;

    /**
     *
     */
    protected function tearDownTestDir()
    {
        foreach (glob(sprintf('%s%s*', $this->pathToTestTmpDir, DIRECTORY_SEPARATOR)) as $file) {
            unlink($file);
        }
        rmdir($this->pathToTestTmpDir);
    }

    /**
     * @param array $files
     * @param       $basePath
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected function setUpTestDir(array $files = [], $basePath)
    {
        $pathToTmp = Paths::getPathToTestDataDir();
        if (!(file_exists($pathToTmp) && is_dir($pathToTmp) && is_writable($pathToTmp))) {
            call_user_func(static::class .  '::markTestSkipped', sprintf('Invalid resource %s', $pathToTmp));
        }

        $this->pathToTestTmpDir = $testDir = $pathToTmp . DIRECTORY_SEPARATOR . Uuid::uuid4()->toString();

        if (!@mkdir($testDir) && !is_dir($testDir)) {
            $errMsg = sprintf('Error create dir: %s', $testDir);
            throw new \RuntimeException($errMsg);
        }

        foreach ($files as $file) {
            $from = $basePath . DIRECTORY_SEPARATOR . $file;
            $to = $testDir . DIRECTORY_SEPARATOR . $file;
            copy($from, $to);
        }

        return $testDir;
    }
}
