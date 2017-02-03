<?php
    $action = $code->action();
    $contest = $action->contest();
    
    $day = date('d', strtotime($contest->to_at));
    $month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($contest->to_at))];
    $year = date('Y', strtotime($contest->to_at));

    if ($day < 10) {
        $day = str_replace('0', '', $day);
    }

    $end_date = $day.' '.$month.' '.$year.'r';
?>
<div class="confirm">
    <i class="fa fa-smile-o" aria-hidden="true"></i>
    <p class="text">Dziękujemy za wzięcie udziału w konkursie.<br /><br />O wynikach konkursu zostaniesz poinformowany mailowo <br />
            <b><?= $end_date ?></b>.</p>
    <p class="link"><a href="<?= $router->generate('home', []).'#code' ?>">Powrót</a></p>
</div>