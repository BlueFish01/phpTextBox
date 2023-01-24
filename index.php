<?php 
    //define variables and set to empty values
    $title = $content = "";
    $titleErr = $contentErr = "";

    //Html checking function
    function HtmlValidator($string){
        if($string != strip_tags($string)){
            $err = "Error : title can't contain a HTML elements";
            return $err; 
        }
        return null;
    }

    //Srting length checking function
    function StringLengthValidator($string, $min, $max){
        $len = strlen($string);
        if($len < $min){
            $err = "Error : text is too short, minimum is ".$min;
            return $err;

        }
        elseif($len > $max){
            $err = "Error : text is too long, maximum is ".$max;
            return $err;
        }
        return null;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST["title"];
        $content = $_POST["content"];
        
        $titleErr = StringLengthValidator($title,4,140).HtmlValidator($title);
        $contentErr = StringLengthValidator($content,6,2000);

        if($titleErr != null || $contentErr != null){
            $title = "";
            $content = "";
        }     
    }  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text box</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <div class="main-body">
            <input class="title" type="text" name="title" placeholder="หัวข้อกระทู้">
            <span><?php echo $titleErr; ?></span>
            <textarea class="content" name="content"></textarea>
            <span><?php echo $contentErr; ?></span>
            <br>
            <input type="submit" value="submit">   
        </div>
        
        <div class="sub-body">
            <h1><?php echo $title; ?></h1>
            <p><?php echo $content; ?></p>
        </div>
        
    </form>
    
    
</body>
</html>


