<h3>Użyte kody</h3>
<div id="codes_charts">
  <ul>
    <li id="codes_first_tab"><a href="#codes_in_month_tab">Kody w danym miesiącu</a></li>
    <li id="codes_second_tab"><a href="#codes_in_year_tab">Kody w bieżącym roku</a></li>
    <li id="codes_third_tab"><a href="#codes_in_range_tab">Kody w okresie</a></li>
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

  <div id="codes_in_range_tab">

    <h3>
      Kody użyte od 
      <input type="text" id="codes_date_from" class="date" name="codes_date_from" value="<?= date('Y-m-d', strtotime("-1 week")) ?>"> 
      do 
      <input type="text" id="codes_date_to" class="date" name="codes_date_to" value="<?= date('Y-m-d') ?>">
      :
    </h3>
    <div id="codes_in_range_chart" data-promotorid="<?= $promotor->id ?>"></div>

  </div>

</div>

<br /><br /><br />

<script type="text/javascript" src="/assets/javascript/promotorCodesUsedInMonth.js"></script>

<script type="text/javascript" src="/assets/javascript/promotorCodesUsedInYear.js"></script>

<script type="text/javascript" src="/assets/javascript/promotorCodesUsedInRange.js"></script>

