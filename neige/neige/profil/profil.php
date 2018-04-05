<?php
session_start();
require("bddconnect.php");

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
	$id = intval($_SESSION['id']);
	$reponse = $bdd->prepare('SELECT * FROM user WHERE id = ?');
	$reponse->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
	$reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
	?>
	<html>
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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
		<link href="../logement/calendrier/jquery-ui.css" rel="stylesheet">
		<script src="../logement/calendrier/jquery-ui.js"></script>
		<link href="../logement/calendrier/style_calendrier.css" rel="stylesheet">
		<link href="../style.css" rel="stylesheet" type="text/css">
	</head>
	  <body>
			<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="nav-link active" href="./index.php"><img src="../images/logos.png" alt="neige&soleil" width="110px"></a>
	    </div>
	          <ul class="nav navbar-nav">
	            <li class="nav-item">
	              <a class="nav-link active" href="../logement/liste_type.php">Catalogue</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link active" href="apropos.php">A propos</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link active" href="contact.php">Contact</a>
	            </li>
	            <li class="nav-item" >
	              <div class="alert alert-info" role="alert">
	                  <strong>-30% jusqu'au 03/06/2018</strong> sur les chalets familiales
	              </div>
	            </li>
	          </ul>
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Espace personnel</a></li>
	          </ul>
	        </div>
	      </nav><center>
		  <h1>Espace Personnel</h1></br>
		  <p>Bienvenue <?php echo htmlspecialchars($_SESSION['civilite']); ?>
				<?php echo htmlspecialchars($_SESSION['nom']); ?>
				<?php echo htmlspecialchars($_SESSION['prenom']); ?>
				dans votre espace personnel</p>
			<div class="btn-group-inline" role="group" aria-label="Basic example">
	  		<button type="button" class="btn btn-secondary btn-lg" onclick="location.href='../logement/liste_type.php';">Louer un bien</button>
				<button type="button" class="btn btn-secondary btn-lg" onclick="location.href='profil.php?page=2';">Mes reservations</button>
	  		<button type="button" class="btn btn-secondary btn-lg" onclick="location.href='profil.php?page=1';">Proposer un bien</button>
				<?php
				if(isset($_SESSION['status']) AND $_SESSION['status'] >= 1)
				{ ?>
					<button type='button' class='btn btn-secondary btn-lg' onclick='location.href="profil.php?page=4"'>Mes Biens</button>
				<?php
				}
				if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
				{ ?>
					<button type='button' class='btn btn-secondary btn-lg' onclick='location.href="panel.php"'>Administration</button>
				<?php
				}
				?>
	  		<button type="button" class="btn btn-secondary btn-lg" onclick="location.href='profil.php?page=3';">Deconnection</button>
			</div></br>
	    <?php
		  $page =(isset($_GET['page']))? $_GET['page'] :0 ;
		  switch($page)
		  {
		    case 1:
				if(isset($_SESSION['status']) AND $_SESSION['status'] >= 1)
			  {
					include("requestlogement.php");
				}
				else {
					include("requestuser.php");
				}
		    break;
				case 2:
				?>
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

				        $id= $_SESSION['id'];

				  			$sql = $bdd->prepare("SELECT * FROM reservation WHERE id = ? AND $current_epoch BETWEEN start_day AND end_day;");
				        $sql->bindValue(1, $id, PDO::PARAM_INT);
				        $sql->execute();

				      		if ($sql->rowCount() > 0) {
				      			// output data of each row
				      			while($row = $sql->fetch()) {
				  					if($row["canceled"] == 1) $calendar .= "<font color=\"red\"><s>";
				      				$calendar .= "<b>Reservation<br>";

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
				<?php
		    break;
				case 3:
				$_SESSION = array(); //recupere la session en cours
				session_destroy(); //detruit la session
				header("Location: index.php"); //retourne a l'accueil
		    break;
				case 4:
				if(isset($_SESSION['status']) AND $_SESSION['status'] >= 1)
			  {
					$id = intval($_SESSION['id']);
					$reponse = $bdd->prepare('SELECT * FROM logement WHERE id = ?');
					$reponse->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
					$reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
					?>
						<h2>Mes biens</h2></br>
						<table border="1">
							<tr>
								<td>Titre</td>
								<td>Emplacement</td>
								<td>Etages</td>
								<td>Prix (en €/jour)</td>
								<td>Taille (en m²)</td>
								<td>Type</td>
								<td>Caractéristiques</td>
								<td>Status</td>
							</tr>
							<?php
							while ($data = $reponse->fetch())
							{
								echo "<tr><td>".$data['titre']."</td>";
								echo "<td>".$data['emplacement']."</td>";
								echo "<td>".$data['etage']."</td>";
								echo "<td>".$data['prix']."</td>";
								echo "<td>".$data['taille']."</td>";
								echo "<td>".$data['idtype']."</td>";
								echo "<td>".$data['caracteristique']."</td>";
								echo "<td>".$data['status']."</td></tr>";
							}
							$reponse->closeCursor();
							?>
						</table>
					<?php
				}
		    break;
			  }
	    ?>
		<br/><br/></center>
	  	</body>
		</html>
	<?php
		}
		else
		{
			header("Location: portail.php");
		}
?>
