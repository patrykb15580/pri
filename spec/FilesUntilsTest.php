<?php
/**
* 
*/
class FilesUntilsTest extends Tests
{
	
	public function test_files_list()
	{
		$files = FilesUntils::list_files('spec/fixtures/discfiles');
		Assert::expect(count($files)) -> to_equal(11);
	}

	public function test_files_xxx()
	{	
		$files_arr = array('test/path/file_1_xxx.php',
						'test/path/file_2_xxx.php',
						'test/path/file_3_xxx.php',
						'test/path/file_1.php',
						'test/path/file_2.php',
						'test/path/file_3.php');

		$files = FilesUntils::filter_test_files($files_arr, 'xxx.php');
		Assert::expect(count($files)) -> to_equal(3);
	}
}

