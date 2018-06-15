<head>
<script>
    $(function() {
  <!--$.datepicker.setDefaults($.datepicker.regional['fi']);-->
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
    regional: "fi",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<link href="../logement/calendrier/jquery-ui.css" rel="stylesheet">
<script src="../logement/calendrier/jquery-ui.js"></script>
<link href="../logement/calendrier/style_calendrier.css" rel="stylesheet">
<button type="button" class="btn btn-success btn-lg" id="hideshow">Voir Calendrier</button>
<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery('#hideshow').on('click', function(event) {
             jQuery('#content').toggle('show');
        });
    });
</script>
</head>
</body>
<div id="content">
  <?php
  /* draws a calendar */
  function draw_calendar($month,$year){

  require("../logement/calendrier/config.php");

    /* draw table */
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

    /* table headings */
    $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

    /* days and weeks vars now ... */
    $running_day = date('w',mktime(0,0,0,$month,1,$year));
    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar.= '<tr class="calendar-row">';

    /* print "blank" days until the first of the current week */
    for($x = 0; $x < $running_day; $x++):
      $calendar.= '<td class="calendar-day-np"> </td>';
      $days_in_this_week++;
    endfor;

    /* keep going with days.... */
    for($list_day = 1; $list_day <= $days_in_month; $list_day++):
      $calendar.= '<td class="calendar-day">';
        /* add in the day number */
        $calendar.= '<div class="day-number">'.$list_day.'</div>';

        /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
        $calendar.= str_repeat('<p> </p>',2);
        $current_epoch = mktime(0,0,0,$month,$list_day,$year);

        $sql = $bdd->prepare("SELECT * FROM reservation WHERE $current_epoch BETWEEN start_day AND end_day;");
        $sql->execute();

          if ($sql->rowCount() > 0) {
            // output data of each row
            while($row = $sql->fetch()) {
            if($row["canceled"] == 1) $calendar .= "<font color=\"red\"><s>";
              $calendar .= "<b>ID Res : ".$row['idreservation']."</br> ID Logement : ".$row['idlogement']."</br>";

              if($current_epoch == $row["start_day"] AND $current_epoch != $row["end_day"]) {
                $calendar .= "DEBUT: " . sprintf("%02d:%02d", $row["start_time"]/60/60, ($row["start_time"]%(60*60)/60)) . "<br><hr><br>";
              }
              if($current_epoch == $row["end_day"]) {
                $calendar .= "FIN: " . sprintf("%02d:%02d", $row["end_time"]/60/60, ($row["end_time"]%(60*60)/60)) . "<br><hr><br>";
              }
              if($current_epoch != $row["start_day"] AND $current_epoch != $row["end_day"]) {
                $calendar .= "";
              }
            if($row["canceled"] == 1) $calendar .= "</s></font>";
            }
        } else {
            $calendar .= "";
        }
      $calendar.= '</td>';
      if($running_day == 6):
        $calendar.= '</tr>';
        if(($day_counter+1) != $days_in_month):
          $calendar.= '<tr class="calendar-row">';
        endif;
        $running_day = -1;
        $days_in_this_week = 0;
      endif;
      $days_in_this_week++; $running_day++; $day_counter++;
    endfor;

    /* finish the rest of the days in the week */
    if($days_in_this_week < 8):
      for($x = 1; $x <= (8 - $days_in_this_week); $x++):
        $calendar.= '<td class="calendar-day-np"> </td>';
      endfor;
    endif;

    /* final row */
    $calendar.= '</tr>';

    /* end the table */
    $calendar.= '</table>';
    $sql->closeCursor();


    /* all done, return result */
    return $calendar;
  }
  require("../logement/calendrier/config.php");

  $d = new DateTime(date("Y-m-d"));
  echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
  echo draw_calendar($d->format('m'),$d->format('Y'));

  $d->modify( 'first day of next month' );
  echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
  echo draw_calendar($d->format('m'),$d->format('Y'));
  ?>
  <br/>
  <button type="button" class="btn btn-info btn-lg" id="hideshow2">Afficher plus/moins</button>
  <script type="text/javascript">
  jQuery(document).ready(function(){
          jQuery('#hideshow2').on('click', function(event) {
               jQuery('#content2').toggle('show');
          });
      });
  </script>
  <div id="content2" style="display:none">
    <?php
  $d->modify( 'first day of next month' );
  echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
  echo draw_calendar($d->format('m'),$d->format('Y'));
  $d->modify( 'first day of next month' );

  echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
  echo draw_calendar($d->format('m'),$d->format('Y'));

  ?>
  <br/>
  <button type="button" class="btn btn-info btn-lg" id="hideshow3">Afficher plus/moins</button>
  <script type="text/javascript">
  jQuery(document).ready(function(){
          jQuery('#hideshow3').on('click', function(event) {
               jQuery('#content3').toggle('show');
          });
      });
  </script>
  <div id="content3" style="display:none"><?php
  $d->modify( 'first day of next month' );
  echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
  echo draw_calendar($d->format('m'),$d->format('Y'));
  $d->modify( 'first day of next month' );

  echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
  echo draw_calendar($d->format('m'),$d->format('Y'));

  echo'<h3>Fin de saison</h3>';

  ?></div>
  </div>
</div>
</body>
</html>
