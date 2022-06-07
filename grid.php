<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<div class="gridwrapper">
<div class="box a1" onclick="toggle('a1');">a1</div>
<div class="box a2" onclick="toggle('a2');">a2</div>
<div class="box a3" onclick="toggle('a3');">a3</div>
<div class="box a4" onclick="toggle('a4');">a4</div>
<div class="box a5" onclick="toggle('a5');">a5</div>

<div class="box content" id="a1">
 <iframe src="../vvm/listview.php"></iframe>
</div>
<div class="box content" id="a2">2nada2</div>
<div class="box content" id="a3">3nada2</div>
<div class="box content" id="a4">4nada2</div>
<div class="box content" id="a5">5nada2</div>

<div class="box b1" onclick="toggle('b1');">b1</div>
<div class="box b2" onclick="toggle('b2');">b2</div>
<div class="box b3" onclick="toggle('b3');">b3</div>
<div class="box b4" onclick="toggle('b4');">b4</div>
<div class="box b5" onclick="toggle('b5');">b5</div>

<div class="box content" id="b1">1nada</div>
<div class="box content" id="b2">2nada2</div>
<div class="box content" id="b3">3nada2</div>
<div class="box content" id="b4">4nada2</div>
<div class="box content" id="b5">5nada2</div>

</div>
    
<script type="text/javascript">
    function toggle(id){
        var boxen = document.getElementsByClassName("content"); //verzamel alle classen content
        for (var i = 0; i < boxen.length; i++) { // iteratie 
            if(boxen[i].id===id){ document.getElementById(boxen[i].id).style.display="block";} // als opgeklikt : zichtbaar
            else {document.getElementById(boxen[i].id).style.display="none"; // anders niet zichtbaar
}   
  }  
}
</script>
</body>
</html>