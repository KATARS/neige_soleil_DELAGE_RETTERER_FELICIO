<head>
<style>
html *
{
   font-family: Arial !important;
}
table.calendar {
	border-left: 1px solid #999;
}
tr.calendar-row {
}
td.calendar-day {
	min-height: 80px;
	font-size: 11px;
	position: relative;
	vertical-align: top;
}
* html div.calendar-day {
	height: 80px;
}
td.calendar-day:hover {
	background: #eceff5;
}
td.calendar-day-np {
	background: #eee;
	min-height: 80px;
}
* html div.calendar-day-np {
	height: 80px;
}
td.calendar-day-head {
	background: #ccc;
	font-weight: bold;
	text-align: center;
	width: 120px;
	padding: 5px;
	border-bottom: 1px solid #999;
	border-top: 1px solid #999;
	border-right: 1px solid #999;
}
div.day-number {
	background: #999;
	padding: 5px;
	color: #fff;
	font-weight: bold;
	float: right;
	margin: -5px -5px 0 0;
	width: 20px;
	text-align: center;
}
td.calendar-day, td.calendar-day-np {
	width: 120px;
	padding: 5px;
	border-bottom: 1px solid #999;
	border-right: 1px solid #999;
}
</style>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Reservation</title>
<link href="calendrier/jquery-ui.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="calendrier/jquery-ui.js"></script>
<!--<script src="lang/datepicker-fi.js"></script>-->
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
</head>

<body>
  <?php
  if (isset($_POST['book'])) {
  	if(empty($errors))
  	{
  		require("calendrier/config.php");

  		$start_day = intval(strtotime(htmlspecialchars($_POST["start_day"])));
  		$start_time = (60*60*intval(htmlspecialchars($_POST["start_hour"]))) + (60*intval(htmlspecialchars($_POST["start_minute"])));
  		$end_day = intval(strtotime(htmlspecialchars($_POST["end_day"])));
  		$end_time = (60*60*intval(htmlspecialchars($_POST["end_hour"]))) + (60*intval(htmlspecialchars($_POST["end_minute"])));
  		//$name = htmlspecialchars($_SESSION["nom"]);
  		//iduser = htmlspecialchars($_SESSION["id"]);
  		//email = htmlspecialchars($_SESSION["email"]);
      $idlogement = 5; //$_GET['idlogement'];
  		$item = 'Chalet'; //$_GET["titre"];

  		$start_epoch = $start_day + $start_time;
  		$end_epoch = $end_day + $end_time;

  		// prevent double booking
  		$sql = $bdd->prepare("SELECT * FROM reservation WHERE idlogement = 5 AND (start_day>=$start_day OR end_day>=$start_day) AND canceled=0;");
  		$sql->execute();
  		if ($sql->rowCount() > 0) {
        //check toutes les lignes
  			while($row = $sql->fetch()) {
  				for ($i = $start_epoch; $i <= $end_epoch; $i=$i+600) {
  					if ($i>($row["start_day"]+$row["start_time"]) && $i<($row["end_day"]+$row["end_time"])) {
              $sql->closeCursor();
              die;
              echo '<h3><font color="red"Malheureusement le bien,  ' . $item . ' est pris pour cette periode".</font></h3>';
            }
  				} die;
  			}
  		}
      $insertres = $bdd->prepare("INSERT INTO reservation(start_day,start_time,end_day,end_time,idlogement,item)
        VALUES (?,?,?,?,?,?)") or die(print_r($bdd->errorInfo()));
      $insertres->bindValue(1, $start_day, PDO::PARAM_INT);
      $insertres->bindValue(2, $start_time, PDO::PARAM_INT);
      $insertres->bindValue(3, $end_day, PDO::PARAM_INT);
      $insertres->bindValue(4, $end_time, PDO::PARAM_INT);
      $insertres->bindValue(5, $idlogement, PDO::PARAM_INT);
      $insertres->bindValue(6, $item, PDO::PARAM_STR);
      $insertres->execute();
      echo "Reservation réussie";
  	}
  }
  ?>
<h1>Dispo</h1>
<table border="1" cellpadding="5" width="900">
	<tr>
		<td valign="top">
		<form action="" method="post">
			<table style="width: 70%">
					<td>Reservation:</td>
					<td>
			         <input id="from" name="start_day" required="" type="text" /></td>
					<td>-</td>
					<td><input id="to" name="end_day" required="" type="text" /></td>
				</tr>
        <tr>
					<td>&nbsp;</td>
					<td> <select name="start_hour">
			<option selected="selected">00</option>
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
			<option selected="selected">23</option>
			</select>:<select name="end_minute">
			<option>00</option>
			<option selected="selected">30</option>
    </select></td></tr>
  </table><table><tr>
    <td><input name="book" type="submit" value="Book"/></td>
    <td><h4>Veuillez verifier le calendrier avant de selectionner des dates</h4></td>
  </tr>
		</form>
		<!--<td valign="top">
		<h3>Cancel booking</h3>
		<form action="cancel.php" method="post">
			<p></p>
			ID: <input name="id" required="" type="text" /><br />
			<p>
			<img id="captchaimg2" src="captcha_code_file2.php?rand=<?php echo rand(); ?>" /><br>
			<input id="captcha2" name="captcha2" required="" type="text" /></p>
			<p><input name="cancel" type="submit" value="Cancel" /></p>
		</form>
  </td>-->
	</tr>
</table>
<input type="button" id="hideshow" value="Voir Calendrier">
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
  			$current_epoch = mktime(0,0,0,$month,$list_day,$year);

  			$sql = $bdd->prepare("SELECT * FROM reservation WHERE idlogement = 5 AND $current_epoch BETWEEN start_day AND end_day;");
        $sql->execute();

      		if ($sql->rowCount() > 0) {
      			// output data of each row
      			while($row = $sql->fetch()) {
  					if($row["canceled"] == 1) $calendar .= "<font color=\"red\"><s>";
      				$calendar .= "<b>Non disponible<br>";
      				if($current_epoch == $row["start_day"] AND $current_epoch != $row["end_day"]) {
      					$calendar .= "DEBUT: " . sprintf("%02d:%02d", $row["start_time"]/60/60, ($row["start_time"]%(60*60)/60)) . "<br><hr><br>";
      				}
      				if($current_epoch == $row["start_day"] AND $current_epoch == $row["end_day"]) {
      					$calendar .= "DEBUT: " . sprintf("%02d:%02d", $row["start_time"]/60/60, ($row["start_time"]%(60*60)/60)) . "<br>";
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

  require("calendrier/config.php");

  $d = new DateTime(date("Y-m-d"));
  echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
  echo draw_calendar($d->format('m'),$d->format('Y'));

  $d->modify( 'first day of next month' );
  echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
  echo draw_calendar($d->format('m'),$d->format('Y'));

  $d->modify( 'first day of next month' );
  echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
  echo draw_calendar($d->format('m'),$d->format('Y'));

  ?>

</div>
</body>
</html>
