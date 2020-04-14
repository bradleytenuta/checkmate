<?php

namespace Tests\Unit\App\Utility;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Utility\FileSystem;

class FileSystemTest extends TestCase
{
    /**
     * Tests that the nginx path is cleaned.
     *
     * @return void
     */
    public function testCleanFilePathNginx()
    {
        $stringToRemove = "var/www/html/storage/app/";
        $leftoverString = "test/folder/goes/here";

        $path = $stringToRemove . $leftoverString;
        $path = FileSystem::cleanFilePath($path);
        $this->assertTrue($path == $leftoverString);
    }

    /**
     * Tests that the bitbucket path is cleaned.
     *
     * @return void
     */
    public function testCleanFilePathBitbucket()
    {
        $stringToRemove = "opt/atlassian/pipelines/agent/build/src/storage/app/";
        $leftoverString = "test/folder/goes/here";

        $path = $stringToRemove . $leftoverString;
        $path = FileSystem::cleanFilePath($path);
        $this->assertTrue($path == $leftoverString);
    }

    /**
     * Tests that when a string that doesnt match the two servers goes in, it comes out the same.
     *
     * @return void
     */
    public function testNoCleanFile()
    {
        $path = "test/folder/goes/here";
        $newPath = FileSystem::cleanFilePath($path);
        $this->assertTrue($path == $newPath);
    }
}