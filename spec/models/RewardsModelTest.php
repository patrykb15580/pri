<?php
/**
* 
*/
class RewardsModelTest extends Tests
{
	
	public function testRewardsIsValid()
	{
		$rewards = new Reward(['name'=>'reward1', 'promotors_id'=>'1', 'status'=>'active', 'description'=>'Reward1 miwjfoiewjvfinmicnciuewnfiurenvfirenvirew', 'prize'=>'100']);
		Assert::expect($rewards -> isValid()) -> toEqual(true);
	}

	public function testNameShouldBeRequire()
	{
		$rewards = new Reward(['promotors_id'=>'1', 'status'=>'active', 'description'=>'Reward1 miwjfoiewjvfinmicnciuewnfiurenvfirenvirew', 'prize'=>'100']);
		Assert::expect($rewards -> isValid()) -> toEqual(false);
	}

	public function testNameShouldHaveLessThan191Chars()
	{
		$random_string = StringUntils::getRandomString(190);
		$promotion_code_package = new Reward(['name'=>$random_string, 'promotors_id'=>'1', 'status'=>'active', 'description'=>'Reward1 miwjfoiewjvfinmicnciuewnfiurenvfirenvirew', 'prize'=>'100']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(true);

		$random_string = StringUntils::getRandomString(191);
		$promotion_code_package = new Reward(['name'=>$random_string, 'promotors_id'=>'1', 'status'=>'active', 'description'=>'Reward1 miwjfoiewjvfinmicnciuewnfiurenvfirenvirew', 'prize'=>'100']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}

	public function testPrizeShouldBeRequire()
	{
		$rewards = new Reward(['name'=>'reward1', 'promotors_id'=>'1', 'status'=>'active', 'description'=>'Reward1 miwjfoiewjvfinmicnciuewnfiurenvfirenvirew']);
		Assert::expect($rewards -> isValid()) -> toEqual(false);
	}

	public function testPromotorIdShouldBeRequire()
	{
		$rewards = new Reward(['name'=>'reward1', 'status'=>'active', 'description'=>'Reward1 miwjfoiewjvfinmicnciuewnfiurenvfirenvirew', 'prize'=>'100']);
		Assert::expect($rewards -> isValid()) -> toEqual(false);
	}
}