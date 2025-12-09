<?php
	$path    = './DPDRefFiles/sfiles';
	$files = array_values(array_diff(scandir($path), array('..', '.')));


	foreach($files as $file)
	{
    		echo "<br>reading ", $file;

		$xmlstring=simplexml_load_file($path . "/" . $file) or die("Error: Cannot create object");

		foreach($xmlstring as $xml_line)
		{
			$insertnewItemQuery = new query('dpdsenddata');
                	$insertnewItemQuery ->Data['satzart'] = $xml_line->satzart;
                	$insertnewItemQuery ->Data['dpd_id'] = $xml_line->id;
               		$insertnewItemQuery ->Data['system'] = $xml_line->system;
               		$insertnewItemQuery ->Data['service'] = $xml_line->service;
               		$insertnewItemQuery ->Data['tracknr'] = $xml_line->tracknr;
               		$insertnewItemQuery ->Data['referenz'] = $xml_line->referenz;

                	$insertnewItemQuery ->Data['scanzeit'] = $xml_line->scanzeit;
                	$insertnewItemQuery ->Data['scandepot'] = $xml_line->scandepot;
               		$insertnewItemQuery ->Data['scanart'] = $xml_line->scanart;
               		$insertnewItemQuery ->Data['zieldepot'] = $xml_line->zieldepot;
               		$insertnewItemQuery ->Data['eland'] = $xml_line->eland;
               		$insertnewItemQuery ->Data['eplz'] = $xml_line->eplz;
               		$insertnewItemQuery ->Data['uebernehmer'] = $xml_line->uebernehmer;
                	$insertnewItemQuery ->insert();
  		}
		unlink($path . "/" . $file);
    		echo "<br>success. Deleting file ", $file;

	}

        $query = new query('dpdsenddata');
        $query->Where = " where 1 = 1 order by tracknr desc, scanzeit desc";
        $trackingdataset_all = $query->ListOfAllRecords('object');

?>		



<?php
	$path    = './DPDRefFiles/daylists';
	$files = array_values(array_diff(scandir($path), array('..', '.')));


	foreach($files as $file)
	{
    		echo "<br>reading ", $file;

		$daylistlines=file($path . "/" . $file) or die("Error: Cannot create object");

		foreach($daylistlines as $daylistline)
		{
			$explodedarray = explode(";",  $daylistline, 20);
			$insertnewItemQuery = new query('dpddaylistdata');
                	$insertnewItemQuery ->Data['datetime'] = $explodedarray[0];
                	$insertnewItemQuery ->Data['refnr'] = $explodedarray[1];
               		$insertnewItemQuery ->Data['nameadresse'] = $explodedarray[2];
               		$insertnewItemQuery ->Data['state'] = $explodedarray[3];

                	$insertnewItemQuery ->insert();
  		}
		unlink($path . "/" . $file);
    		echo "<br>success. Deleting file ", $file;

	}

        $query = new query('dpdsenddata');
        $query->Where = " LEFT JOIN dpddaylistdata on dpdsenddata.tracknr=dpddaylistdata.refnr LEFT JOIN dpdscantypes on dpdsenddata.scanart=dpdscantypes.type where 1 = 1 order by tracknr desc, scanzeit desc";
        $trackingdataset_all = $query->ListOfAllRecords('object');

?>	



