<?php
		MyDB::clearDatabaseExceptSchema();

		$promotor = new Promotor(['email'=>'test1@test.com', 'password_degest'=>Password::encryptPassword('password1'), 'name'=>'Booklet']);
		$promotor->save();

		$promotor = new Promotor(['email'=>'test2@test.com', 'password_degest'=>Password::encryptPassword('password2'), 'name'=>'promotor2']);
		$promotor->save();

		$promotor = new Promotor(['email'=>'test3@test.com', 'password_degest'=>Password::encryptPassword('password3'), 'name'=>'promotor3']);
		$promotor->save();

		$promotor = new Promotor(['email'=>'test4@test.com', 'password_degest'=>Password::encryptPassword('password4'), 'name'=>'promotor4']);
		$promotor->save();

		print_r(CLIUntils::colorize("Promotors: OK\n", 'SUCCESS'));

		$action = new Action(['name'=>'Action 1', 'description'=>'Description for action 1', 'promotor_id'=>1, 'status'=>'active', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'1', 'indefinitely'=>1]);
		$promotion_action->save();


		$action = new Action(['name'=>'Action 2', 'description'=>'Description for action 2', 'promotor_id'=>2, 'status'=>'active', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'2', 'indefinitely'=>0, 'from_at'=>date("Y-m-d", strtotime("-1 week")), 'to_at'=>date("Y-m-d", strtotime("+1 week"))]);
		$promotion_action->save();


		$action = new Action(['name'=>'Action 3', 'description'=>'Description for action 3', 'promotor_id'=>1, 'status'=>'inactive', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'3', 'indefinitely'=>0, 'from_at'=>date("Y-m-d", strtotime("+1 day")), 'to_at'=>date("Y-m-d", strtotime("+1 week"))]);
		$promotion_action->save();


		$action = new Action(['name'=>'Action 4', 'description'=>'Description for action 4', 'promotor_id'=>4, 'status'=>'active', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'4', 'indefinitely'=>0, 'from_at'=>date("Y-m-d", strtotime("-1 day")), 'to_at'=>date("Y-m-d", strtotime("+2 week"))]);
		$promotion_action->save();


		$action = new Action(['name'=>'Action 5', 'description'=>'Description for action 5', 'promotor_id'=>1, 'status'=>'inactive', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'5', 'indefinitely'=>1]);
		$promotion_action->save();


		$action = new Action(['name'=>'Action 6', 'description'=>'Description for action 6', 'promotor_id'=>3, 'status'=>'active', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'6', 'indefinitely'=>0, 'from_at'=>date("Y-m-d", strtotime("-2 week")), 'to_at'=>date("Y-m-d", strtotime("-1 week"))]);
		$promotion_action->save();


		$action = new Action(['name'=>'Action 7', 'description'=>'Description for action 7', 'promotor_id'=>3, 'status'=>'active', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'7', 'indefinitely'=>1]);
		$promotion_action->save();


		$action = new Action(['name'=>'Action 8', 'description'=>'Description for action 8', 'promotor_id'=>2, 'status'=>'inactive', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'8', 'indefinitely'=>1]);
		$promotion_action->save();


		$action = new Action(['name'=>'Action 9', 'description'=>'Description for action 9', 'promotor_id'=>4, 'status'=>'inactive', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'9', 'indefinitely'=>1]);
		$promotion_action->save();


		$action = new Action(['name'=>'Action 10', 'description'=>'Description for action 10', 'promotor_id'=>1, 'status'=>'active', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'10', 'indefinitely'=>0, 'from_at'=>date("Y-m-d", strtotime("-2 week")), 'to_at'=>date("Y-m-d", strtotime("+5 days"))]);
		$promotion_action->save();

		print_r(CLIUntils::colorize("Promotion actions: OK\n", 'SUCCESS'));


		$action = new Action(['name'=>'Konkurs Booklet', 'description'=>'Description for contest 1', 'promotor_id'=>1, 'status'=>'active', 'type'=>'Contests']);
		$action->save();

		$contest = new Contest(['question'=>'Co sądzisz o naszej drukarni?', 'from_at'=>date("Y-m-d", strtotime("-3 days")), 'to_at'=>date("Y-m-d", strtotime("+4 days")), 'action_id'=>'11']);
		$contest->save();

		print_r(CLIUntils::colorize("Contests: OK\n", 'SUCCESS'));


		$opinion = new Opinion(['question'=>'Jak oceniasz nasze naklejki?', 'action_id'=>'11']);
		$opinion->save();

		print_r(CLIUntils::colorize("Opinions: OK\n", 'SUCCESS'));


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


		$package = new CodesPackage(['action_id'=>1, 'quantity'=>20, 'codes_value'=>2000, 'status'=>'active', 'description'=>'Codes package for action 1']);
		$package->save();

		$package = new CodesPackage(['action_id'=>2, 'quantity'=>20, 'codes_value'=>1000, 'status'=>'active', 'description'=>'Codes package for action 2']);
		$package->save();

		$package = new CodesPackage(['action_id'=>11, 'quantity'=>20, 'codes_value'=>0, 'status'=>'active', 'description'=>'Codes package for action 11']);
		$package->save();

		print_r(CLIUntils::colorize("Promotion codes packages: OK\n", 'SUCCESS'));


		$admin_order = new AdminOrder(['promotor_id'=>1, 'package_type'=>'action', 'package_id'=>1, 'quantity'=>20, 'order_date'=>date(Config::get('mysqltime'))]);
		$admin_order->save();

		$admin_order = new AdminOrder(['promotor_id'=>2, 'package_type'=>'action', 'package_id'=>2, 'quantity'=>20, 'order_date'=>date(Config::get('mysqltime'))]);
		$admin_order->save();

		print_r(CLIUntils::colorize("Admin orders: OK\n", 'SUCCESS'));
		
		
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

