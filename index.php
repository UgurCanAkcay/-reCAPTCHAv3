<?php
define('SITE_KEY', '6LexK08iAAAAAPL0cBpkSmTNnSd8EyCjy4k11ekx');
define('SECRET_KEY', '6LexK08iAAAAAGxvcxE0BOdVTCVZF6Lfl10D10kw');

if($_POST){
    function getCaptcha($SecretKey){
        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
        $Return = json_decode($Response);
        return $Return;
    }
    $Return = getCaptcha($_POST['g-recaptcha-response']);
    
    if($Return->success == true && $Return->score > 1.0){
        echo "Başarılı!";
    }else{
        echo "Kimsin sen! Çık dışarı robot!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv=X-UA-Compatible content="IE=Edge;chrome=1">
    <title>ReCaptcha V3</title>
    <script src='https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>'></script>
</head>
<body>
    <form action="/" method="POST">
        <input type="text" name="name" /><br />
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" /><br >
        <input type="submit" value="Submit" />
    </form>
    <script>
        //https://developers.google.com/recaptcha/docs/v3
    grecaptcha.ready(function() {
    grecaptcha.execute('<?php echo 'put your site key here'; ?>', {action: 'homepage'})
    .then(function(token) {
        //console.log(token);
        document.getElementById('g-recaptcha-response').value=token;
    });
    });
    </script>
</body>
</html>