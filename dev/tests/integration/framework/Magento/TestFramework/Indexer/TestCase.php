<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\TestFramework\Indexer;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var bool
     */
    protected static $dbRestored = false;

    /**
     * @inheritDoc
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return void
     */
    public static function tearDownAfterClass(): void
    {
        if (false === self::$dbRestored) {
            self::restoteFromDb();
            self::$dbRestored = true;
        }
    }

    /**
     * Restore DB data after test execution.
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected static function restoteFromDb(): void
    {
        $db = \Magento\TestFramework\Helper\Bootstrap::getInstance()->getBootstrap()
            ->getApplication()
            ->getDbInstance();
        if (!$db->isDbDumpExists()) {
            throw new \LogicException('DB dump does not exist.');
        }
        $db->restoreFromDbDump();
    }
}
