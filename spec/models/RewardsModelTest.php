<?php
/**
* 
*/
class RewardsModelTest extends Tests
{
	
	public function test_rewards_is_valid()
	{
		$rewards = new Reward(['name'=>'reward1', 'promotors_id'=>'1', 'status'=>'active', 'description'=>'Reward1 miwjfoiewjvfinmicnciuewnfiurenvfirenvirew', 'prize'=>'100']);
		Assert::expect($rewards -> isValid()) -> to_equal(true);
	}
}