<?php	
	$router = Config::get('router');
	$user = StringUntils::camelCaseToUnderscore(str_replace('Controller', '', $params['controller']));
	if ($user == 'clients') {
		$user_type = 'client';
		$side_bar = '_clients_side_bar.php';
		$client = Client::find($params['client_id']);
		if (empty($client->name)) {
			$user = $client->email;
			$user = explode('@', $user);
			$user = $user[0];
		} else {
			$user = $client->name;
		}
	} elseif ($user == 'admin') {
		$user_type = 'admin';
		$side_bar = '_admin_side_bar.php';
		$user = 'Administrator';
	} else {
		$user_type = 'promotor';
		$side_bar = '_promotors_side_bar.php';
		$promotor = Promotor::find($params['promotors_id']);
		$user = $promotor->name;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		punktacja.pl
	</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/app.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/promotorSidebar.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/clientSidebar.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/adminSidebar.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/appTop.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/formPage.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/clientViews.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/titleBlock.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/tables.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/modals.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/notice.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/clientRewardDetails.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/alerts.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/tabs.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/dataBox.css">
	<link rel="stylesheet" href="/assets/javascript/trumbowyg/dist/ui/trumbowyg.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet"> 
	<script src="js/jquery.guardian-1.0.min.js"></script>
	<script type="text/javascript" src="/assets/javascript/alerts.js"></script> 
	<script type="text/javascript" src="/assets/javascript/notices.js"></script> 
	<script src="https://use.fontawesome.com/e806e76f5f.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	<script type="text/javascript" src="/assets/javascript/tabs.js"></script>
	<script type="text/javascript" src="/assets/javascript/userOptions.js"></script>
	<script src="/assets/javascript/jquery-cookie/jquery.cookie.js"></script>
	<script src="/assets/javascript/trumbowyg/dist/trumbowyg.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php Alerts::showAlert(); ?>

<div id="top" class="dark_font">
	<img class="logo" src="/assets/image/punktacja-logo.png">
	<span class="logo">Punktacja.pl</span>
	<button class="toggle-menu"><i class="fa fa-bars" aria-hidden="true"></i></button>
	<!--
	<div id="main-layout-user" class="dark_font">
		<p class="user"><?= $user ?><i class="fa fa-caret-down dropdown" aria-hidden="true"></i></p>
		<?php
			if ($user_type == 'promotor') { 
				$avatar = PromotorAvatar::findBy('promotor_id', $promotor->id);
				if (!empty($avatar)) { ?>
					<img class="avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/very_small/<?= $avatar->file_name ?>">
				<?php } else { ?>
					<div class="avatar"></div>
				<?php } 
			}
		?>
		<div class="user-options">
			<?php
				if ($user_type == 'promotor') { ?>
					<a href="<?= $router->generate('edit_promotor', ['promotors_id'=>$params['promotors_id']]) ?>">
						<i class="fa fa-cog fa-lg dark-purple-icon" aria-hidden="true"></i> Ustawienia konta
					</a>
					<br />
				<?php }
				if ($user_type == 'client') { ?>
					<a href="<?= $router->generate('edit_client', ['client_id'=>$params['client_id']]) ?>">
						<i class="fa fa-cog fa-lg dark-purple-icon" aria-hidden="true"></i> Ustawienia konta
					</a>
					<br />
				<?php }
			?>
			<a href="<?= $router->generate('sign_out', []) ?>"><i class="fa fa-sign-out fa-lg red-icon" aria-hidden="true"></i> Wyloguj</a>
		</div>
	</div>
	-->
</div>
<?php 
include './app/views/layouts/'.$side_bar; ?>
<div id="content">
	<?php include($path); ?>
</div>

<script type="text/javascript" src="/assets/javascript/datepicker.js"></script>
<script type="text/javascript" src="/assets/javascript/guardianInitialize.js"></script>
<script type="text/javascript" src="/assets/javascript/menu.js"></script>
<script src="/assets/javascript/dataBox.js"></script>
</body>
</html>