<?php
if (isset($params['show'])) {
	if ($params['show'] == 'actions') { 
		include '_promotor_actions.php';
	} 

	if ($params['show'] == 'rewards') { 
		include '_promotor_rewards.php';
	}

	if ($params['show'] == 'clients') { 
		include '_promotor_clients.php';
	}

	if ($params['show'] == 'orders') { 
		include '_promotor_orders.php';
	}
} else {
	include '_promotor_actions.php';
}
