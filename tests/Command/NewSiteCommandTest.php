<?php

/*
 * This file is part of the Yosymfony\Spress.
 *
 * (c) YoSymfony <http://github.com/yosymfony>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yosymfony\Spress\tests\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;
use Yosymfony\Spress\Command\NewSiteCommand;

class NewSiteCommandTest extends \PHPUnit_Framework_TestCase
{
    protected $tmpDir;

    public function setUp()
    {
        $this->tmpDir = sys_get_temp_dir().'/spress-tests';
    }

    public function tearDown()
    {
        $fs = new Filesystem();
        $fs->remove($this->tmpDir);
    }

    public function testNewSite()
    {
        $app = new Application();
        $app->add(new NewSiteCommand());

        $command = $app->find('new:site');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'path' => $this->tmpDir,
        ]);

        $output = $commandTester->getDisplay();

        $this->assertRegExp('/New site created/', $output);
    }

    public function testNewSiteExistsEmptyDir()
    {
        $fs = new FileSystem();
        $fs->mkdir($this->tmpDir);

        $this->assertFileExists($this->tmpDir);

        $app = new Application();
        $app->add(new NewSiteCommand());

        $command = $app->find('new:site');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'path' => $this->tmpDir,
        ]);

        $output = $commandTester->getDisplay();

        $this->assertRegExp('/New site created/', $output);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testNewSiteNotForce()
    {
        $app = new Application();
        $app->add(new NewSiteCommand());

        $command = $app->find('new:site');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'path' => $this->tmpDir,
        ]);

        $commandTester->execute([
            'path' => $this->tmpDir,
        ]);
    }

    public function testNewSiteForce()
    {
        $app = new Application();
        $app->add(new NewSiteCommand());

        $command = $app->find('new:site');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'path' => $this->tmpDir,
        ]);

        $commandTester->execute([
            'command' => $command->getName(),
            'path' => $this->tmpDir,
            '--force' => true,
        ]);

        $this->assertRegExp('/New site created/', $commandTester->getDisplay());
    }

    public function testNewSiteCompleteScaffold()
    {
        $app = new Application();
        $app->add(new NewSiteCommand());

        $command = $app->find('new:site');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'path' => $this->tmpDir,
            '--all' => true,
        ]);

        $this->assertRegExp('/New site created/', $commandTester->getDisplay());
    }
}
