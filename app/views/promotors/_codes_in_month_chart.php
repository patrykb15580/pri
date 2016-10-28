<?php
  #SELECT `used` FROM promotion_codes WHERE MONTH(`used`) = 10 
  #SELECT * FROM promotion_codes WHERE `used` > "2016-09-11 00:00:00" AND `used` < "2016-10-24 00:00:00"
?>

<h3>Wykorzystane kody w miesiącu 
<select class="codes_month" name="codes_month">
  <?php
    for ($i=1; $i <= date("m"); $i++) { ?>
      <option value="<?= $i ?>" <?php if ($i==date("m")) { echo "selected=selected"; } ?>>
        <?= PolishMonthName::NAMES[$i] ?>
      </option>
    <?php }
  ?>
</select>
<?= date("Y") ?> roku</h3>
<div id="codes_in_month_chart" data-promotorid="<?= $promotor->id ?>"></div>
<br /><br /><br />

<script type="text/javascript" src="/assets/javascript/promotorCodesUsedInMonth.js"></script>

