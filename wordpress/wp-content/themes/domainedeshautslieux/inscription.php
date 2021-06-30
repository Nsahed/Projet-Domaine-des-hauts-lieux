<?php
/*
Template Name: register
*/
?>

<?php

get_header();



global $wpdb;

if ($_POST) {

    $username = $wpdb->prepare(trim($_POST['txtUsername']));
    $email = $wpdb->prepare(trim($_POST['txtEmail']));
    $password = $wpdb->prepare(trim($_POST['txtPassword']));
    $ConfPassword = $wpdb->prepare(trim($_POST['txtConfirmPassword']));

    $error = array();

    if (strpos($username, ' ') !== FALSE) {
        $username = trim($username);
    }

    if (empty($username)) {
        $error = "Le nom doit être complété";
    }

    if (username_exists($username)) {
        $error = "Le nom existe déjà";
    }

    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "E-mail non valide";
    }

    if (email_exists($email)) {
        $error = "E-mail déjà existant";
    }

    if (strcmp($password, $ConfPassword) !== 0) {
        $error['password'] = "Password didn't match";
    };

    if (count($error) == 0) {

        wp_create_user($username, $password, $email);
        //echo "Bonjour $username </br> Votre compte a bien été créé";
        
       // exit();
    }/*else{
        
        print_r($error);
        
    }*/
}

?>
<div class="boxregister">
<div class="container">
<div class="row">
    
<div class="col-md-12">
<form action="" method="post" id="formregister" class="col-md-12">

    <div class="row">
        <div class="col-md-4">
            <h2 class="text-left">Inscription</h2>
        </div>

    <div class="col-md-10 blockalert">
    <div class="col-md-10 alert-success"  id="blockregister"><p class="blockcontent">
    <?php 
    
    if (count($error) == 0) {
        if ($_POST) {
            echo "Bonjour <strong>$username</strong> </br> Votre compte a bien été créé";
        }}
        
        ?>
        </p>
        </div>
       

        <div class="col-md-10 alert-danger"  id="blockregister"><p class="blockcontent">
        <?php
        if (count($error) > 0) {
        if ($_POST){
        
            print_r($error);
           
            
        }}
    
        ?>
        </p>
        </div>
        </div>


        <div class="col-md-10">
            <span class="glyphicon-pencil"></span>
        </div>
    </div>
    <hr>

    <div class="row">
        <label class="label col-md-4 control-label">Nom</label>
        <div class="col-md-10">
        <input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="Nom">
        </div>
    </div>

    <div class="row">
        <label class="label col-md-4 control-label">E-mail</label>
        <div class="col-md-10">
        <input type="Email" class="form-control" name="txtEmail" id="txtEmail" placeholder="Email">
        </div>
    </div>

    <div class="row">
        <label class="label col-md-4 control-label">Mot de passe</label>
        <div class="col-md-10">
        <input type="password" class="form-control" name="txtPassword" id="txtPassword" placeholder="Mot de passe">
        
        </div>
    </div>

    <div class="row">
        <label class="label col-md-4 control-label">Confirmer mot de passe</label>
        <div class="col-md-10">
        <input type="password" class="form-control" name="txtConfirmPassword" id="txtConfirmPassword" placeholder="Confirmer mot de passe">
        </div>
    </div>
    
    
    
    <button class="btn btn-info" id="subregister"  type="submit">Soumettre</button>        
</form>


</div>
</div>
</div>
</div>


<?php   

  
get_footer();
