<?php
  #SELECT `used` FROM promotion_codes WHERE MONTH(`used`) = 10 
?>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="/assets/javascript/promotorStats.js"></script>

  <div id="tabs">
  <ul>
    <li id="codes_first_tab"><a href="#codes_in_month_tab">Kody w danym miesiącu</a></li>
    <li id="codes_second_tab"><a href="#codes_in_year_tab">Kody w bieżącym roku</a></li>
  </ul>

  <div id="codes_in_month_tab">

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

  </div>

  <div id="codes_in_year_tab">

    <h3>Wykorzystane kody w ujęciu rocznym:</h3>
    <div id="codes_in_year_chart" data-promotorid="<?= $promotor->id ?>"></div>

  </div>

</div>

<br /><br /><br /><br />


<script type="text/javascript" src="/assets/javascript/promotorCodesUsedInMonth.js"></script>

<script type="text/javascript" src="/assets/javascript/promotorCodesUsedInYear.js"></script>

