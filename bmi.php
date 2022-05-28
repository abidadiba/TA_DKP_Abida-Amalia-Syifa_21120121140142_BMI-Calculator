<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>
    <link rel="stylesheet" href="bmistyle.css">
</head>
<body>
    <section class="wrapper">
<?php 
    $errh = $errw = $errg = "";
    $height = $weight = "";
    $bmipass = "";
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST['height'])) {
            $errh = "<span style='color:#ed4337; font-size:17px; display:block'>Height is requried</span>";
        } else {
            $height = validate($_POST['height']);
        }
    
        if (empty($_POST['weight'])) {
            $errw = "<span style='color:#ed4337; font-size:17px; display:block'>Weight is requried</span>";
        } else {
            $weight = validate($_POST['weight']);
        }

        if (empty($_POST['height'] && $_POST['weight'])) {
            echo "";
        } else {
            $height = $height/100;
            $bmi = $weight / ($height * $height);
            $bmipass = $bmi;
        }
    }
    
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<h2>Check Your BMI</h2>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="sec1">
        <span>Enter Your Height </span>
        <input type="text" name="height" autocomplete="off" placeholder="Cm" ><?php echo $errh; ?>
    </div>
    
    <div class="sec2">
        <span>Enter Your weight </span>
        <input type="text" name="weight" autocomplete="off" placeholder="Kilogram"><?php echo $errw; ?>
    </div>
    
    <div class="submit">
        <input type="submit" name="submit" value="Check BMI">
        <input type="reset" value="Clear">
    </div>
    
</form>

<?php
    error_reporting(0);
        echo "<span class='pass'>Your BMI score is : ". number_format($bmipass, 2) ."</span>";
    if (isset($_POST['submit'])){
        if ($bmipass <= 18.5) {
            echo "<span style='color:#00203FFF; display:block; margin-top:5px ;margin-right:50px'> Low body weight. You need to gain weight by eating moderately.</span>";?>
            <?php
        } elseif ($bmipass <= 25) {
            echo "<span style='color:#00203FFF; display:block; margin-top:5px;margin-right:50px'> The standard of good health.</span>";?>
            <?php
        } elseif ($bmipass <= 30) {
            echo "<span style='color:#00203FFF; display:block; margin-top:5px;margin-right:50px'> Excess body weight. Exercise needs to reduce excess weight.</span>";?>
            <?php
        } elseif ($bmipass > 35) {
            echo "<span style='color:#00203FFF; display:block; margin-top:5px;margin-right:50px'> The first stage of obesity. It is necessary to choose food and exercise.</span>";?>
            <?php
        }
    } else {
        echo "";
    }
    $list = array('be healthy!', 'eat well.', 'live well.');
    foreach ($list as $value){
        echo "$value";
		echo "<br />";
    }
    }
?>
    </section>
</body>
</html>