<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> View Orders</span>
                </div>
                <div class="actions"></div>
            </div>
            
            <div class="portlet-body">
                <div class="row">
                 <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <th>ID </th> 
                                <th>Datum</th> 
				<th>WT n. Update</th> 
                                <th>tracknr</th> 
                                <th>Empfänger</th> 
                                <th>uebernehmer</th> 
                                <th>eplz</th> 
                                <th>letzte scanart</th> 
                            </tr>
                            
                        <?php

			$lasttrackingnr = "";
			$shipmentsuccess = 0;

			

			foreach($trackingdataset_all as $trackingdata_line_all)
			{
				$tab = "";


				$dayssincelastchange = "";

				$d=strtotime($trackingdata_line_all->scanzeit);

				$age = number_of_working_days(date("d.m.Y", $d),date("d.m.Y"));


			
				if($lasttrackingnr == $trackingdata_line_all->tracknr && $shipmentsuccess==1)
				{
					continue;
				}


				$shipmentsuccess = 0;

				if($trackingdata_line_all->scanart=="13" or $trackingdata_line_all->scanart=="22" or $trackingdata_line_all->scanart=="23")
				{
					$shipmentsuccess = 1; //success
				}
				else if($trackingdata_line_all->scanart=="5" or $trackingdata_line_all->scanart=="10" or $trackingdata_line_all->scanart=="3" or $trackingdata_line_all->scanart=="2")
				{
					$shipmentsuccess = 2; //on the way...
				}

				if($lasttrackingnr == $trackingdata_line_all->tracknr) //here we know that we have a tracking element of an unsuccessful shipment...
				{
					$dayssincelastchange = number_of_working_days(date("d.m.Y", $d),$lastdate);
					$tab = "|___";
					$shipmentsuccess = 3; //detail element of unsuccessful shipment
				}

				


				if($shipmentsuccess == 1) // && $age>10) jump over successful items completety now
                                {
					$lasttrackingnr = $trackingdata_line_all->tracknr;
		                	continue;
                                }



				if($shipmentsuccess == 0)
                                {
		                	echo '<tr bgcolor="#FF5050">';
                                }
				elseif($shipmentsuccess == 2 && $age<4)
                                {
		                	echo '<tr bgcolor="#FFFFDD">';
                                }
				elseif($shipmentsuccess == 2 && $age>3)
                                {
		                	echo '<tr bgcolor="#FF5050">';
                                }
				elseif($shipmentsuccess == 3)
                                {
		                	echo '<tr bgcolor="#EEEEEE">';
                                }
                                else
                                {
                                	echo '<tr bgcolor="#EEFFEE">';
                                }
             

				if($dayssincelastchange > 2)
                                {
		                	echo '<tr bgcolor="#FF5050">';
                                }




				if ($dayssincelastchange == "")
				{
					$dayssincelastchange = $age;
				}

                                echo '<td>'.$trackingdata_line_all->id.'</td>';
                                echo '<td>'.date("d.m.Y H:i", $d).'</td>';
				echo '<td>'.$dayssincelastchange.'</td>';
                                echo '<td>'. '<a href=https://tracking.dpd.de/status/de_AT/parcel/'.$trackingdata_line_all->tracknr . ' target="_blank">' . $tab . $trackingdata_line_all->tracknr. '</a></td>';
	                        echo '<td>'.$trackingdata_line_all->nameadresse. '</td>';           
				echo '<td>'.$trackingdata_line_all->uebernehmer. '</td>';            
                                echo '<td>'.$trackingdata_line_all->eplz.'</td>';
                                echo '<td>'.$trackingdata_line_all->scanart." - ".$trackingdata_line_all->description.'</td>';
                                echo '</tr>';

				$lasttrackingnr = $trackingdata_line_all->tracknr;
				$lastdate=date("d.m.Y", $d);

                        }
                            
			foreach($trackingdataset_all as $trackingdata_line_all)
			{
				$tab = "";


				$dayssincelastchange = "";

				$d=strtotime($trackingdata_line_all->scanzeit);

				$age = number_of_working_days(date("d.m.Y", $d),date("d.m.Y"));


			
				if($lasttrackingnr == $trackingdata_line_all->tracknr && $shipmentsuccess==1)
				{
					continue;
				}


				$shipmentsuccess = 0;

				if($trackingdata_line_all->scanart=="13" or $trackingdata_line_all->scanart=="22" or $trackingdata_line_all->scanart=="23")
				{
					$shipmentsuccess = 1; //success
				}
				else if($trackingdata_line_all->scanart=="5" or $trackingdata_line_all->scanart=="10" or $trackingdata_line_all->scanart=="3" or $trackingdata_line_all->scanart=="2")
				{
					$shipmentsuccess = 2; //on the way...
				}

				if($lasttrackingnr == $trackingdata_line_all->tracknr) //here we know that we have a tracking element of an unsuccessful shipment...
				{
					$dayssincelastchange = number_of_working_days(date("d.m.Y", $d),$lastdate);
					$tab = "|___";
					$shipmentsuccess = 3; //detail element of unsuccessful shipment
				}

				


				if($shipmentsuccess != 1) 
                                {
					$lasttrackingnr = $trackingdata_line_all->tracknr;
		                	continue;
                                }



				if($shipmentsuccess == 0)
                                {
		                	echo '<tr bgcolor="#FF5050">';
                                }
				elseif($shipmentsuccess == 2 && $age<4)
                                {
		                	echo '<tr bgcolor="#FFFFDD">';
                                }
				elseif($shipmentsuccess == 2 && $age>3)
                                {
		                	echo '<tr bgcolor="#FF5050">';
                                }
				elseif($shipmentsuccess == 3)
                                {
		                	echo '<tr bgcolor="#EEEEEE">';
                                }
                                else
                                {
                                	echo '<tr bgcolor="#EEFFEE">';
                                }
             

				if($dayssincelastchange > 2)
                                {
		                	echo '<tr bgcolor="#FF5050">';
                                }




				if ($dayssincelastchange == "")
				{
					$dayssincelastchange = $age;
				}

                                echo '<td>'.$trackingdata_line_all->id.'</td>';
                                echo '<td>'.date("d.m.Y H:i", $d).'</td>';
				echo '<td>'.$dayssincelastchange.'</td>';
                                echo '<td>'. '<a href=https://tracking.dpd.de/status/de_AT/parcel/'.$trackingdata_line_all->tracknr . '>' . $tab . $trackingdata_line_all->tracknr. '</a></td>';
	                        echo '<td>'.$trackingdata_line_all->nameadresse. '</td>';  
				echo '<td>'.$trackingdata_line_all->uebernehmer. '</td>';            
                                echo '<td>'.$trackingdata_line_all->eplz.'</td>';
                                echo '<td>'.$trackingdata_line_all->scanart." - ".$trackingdata_line_all->description.'</td>';
                                echo '</tr>';

				$lasttrackingnr = $trackingdata_line_all->tracknr;
				$lastdate=date("d.m.Y", $d);

                        }


                            ?>


                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

function number_of_working_days($from, $to) {
    $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
    $holidayDays = ['*-12-25', '*-01-01', '2013-12-23']; # variable and fixed holidays

    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);

    $days = 0;
    foreach ($periods as $period) {
        if (!in_array($period->format('N'), $workingDays)) continue;
        if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
        if (in_array($period->format('*-m-d'), $holidayDays)) continue;
        $days++;
    }
    return $days;
}

?>












