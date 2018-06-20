<?php

class fonctionCRM{
   
    public static function getAnnoncebycritere($params){
		
		//Appel et paramétrage de l'API	
		$ch = curl_init('http://api.infolor.fr/api/CRM/GetWebAnnouncesByCriteria');	
		curl_setopt($ch, CURLOPT_POST, true);	
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
		curl_setopt($ch, CURLOPT_HEADER, false);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
		$result = curl_exec($ch);	
		$codeError = json_decode($result);

		return $codeError;
    }
    public static function getAnnoncebycritereOffres($params){
		$param = json_encode($params);
		//Appel et paramétrage de l'API	
		$ch = curl_init('http://api.infolor.fr/api/CRM/GetWebAnnouncesByCriteria');	
		curl_setopt($ch, CURLOPT_POST, true);	
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
		curl_setopt($ch, CURLOPT_HEADER, false);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
		$result = curl_exec($ch);	
		$annonces = json_decode($result);
		
		// var_dump($annonces);
		
		$html = '<table id="tablesorter">'
			. '<thead>'
				. '<tr class="table_header">'
					. '<th class="text-center">Intitulé du poste</th>'
					. '<th class="text-center">Expérience souhaitée</th>'
					. '<th class="text-center">Date</th>'
					. '<th class="text-center">Ville</th>'
					. '<th></th>'
				. '</tr>'
			. '</thead>'
			. '<tbody>';

        for($i=0; $i<count($annonces); $i++){
            $html .= '<tr>'
                        . '<td>'. $annonces[$i]->Title .'</td>'                   
                        . '<td>'. $annonces[$i]->Experience .'</td>'
                        . '<td>'. $annonces[$i]->Date .'</td>'
                        . '<td>'. $annonces[$i]->Place .'</td>'
                        . '<td><a href="">Détail</a></td>'
                    . '</tr>';
        }
        $html .=  '</tbody>'
                . '</table>'
                . '<div id="pager" class="pager">'
                    . '<form>'
                        . '<img src="http://dev-wordp.qualis-tt.fr/wp-content/uploads/2018/03/before-pagination.png" class="prev"/>
                        <input type="text" class="pagedisplay" disabled/>
                        <p class="pagedisplay"></p>
                        <img src="http://dev-wordp.qualis-tt.fr/wp-content/uploads/2018/03/after-pagination.png" class="next"/>'
                        . '<select class="pagesize">
                                <option selected="selected"  value="15">15</option>'
                        .'</select>'
                    . '</form>'
                .'</div>';
			
		return $html;
    }
	
    public static function getCandidatByCv($params){	
	//Appel et paramétrage de l'API	
	$ch = curl_init('http://api.infolor.fr/api/CRM/GetCandidateByCV');	
	curl_setopt($ch, CURLOPT_POST, true);	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params);	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch, CURLOPT_HEADER, false);	
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
	$result = curl_exec($ch);	
	$codeError = json_decode($result);

	return $codeError;
    }
	
	public static function getCompetences($params){
		//Appel et paramétrage de l'API
		$ch = curl_init('http://api.infolor.fr/api/CRM/Competecies');	
		curl_setopt($ch, CURLOPT_POST, true);	
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
		curl_setopt($ch, CURLOPT_HEADER, false);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
		$result = curl_exec($ch);	
		$competencesJson = json_decode($result);
		
		$competences = array();
		for($i=0; $i<count($competencesJson); $i++){
			$competences[$i] = ucfirst(strtolower($competencesJson[$i]));
		}
		return $competences;
	}
	public static function getExperiences(){
		//Appel et paramétrage de l'API
		$ch = curl_init('http://api.infolor.fr/api/CRM/ExperienceYears');	
		// curl_setopt($ch, CURLOPT_POST, true);	
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $params);	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
		curl_setopt($ch, CURLOPT_HEADER, false);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
		$result = curl_exec($ch);	
		$expeJson = json_decode($result);
		// print_r($expeJson);
		return $expeJson;
	}
	
	public static function getCivilities(){
		//Appel et paramétrage de l'API
		$ch = curl_init('http://api.infolor.fr/api/CRM/Civilities');	
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $params);	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
		curl_setopt($ch, CURLOPT_HEADER, false);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
		$result = curl_exec($ch);	
		$civilityAPI = json_decode($result);
		return $result;
	}
	public static function saveAvatar($params){
		$data_string = json_encode($params);
// var_dump($data_string);		
		 // Appel et paramétrage de l'API
		$ch = curl_init('http://api.infolor.fr/api/CRM/SaveCandidate');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
		$resultlogin = curl_exec($ch);
		$codeErrorSave = json_decode($resultlogin);
		// var_dump($resultlogin);
		// var_dump($codeErrorSave);
		return $codeErrorSave;
	}
}

?>