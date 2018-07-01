<?php 
echo 'POST: <pre>';
print_r($_POST);
echo '</pre>';

if(isset($_POST)){
    /*if(isset($_SESSION['id']) != ""){
        // Identification par ID !!!!!!!!
        if($_SESSION['mail'] == $_SESSION['old_mail'] && $_SESSION['mdp'] == $_SESSION['old_mdp']){
            $data = [ "Email"=>$_SESSION['mail'],"Password"=>$_SESSION['mdp'] ];
        } else {
            $data = [ "Email"=>$_SESSION['old_mail'],"Password"=>$_SESSION['old_mdp'] ];
            
            $ch = curl_init('http://api.infolor.fr/api/CRM/GetCandidateByLogin');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            $resultlogin = curl_exec($ch);
            $dataUser = json_decode($resultlogin);
            
            if($dataUser != Null){
                $_SESSION['mail'] = $dataUser->Email;
                $_SESSION['nom'] = $dataUser->LastName;
                $_SESSION['prenom'] = $dataUser->FirstName;
                $_SESSION['addresse'] = $dataUser->Address;
                $_SESSION['salaire'] = $dataUser->WantedSalary;
                $_SESSION['expe'] = $dataUser->ExperienceYears;
                $_SESSION['cp'] = $dataUser->PostalCode;
                $_SESSION['ville'] = $dataUser->City;
                $_SESSION['competence'] = $dataUser->Competencies;
                $_SESSION['civil'] = $dataUser->Civility;
                $_SESSION['dispo'] = $dataUser->Disponibility;
                $_SESSION['annonce'] = $dataUser->Announces;
                $_SESSION['mdp'] = $dataUser->Password;
                $_SESSION['cv'] = $dataUser->CVFileName;
                $_SESSION['avatar'] = $dataUser->AvatarFileName;
                $_SESSION['avatarcode'] = $dataUser->AvatarEncodedBase64FileContent;
                $_SESSION['mobile'] =  $dataUser->Mobile;
            }
        }
    }*/
}
?>