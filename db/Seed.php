<?php
		MyDB::clear_database_except_schema();

		$promotor1 = new Promotor(['email'=>'test1@test.com', 'password_degest'=>'password1', 'name'=>'promotor1']);
		$promotor1->save();

		$promotor2 = new Promotor(['email'=>'test2@test.com', 'password_degest'=>'password2', 'name'=>'promotor2']);
		$promotor2->save();

		$promotor3 = new Promotor(['email'=>'test3@test.com', 'password_degest'=>'password3', 'name'=>'promotor3']);
		$promotor3->save();

		$promotor4 = new Promotor(['email'=>'test4@test.com', 'password_degest'=>'password4', 'name'=>'promotor4']);
		$promotor4->save();

		print_r(CLIUntils::colorize("Promotors: OK\n", 'SUCCESS'));

		$promotion_action1 = new PromotionAction(['name'=>'action1', 'promotors_id'=>'1', 'status'=>'inactive', 'indefinitely'=>1]);
		$promotion_action1->save();

		$promotion_action2 = new PromotionAction(['name'=>'action2', 'promotors_id'=>'1', 'status'=>'active', 'indefinitely'=>0, 'from_at'=>'2016-04-01', 'to_at'=>'2016-10-01']);
		$promotion_action2->save();

		$promotion_action3 = new PromotionAction(['name'=>'action3', 'promotors_id'=>'3', 'status'=>'inactive', 'indefinitely'=>0, 'from_at'=>'2016-09-01', 'to_at'=>'2016-11-01']);
		$promotion_action3->save();

		$promotion_action4 = new PromotionAction(['name'=>'action4', 'promotors_id'=>'2', 'status'=>'active', 'indefinitely'=>0, 'from_at'=>'2016-09-11', 'to_at'=>'2016-09-18']);
		$promotion_action4->save();

		$promotion_action5 = new PromotionAction(['name'=>'action5', 'promotors_id'=>'1', 'status'=>'active', 'indefinitely'=>1]);
		$promotion_action5->save();

		$promotion_action6 = new PromotionAction(['name'=>'action6', 'promotors_id'=>'4', 'status'=>'inactive', 'indefinitely'=>0, 'from_at'=>'2016-08-31', 'to_at'=>'2016-09-30']);
		$promotion_action6->save();

		$promotion_action7 = new PromotionAction(['name'=>'action7', 'promotors_id'=>'2', 'status'=>'active', 'indefinitely'=>1]);
		$promotion_action7->save();

		$promotion_action8 = new PromotionAction(['name'=>'action8', 'promotors_id'=>'4', 'status'=>'inactive', 'indefinitely'=>1]);
		$promotion_action8->save();

		$promotion_action9 = new PromotionAction(['name'=>'action9', 'promotors_id'=>'3', 'status'=>'active', 'indefinitely'=>1]);
		$promotion_action9->save();

		$promotion_action10 = new PromotionAction(['name'=>'action10', 'promotors_id'=>'1', 'status'=>'inactive', 'indefinitely'=>0, 'from_at'=>'2016-07-23', 'to_at'=>'2016-11-23']);
		$promotion_action10->save();

		print_r(CLIUntils::colorize("Promotion actions: OK\n", 'SUCCESS'));

		$reward1 = new Reward(['name'=>'reward1', 'promotors_id'=>'1', 'status'=>'active', 'description'=>'Reward1 description', 'prize'=>'100']);
		$reward1->save();

		$reward2 = new Reward(['name'=>'reward2', 'promotors_id'=>'4', 'status'=>'active', 'description'=>'Reward2 description', 'prize'=>'150']);
		$reward2->save();

		$reward3 = new Reward(['name'=>'reward3', 'promotors_id'=>'2', 'status'=>'inactive', 'description'=>'Reward3 description', 'prize'=>'320']);
		$reward3->save();

		$reward4 = new Reward(['name'=>'reward4', 'promotors_id'=>'1', 'status'=>'active', 'description'=>'Reward4 description', 'prize'=>'840']);
		$reward4->save();

		$reward5 = new Reward(['name'=>'reward5', 'promotors_id'=>'3', 'status'=>'inactive', 'description'=>'Reward5 description', 'prize'=>'200']);
		$reward5->save();

		$reward6 = new Reward(['name'=>'reward6', 'promotors_id'=>'1', 'status'=>'inactive', 'description'=>'Reward6 description', 'prize'=>'50']);
		$reward6->save();

		$reward7 = new Reward(['name'=>'reward7', 'promotors_id'=>'4', 'status'=>'inactive', 'description'=>'Reward7 description', 'prize'=>'500']);
		$reward7->save();

		$reward8 = new Reward(['name'=>'reward8', 'promotors_id'=>'2', 'status'=>'active', 'description'=>'Reward8 description', 'prize'=>'480']);
		$reward8->save();

		$reward9 = new Reward(['name'=>'reward9', 'promotors_id'=>'3', 'status'=>'active', 'description'=>'Reward9 description', 'prize'=>'670']);
		$reward9->save();

		$reward10 = new Reward(['name'=>'reward10', 'promotors_id'=>'2', 'status'=>'inactive', 'description'=>'Reward10 description', 'prize'=>'795']);
		$reward10->save();

		print_r(CLIUntils::colorize("Rewards: OK\n", 'SUCCESS'));

		$package1 = new PromotionCodesPackage(['name'=>'package1', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		$package1->save();

		print_r(CLIUntils::colorize("Promotion codes packages: OK\n", 'SUCCESS'));

		print_r(CLIUntils::colorize("All OK\n", 'SUCCESS'));

