<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Web Piano</title>
<style type="text/css">
    #piano-container {
        margin: 0 auto;
        /* width: calc(100% - 40px); */
        height: 400px;
        /* overflow: auto; */
    }

    #piano-wrap * {            
        box-sizing: border-box;
        font-family: Arial;
        user-select: none;
    }

    #piano-wrap {
        margin: 0 auto;
        height: 330px;
        width: calc(46px * 36);
        display: flex;
        /* justify-content: center; */
    }

    #piano-wrap > div {
        position: relative;
    }

    .white-key {
      width: 1.5vw;
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
      background: linear-gradient(to bottom, rgb(24, 24, 24) 97%, white);
      width: 1.3vw;
      height: 6vh;
      border: solid 1px black;
      margin-left: calc(-1.3vw/2);
      margin-right: calc(-1.3vw/2);


      /* background: linear-gradient(to bottom, rgb(24, 24, 24) 97%, white);
      margin-left: -12px;
      margin-right: -12px;
      z-index: 2;
      border-bottom: solid rgb(54, 54, 54) 10px;
      border-left: solid black 3px;
      border-right: solid black 3px;
      box-shadow: 5px 1px 2px 0 rgba(0, 0, 0, 0.4);
      transition: 100ms;
      color: white;
      text-align: center; */
    }



    .key-label {
        display: block;
        bottom: 10px;
        width: 100%;
        text-align: center;
    }
</style>
</head>
<body>
  <div id="piano-container">
    <div id="piano-wrap"> 
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
      <div class="black-key"></div>
      <div class="white-key"></div>
    </div>
  </div>

</body>
</html>