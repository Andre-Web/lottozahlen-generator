<?php
			// COLLECT FILES //
			// vorhandene Script Dateien //
			$scriptFiles = Array();
			$handle = opendir($script);
			while($fileScript = readdir($handle))
			{ $checkFileType = explode(".", $fileScript);
			  $endingPos = count($checkFileType)-1;
			  if(isset($checkFileType[$endingPos]) && $checkFileType[$endingPos]== 'js') array_push($scriptFiles, $fileScript); }
			usort ($scriptFiles, "strnatcmp"); // Sortierung  
			$scriptCount = count($scriptFiles);
			$scriptHead = '';
			for ($js=0; $js<$scriptCount; $js++) { $scriptHead .= '<script type="text/javascript" src="'.$script.$scriptFiles[$js].'"></script>'; }
			
			// vorhandene CSS Dateien //
			$styleFiles = Array();
			$handle = opendir($css);
			while($fileCSS = readdir($handle))   
			{ $checkFileType = explode(".", $fileCSS);
			  $endingPos = count($checkFileType)-1;
			  if(isset($checkFileType[$endingPos]) && $checkFileType[$endingPos]== 'css')array_push($styleFiles, $fileCSS); }
			usort ($styleFiles, "strnatcmp"); // Sortierung
			$cssCount = count($styleFiles);
			$cssHead = '';
			for ($cssc=0; $cssc<$cssCount; $cssc++) { $cssHead .= '<link rel="stylesheet" type="text/css" href="'.$css.$styleFiles[$cssc].'">'; }					
?>