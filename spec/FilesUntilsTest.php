<?php
/**
* 
*/
class FilesUntilsTest extends Tests
{
	
	public function testFilesList()
	{
		$files = FilesUntils::listFiles('spec/fixtures/discfiles');
		Assert::expect(count($files)) -> toEqual(11);
	}

	public function testListXxxFiles()
	{	
		$files_arr = array('test/path/file_1_xxx.php',
						'test/path/file_2_xxx.php',
						'test/path/file_3_xxx.php',
						'test/path/file_1.php',
						'test/path/file_2.php',
						'test/path/file_3.php');

		$files = FilesUntils::filterTestFiles($files_arr, 'xxx.php');
		Assert::expect(count($files)) -> toEqual(3);
	}
}

