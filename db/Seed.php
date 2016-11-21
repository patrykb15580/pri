<?php
		MyDB::clearDatabaseExceptSchema();

		$promotor = new Promotor(['email'=>'test1@test.com', 'password_degest'=>Password::encryptPassword('password1'), 'name'=>'promotor1']);
		$promotor->save();

		$promotor = new Promotor(['email'=>'test2@test.com', 'password_degest'=>Password::encryptPassword('password2'), 'name'=>'promotor2']);
		$promotor->save();

		$promotor = new Promotor(['email'=>'test3@test.com', 'password_degest'=>Password::encryptPassword('password3'), 'name'=>'promotor3']);
		$promotor->save();

		$promotor = new Promotor(['email'=>'test4@test.com', 'password_degest'=>Password::encryptPassword('password4'), 'name'=>'promotor4']);
		$promotor->save();

		print_r(CLIUntils::colorize("Promotors: OK\n", 'SUCCESS'));


		$promotion_action = new PromotionAction(['name'=>'action1', 'promotors_id'=>'1', 'status'=>'active', 'indefinitely'=>1, 'description'=>'desc']);
		$promotion_action->save();

		$promotion_action = new PromotionAction(['name'=>'action2', 'promotors_id'=>'1', 'status'=>'inactive', 'indefinitely'=>0, 'from_at'=>date("Y-m-d", strtotime("-1 week")), 'to_at'=>date("Y-m-d", strtotime("+1 week")), 'description'=>'desc']);
		$promotion_action->save();

		$promotion_action = new PromotionAction(['name'=>'action3', 'promotors_id'=>'3', 'status'=>'inactive', 'indefinitely'=>0, 'from_at'=>date("Y-m-d", strtotime("+1 day")), 'to_at'=>date("Y-m-d", strtotime("+1 week")), 'description'=>'desc']);
		$promotion_action->save();

		$promotion_action = new PromotionAction(['name'=>'action4', 'promotors_id'=>'2', 'status'=>'active', 'indefinitely'=>0, 'from_at'=>date("Y-m-d", strtotime("-1 day")), 'to_at'=>date("Y-m-d", strtotime("+2 week")), 'description'=>'desc']);
		$promotion_action->save();

		$promotion_action = new PromotionAction(['name'=>'action5', 'promotors_id'=>'1', 'status'=>'active', 'indefinitely'=>1, 'description'=>'desc']);
		$promotion_action->save();

		$promotion_action = new PromotionAction(['name'=>'action6', 'promotors_id'=>'4', 'status'=>'inactive', 'indefinitely'=>0, 'from_at'=>date("Y-m-d", strtotime("-2 week")), 'to_at'=>date("Y-m-d", strtotime("-1 week")), 'description'=>'desc']);
		$promotion_action->save();

		$promotion_action = new PromotionAction(['name'=>'action7', 'promotors_id'=>'1', 'status'=>'active', 'indefinitely'=>1, 'description'=>'desc']);
		$promotion_action->save();

		$promotion_action = new PromotionAction(['name'=>'action8', 'promotors_id'=>'4', 'status'=>'inactive', 'indefinitely'=>1, 'description'=>'desc']);
		$promotion_action->save();

		$promotion_action = new PromotionAction(['name'=>'action9', 'promotors_id'=>'3', 'status'=>'active', 'indefinitely'=>1, 'description'=>'desc']);
		$promotion_action->save();

		$promotion_action = new PromotionAction(['name'=>'action10', 'promotors_id'=>'1', 'status'=>'inactive', 'indefinitely'=>0, 'from_at'=>date("Y-m-d", strtotime("-2 week")), 'to_at'=>date("Y-m-d", strtotime("+5 days")), 'description'=>'desc']);
		$promotion_action->save();

		print_r(CLIUntils::colorize("Promotion actions: OK\n", 'SUCCESS'));


		$contest = new Contest(['name'=>'contest1', 'question'=>'Is this question?', 'from_at'=>date("Y-m-d", strtotime("-3 days")), 'to_at'=>date("Y-m-d", strtotime("+4 days")), 'promotor_id'=>'1', 'status'=>'active', 'type'=>0]);
		$contest->save();

		print_r(CLIUntils::colorize("Contests: OK\n", 'SUCCESS'));


		/*
		$contest_answer = new ContestAnswer(['contest_id'=>1, 'client_id'=>1, 'answer'=>'Yes']);
		$contest_answer->save();

		$contest_answer = new ContestAnswer(['contest_id'=>1, 'client_id'=>2, 'answer'=>'Yes']);
		$contest_answer->save();

		$contest_answer = new ContestAnswer(['contest_id'=>1, 'client_id'=>3, 'answer'=>'No']);
		$contest_answer->save();

		$contest_answer = new ContestAnswer(['contest_id'=>1, 'client_id'=>5, 'answer'=>'No']);
		$contest_answer->save();

		$contest_answer = new ContestAnswer(['contest_id'=>1, 'client_id'=>4, 'answer'=>'Yes']);
		$contest_answer->save();

		$contest_answer = new ContestAnswer(['contest_id'=>1, 'client_id'=>6, 'answer'=>'No']);
		$contest_answer->save();

		print_r(CLIUntils::colorize("Contests answers: OK\n", 'SUCCESS'));
		*/


		$package = new PromotionCodesPackage(['name'=>'package1', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>10, 'codes_value'=>2000, 'status'=>'active', 'description'=>'desc']);
		$package->save();

		print_r(CLIUntils::colorize("Promotion codes packages: OK\n", 'SUCCESS'));
		
		
		$reward = new Reward(['name'=>'reward1', 'promotors_id'=>'1', 'status'=>'active', 'description'=>'Reward1 description', 'prize'=>'100']);
		$reward->save();

		$reward = new Reward(['name'=>'reward2', 'promotors_id'=>'4', 'status'=>'active', 'description'=>'Reward2 description', 'prize'=>'150']);
		$reward->save();

		$reward = new Reward(['name'=>'reward3', 'promotors_id'=>'2', 'status'=>'inactive', 'description'=>'Reward3 description', 'prize'=>'320']);
		$reward->save();

		$reward = new Reward(['name'=>'reward4', 'promotors_id'=>'1', 'status'=>'active', 'description'=>'Reward4 description', 'prize'=>'840']);
		$reward->save();

		$reward = new Reward(['name'=>'reward5', 'promotors_id'=>'3', 'status'=>'inactive', 'description'=>'Reward5 description', 'prize'=>'200']);
		$reward->save();

		$reward = new Reward(['name'=>'reward6', 'promotors_id'=>'1', 'status'=>'inactive', 'description'=>'Reward6 description', 'prize'=>'50']);
		$reward->save();

		$reward = new Reward(['name'=>'reward7', 'promotors_id'=>'4', 'status'=>'inactive', 'description'=>'Reward7 description', 'prize'=>'500']);
		$reward->save();

		$reward = new Reward(['name'=>'reward8', 'promotors_id'=>'2', 'status'=>'active', 'description'=>'Reward8 description', 'prize'=>'480']);
		$reward->save();

		$reward = new Reward(['name'=>'reward9', 'promotors_id'=>'3', 'status'=>'active', 'description'=>'Reward9 description', 'prize'=>'670']);
		$reward->save();

		$reward = new Reward(['name'=>'reward10', 'promotors_id'=>'2', 'status'=>'inactive', 'description'=>'Reward10 description', 'prize'=>'795']);
		$reward->save();

		print_r(CLIUntils::colorize("Rewards: OK\n", 'SUCCESS'));
		

		print_r(CLIUntils::colorize("All OK\n", 'SUCCESS'));

