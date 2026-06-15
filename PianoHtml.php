<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Web Piano</title>
<style type="text/css">
 body {line-height:clamp(0.35em, 0.55em, 0.65em);}
span {font-size:30px;}

.textlines{
  font-size:30px;
}

 .ParentContainer {
  /* display: inline-block; */

}

.container {
  /* float: left; */
  margin: 10px;
  

}

#piano-wrap * {            
  box-sizing: border-box;
  font-family: Arial;
  user-select: none;
}

#piano-wrap {
  display: flex;
  padding:5px 0px 0px 0px;
}

#piano-wrap > div {
  position: relative;
}

.white-key {
  width: 1.13vw;
  height: 10vh;
  background-color: white;
  border: solid 1px black;
  z-index: 1;
  /* border-bottom: solid rgb(230, 230, 230) 10px; */
  box-shadow: 0 7px 3px 0 rgba(0, 0, 0, 0.3);
  transition: 100ms;
  color: black;
}


.black-key {
  overflow: visible;
  z-index : 2;
  background: linear-gradient(to bottom, rgb(117, 117, 117) 97%, white);
  width: 0.8vw;
  height: 6vh;
  border: solid 1px black;
  margin-left: calc(-0.8vw/2);
  margin-right: calc(-0.8vw/2);

}
.noteCircle{
  position: absolute;
  bottom: 10%;
  left: 50%;
  transform: translate(-50%,-50%);
}


.key-label {
  position: absolute;
  display: block;
  bottom: 10px;
  width: 100vh;
  text-align: center;
}
</style>
</head>
<body>

<div class="container" id="container0">
    <span id="ChordOrScaleName" style="font-size:20px;padding:0px 0px 0px 0px;">B Lydian</span>
    <div id="piano-wrap"> 
    <div class="white-key notes" name="5" style="background: white;"><span class="noteCircle" style="color:blue;">●</span></div>
    <div class="black-key notes" name="6" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:#F00;">●</span></div>
    <div class="white-key notes" name="7" style="background: white;"></div>
    <div class="black-key notes" name="8" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:blue;">●</span></div>
    <div class="white-key notes" name="9" style="background: white;"></div>
    <div class="black-key notes" name="10" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:#F00;">●</span></div>
    <div class="white-key notes" name="11" style="background: white;"><span class="noteCircle" style="color:#000;font-size:  37px ">●</span></div>
    <div class="white-key notes" name="0" style="background: white;"></div>
    <div class="black-key notes" name="1" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:blue;">●</span></div>
    <div class="white-key notes" name="2" style="background: white;"></div>
    <div class="black-key notes" name="3" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:#F00;">●</span></div>
    <div class="white-key notes" name="4" style="background: white;"></div>
    <div class="white-key notes" name="5" style="background: white;"><span class="noteCircle" style="color:blue;">●</span></div>
    <div class="black-key notes" name="6" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:#F00;">●</span></div>
    <div class="white-key notes" name="7" style="background: white;"></div>
    <div class="black-key notes" name="8" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:blue;">●</span></div>
    <div class="white-key notes" name="9" style="background: white;"></div>
    <div class="black-key notes" name="10" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:#F00;">●</span></div>
    <div class="white-key notes" name="11" style="background: white;"><span class="noteCircle" style="color:#000;font-size:  37px ">●</span></div>
    <div class="white-key notes" name="0" style="background: white;"></div>
    <div class="black-key notes" name="1" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:blue;">●</span></div>
    <div class="white-key notes" name="2" style="background: white;"></div>
    <div class="black-key notes" name="3" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:#F00;">●</span></div>
    <div class="white-key notes" name="4" style="background: white;"></div>
    <div class="white-key notes" name="5" style="background: white;"><span class="noteCircle" style="color:blue;">●</span></div>
    <div class="black-key notes" name="6" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:#F00;">●</span></div>
    <div class="white-key notes" name="7" style="background: white;"></div>
    <div class="black-key notes" name="8" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:blue;">●</span></div>
    <div class="white-key notes" name="9" style="background: white;"></div>
    <div class="black-key notes" name="10" style="background: linear-gradient(rgb(117, 117, 117) 97%, white);"><span class="noteCircle" style="color:#F00;">●</span></div>
    <div class="white-key notes" name="11" style="background: white;"><span class="noteCircle" style="color:#000;font-size:  37px ">●</span></div>
    <div class="white-key notes" name="0" style="background: white;"></div>
    </div>

</div>
    
</body>
</html>