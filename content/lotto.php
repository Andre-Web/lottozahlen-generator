<main>
<h1>LOTTO Zahlen / Tippschein Generator</h1>
<h2>Zufallszahlen für 6 auf 49</h2>
<p>
Mit diesem Tool können Sie sich zufällig einen Tippschein generieren lassen, welcher <b>ALLE Zahlen von 1-49</b> enthält. 
Jede Zahl wird nur ein mal verwendet. Im letzten Tippfeld steht nur eine Lottozahl, da diese quasi noch übrig ist... 
Dieses Feld wird um die 5 häufigsten in der Software am häufigsten generierten Lottozahlen ergänzt.
</p>
<p>
<b>Viel Glück!</b>
</p>
<div class="button refresh">refresh</div>
<script type="text/javascript">
$('.refresh').click(function(){window.location=window.location.href.split("?")[0];});
</script>
<div class="tippschein">
	
<?php 
	
	if (!file_exists($jsonpath.'/log.json')) { $fileCreate = fopen($jsonpath.'/log.json', 'w'); chmod($jsonpath.'/log.json', 0777); fclose($fileCreate); }
	if(!isset($oldData)) { $puffer = file_get_contents($jsonpath.'/log.json'); $puffer	= utf8_encode($puffer); $oldData = array(); $oldData = json_decode($puffer, true); } 
	
	$numberOfActions = 128;
	
	for($i=1; $i<=$numberOfActions; $i++) { 	
		
			if($numberOfActions == $i) {  }	
	
			$selected 				= array();
			$allNumbersCounter		= array();

			while(count($selected)<49) {  $select = rand(1,49);
				if(!isset($allNumbersCounter[$select])) 	$allNumbersCounter[$select] = 1; 
				else 										$allNumbersCounter[$select] = intval($allNumbersCounter[$select])+1;
				if(!in_array($select,$selected)) { $selected[] = $select; }						
			}
		
		
			if(isset($oldData) && is_array($oldData) && count($oldData)>48) { $numbers = $oldData; 
				foreach($numbers as $number => $x) { if(intval($number)<50) { $numbers[$number] = intval($x) + intval($allNumbersCounter[$number]); } }
			} else $numbers = $allNumbersCounter; // Case INIT
		
			arsort($numbers); // die häufigsten zuerst;
			$oldData = $numbers; // Update	
		
		
			if($numberOfActions == $i) {
				$fields = array(); $fields[0] = array();
				foreach($selected as $skey => $selnumber) {
					if(count($fields[count($fields)-1])==6) { $fields[count($fields)] = array(); } 
					$fields[count($fields)-1][] = $selnumber;
				}
			}
		
	}
						 
	$contentCreate	 		= fopen($jsonpath.'/log.json', 'w');
	$contentOutput 			= json_encode($oldData);
	fwrite($contentCreate, $contentOutput);
	fclose($contentCreate);
	@chmod($jsonpath.'/log.json', 0777);
	
				
	
	
			foreach ($fields as $tipp => $tempArray)  { 
						if(count($tempArray)<6) {
							while(count($tempArray)<6) {
								foreach($numbers as $addNumber => $z) { if(!in_array($addNumber,$tempArray)) { $tempArray[] = $addNumber; break; } }
							}
						}
						echo '<div class="tippfeld">';
						for ($n=0; $n<(count($tempArray)); $n++)  { echo '<div class="kreuz z'.$tempArray[$n].'">'.$tempArray[$n].'</div>';	}
						echo '</div>';
			}

			$singleNumbers	= array();
			foreach($allNumbersCounter as $sz => $haufigkeit) { if($sz<10) $singleNumbers[$sz] = $haufigkeit; elseif($sz==10) $singleNumbers[0] = $haufigkeit;  }
			$superzahl = 0; $szcounter = 0;
			foreach($singleNumbers as $sz => $haufigkeit) { if($haufigkeit > $szcounter) { $szcounter = $haufigkeit; $superzahl = $sz; } }
	
	$visStatOut = '';
				$numberStatOut = 'Am häufigsten generierte Zahlen: <br><hr><br>';
	
				$mostUsedNumbers = array(); $hc = 0; 
				foreach($numbers as $addNumber => $z) { if($hc<=5) { $mostUsedNumbers[$addNumber] = $z; if($hc==5) $baseCount = $z; $hc++; } else break; }
	
	
				
	
				$hc = 0; 
				foreach($mostUsedNumbers as $addNumber => $z) { 
					
					
					$thisFontSize = 2.5 + ( floatval(($z-$baseCount)/$baseCount)*800);
					
					if($hc<5) { $visStatOut .= '<b style="font-size:'.$thisFontSize.'rem !important;" class="ball">'.$addNumber.'</b> '; 
							    $numberStatOut .= '<b>'.$addNumber.'</b> <small>(+ '.($z-$baseCount).')</small>, '; $hc++; } 
					elseif($hc==5) { $visStatOut .= '<b style="font-size:'.$thisFontSize.'rem !important" class="ball">'.$addNumber.'</b>';
									 $numberStatOut .= '<b>'.$addNumber.'</b>'; $hc++; }  
					else break;  
				
				}
	
	
	
			echo '</div><div class="tippschein"><div class="suza">Superzahl: '.$superzahl.'</div><div class="clear" style="padding-top:24px;">'.$visStatOut.'<br><br></div>';
			echo '<div class="stat suza" style="text-align:center;">';
				echo $numberStatOut;	
			echo '</div>';
	
	?>
</div>
</main>