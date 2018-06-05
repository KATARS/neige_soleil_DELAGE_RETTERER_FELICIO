<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reservation</title>
<link href="calendrier/jquery-ui.css" rel="stylesheet">
<link href="calendrier/style_calendrier.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="calendrier/jquery-ui.js"></script>
<script src="lang/datepicker-fr.js"></script>
<script> //script datepicker
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
</head>
<body>
  <?php
  if (isset($_POST['book'])) {
  	if(empty($errors))
  	{
  		require("calendrier/config.php");//cherche la config

      //recupere les données des formulaires
      $start_day = intval(strtotime(htmlspecialchars($_POST["start_day"]))); //convertit en int
  		$start_time = (60*60*intval(htmlspecialchars($_POST["start_hour"]))) + (60*intval(htmlspecialchars($_POST["start_minute"]))); //calcule les millisecondes
  		$end_day = intval(strtotime(htmlspecialchars($_POST["end_day"])));
  		$end_time = (60*60*intval(htmlspecialchars($_POST["end_hour"]))) + (60*intval(htmlspecialchars($_POST["end_minute"])));

  		$start_epoch = $start_day + $start_time; //definition de la période avec les jours
  		$end_epoch = $end_day + $end_time; //definition de la période avec les millisecondes
  		// prevent double booking
  		$sql = $bdd->prepare("SELECT * FROM reservation WHERE idlogement = ? AND (start_day>=$start_day OR end_day>=$start_day)");
      $sql->bindValue(1,$idlogement,PDO::PARAM_INT);
  		$sql->execute();
  		if ($sql->rowCount() > 0) {
        //check toutes les lignes
  			while($row = $sql->fetch()) {
  				for ($i = $start_epoch; $i <= $end_epoch; $i=$i+600) {
  					if ($i>($row["start_day"]+$row["start_time"]) && $i<($row["end_day"]+$row["end_time"])) {
            $sql->closeCursor();//verification doublons
            }
  				}
  			} echo "Le bien n'est pas disponible pour la période séléctionnée";
  		} else {

      $insertres = $bdd->prepare("INSERT INTO reservation(start_day,start_time,end_day,end_time,idlogement,item,id,name)
        VALUES (?,?,?,?,?,?,?,?)");
      $insertres->bindValue(1, $start_day, PDO::PARAM_INT);
      $insertres->bindValue(2, $start_time, PDO::PARAM_INT);
      $insertres->bindValue(3, $end_day, PDO::PARAM_INT);
      $insertres->bindValue(4, $end_time, PDO::PARAM_INT);
      $insertres->bindValue(5, $idlogement, PDO::PARAM_INT);
      $insertres->bindValue(6, $item, PDO::PARAM_STR);
      $insertres->bindValue(7, $id, PDO::PARAM_INT);
      $insertres->bindValue(8, $name, PDO::PARAM_STR);
      $insertres->execute();
      echo "Reservation réussie"; //ajoute reservation
    }
  	}
  }
  ?>
<h1>Disponibilités</h1>
<table border="1" cellpadding="5" width="900">
	<tr>
		<td valign="top">
		<form action="" method="post">
			<table style="width: 70%">
					<td>Reservation:</td>
					<td>
			         <input name="start_day" required="" type="date" /></td>
					<td>-</td>
					<td><input name="end_day" required="" type="date" /></td>
				</tr>
        <tr>
					<td>&nbsp;</td>
					<td> <select name="start_hour">
			<option selected="selected">12</option>
			<option>01</option>
			<option>02</option>
			<option>03</option>
			<option>04</option>
			<option>05</option>
			<option>06</option>
			<option>07</option>
			<option>08</option>
			<option>09</option>
			<option>10</option>
			<option>11</option>
			<option>12</option>
			<option>13</option>
			<option>14</option>
			<option>15</option>
			<option>16</option>
			<option>17</option>
			<option>18</option>
			<option>19</option>
			<option>20</option>
			<option>21</option>
			<option>22</option>
			<option>23</option>
			</select>:<select name="start_minute">
			<option selected="selected">00</option>
			<option>30</option>
			</select></td>
					<td>&nbsp;</td>
					<td><select name="end_hour">
			<option>00</option>
			<option>01</option>
			<option>02</option>
			<option>03</option>
			<option>04</option>
			<option>05</option>
			<option>06</option>
			<option>07</option>
			<option>08</option>
			<option>09</option>
			<option>10</option>
			<option>11</option>
			<option>12</option>
			<option>13</option>
			<option>14</option>
			<option>15</option>
			<option>16</option>
			<option>17</option>
			<option>18</option>
			<option>19</option>
			<option>20</option>
			<option>21</option>
			<option>22</option>
			<option selected="selected">12</option>
			</select>:<select name="end_minute">
			<option>00</option>
			<option selected="selected">00</option>
    </select></td></tr>
  </table><table><tr>
    <td><button type="submit" class="btn btn-primary btn-lg" name="book">Reserver</button></td>
    <td><h4>Veuillez verifier le calendrier avant de selectionner des dates</h4></td>
  </tr>
		</form>
	</tr>
</table>
<button type="button" class="btn btn-success btn-lg" id="hideshow">Voir Calendrier</button>
<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery('#hideshow').on('click', function(event) {
             jQuery('#content').toggle('show');
        });
    });
</script>

<div id="content" style="display:none">
  <?php
  /* draws a calendar */
  function draw_calendar($month,$year){

  require("calendrier/config.php");

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
        $current_epoch = mktime(0,0,0,$month,$list_day,$year);//recupere date aujourd'hui

        $idlogement = $_GET['idlogement'];
        $sql = $bdd->prepare("SELECT * FROM reservation WHERE idlogement = ? AND $current_epoch BETWEEN start_day AND end_day;");//empeche la reservation avant
        $sql->bindValue(1, $idlogement, PDO::PARAM_INT);
        $sql->execute();

          if ($sql->rowCount() > 0) {

            while($row = $sql->fetch()) {
              //affiche info dans calendrier
              $calendar .= "<b>Non Disponible<br>";

              if($current_epoch == $row["start_day"] AND $current_epoch != $row["end_day"]) {
                $calendar .= "DEBUT: " . sprintf("%02d:%02d", $row["start_time"]/60/60, ($row["start_time"]%(60*60)/60)) . "<br><hr><br>";
              }
              if($current_epoch == $row["end_day"]) {
                $calendar .= "FIN: " . sprintf("%02d:%02d", $row["end_time"]/60/60, ($row["end_time"]%(60*60)/60)) . "<br><hr><br>";
              }
              if($current_epoch != $row["start_day"] AND $current_epoch != $row["end_day"]) {
                $calendar .= "";
              }
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
  require("calendrier/config.php"); //affiche les mois suivants ...

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

</div>
</body>
</html>
