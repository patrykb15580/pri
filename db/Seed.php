<?php
		MyDB::clear_database_except_schema();

		$promotor1 = new Promotor(['email'=>'test1@test.com', 'password_degest'=>'password1', 'name'=>'promotor1']);
		$promotor1->save();

		$promotor2 = new Promotor(['email'=>'test2@test.com', 'password_degest'=>'password2', 'name'=>'promotor2']);
		$promotor2->save();

		$promotor3 = new Promotor(['email'=>'test3@test.com', 'password_degest'=>'password3', 'name'=>'promotor3']);
		$promotor3->save();

		$promotion_action1 = new PromotionAction(['name'=>'action1', 'promotors_id'=>'1']);
		$promotion_action1->save();

		$promotion_action2 = new PromotionAction(['name'=>'action2', 'promotors_id'=>'1']);
		$promotion_action2->save();

		$promotion_action3 = new PromotionAction(['name'=>'action3', 'promotors_id'=>'2']);
		$promotion_action3->save();

		$promotion_action4 = new PromotionAction(['name'=>'action4', 'promotors_id'=>'1']);
		$promotion_action4->save();

		$promotion_action5 = new PromotionAction(['name'=>'action5', 'promotors_id'=>'3']);
		$promotion_action5->save();

		$promotion_action6 = new PromotionAction(['name'=>'action6', 'promotors_id'=>'2']);
		$promotion_action6->save();


		print_r(CLIUntils::colorize("OK\n", 'SUCCESS'));

