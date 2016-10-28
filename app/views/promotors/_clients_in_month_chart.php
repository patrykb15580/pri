<?php
  #SELECT `used` FROM promotion_codes WHERE MONTH(`used`) = 10 
  #SELECT * FROM promotion_codes WHERE `used` > "2016-09-11 00:00:00" AND `used` < "2016-10-24 00:00:00"
?>
<div id="clients_in_month_chart_box">
  <h3>Nowi klienci w miesiącu 
  <select class="clients_month" name="clients_month">
    <?php
      for ($i=1; $i <= date("m"); $i++) { ?>
        <option value="<?= $i ?>" <?php if ($i==date("m")) { echo "selected=selected"; } ?>>
          <?= PolishMonthName::NAMES[$i] ?>
        </option>
      <?php }
    ?>
  </select>
  <?= date("Y") ?> roku</h3>
  <div id="clients_in_month_chart" data-promotorid="<?= $promotor->id ?>"></div>
</div>
<br /><br /><br />

<script type="text/javascript" src="/assets/javascript/promotorNewClientsInMonth.js"></script>
