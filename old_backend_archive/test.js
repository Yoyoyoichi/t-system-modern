
async function myFetch(url, dataStr) {
    try {
        let response = await fetch(url, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: dataStr
        });
        return await response.text();
    } catch (e) {
        console.error("Fetch error:", e);
        return "";
    }
}


var sendbackDBName = location.search.substring(1);
// console.log('sendbackDBName is '+sendbackDBName);
if (sendbackDBName) {
    document.getElementById("DB_name").value = sendbackDBName;
}
document.getElementById("div2").style.display = "none";
document.getElementById("div2").style.display = "none";
document.getElementById("div1").style.display = "none";
var num = 0;
var flag1 = false;
var oneByOneflag = false;
var twoByTwoflag = false;
var threeByThreeflag = false;
var answertextareaflag = false;
var autoflag = false;
var randoms = [];
let rand = "";
var questionnumbers = "";
var min = 0, max = "";
var phpfile1 = "";
var phpfile2 = "";
var databasename = document.mainform.DB_name.value;
document.getElementById("reminder").href += "?"+databasename;
document.getElementById("resultgraph").href += "?"+databasename;
document.getElementById("UpdateSql").href += "?"+databasename;
document.getElementById("review2").href += "?"+databasename;
document.getElementById("TerashimaSheets").href += "?"+databasename;

// console.log('databasename is '+databasename);
var getQstartTime = 0;
var getQendTime = 0;
var getpastTime =0;
var now = 0;
var answertext="";
var questiontext="";
var imagefolder ="";
var speech;
var speech2;
var correctQuestions = new Array();
var incorrectQuestions = new Array();
var overlapCorrectQuestions = new Array();
var overlapIncorrectQuestions = new Array();
var minimumCorrect ;
var MaxQuestionNumber;
var AnswerShown = false;
var AnswerTypedFlag = false;
var AnswerShown2 = false;//自動回答表示の解除用
// var AnswerWaitingFlag = false;//自動解答表示を待っているかどうか
var sleepId = "";//sleepのタイマーのID
var mp3PlayFlag = false;
var imageHeight1;
var imageWidth1;
var imageHeight2;
var imageWidth2;
var yesterdayIncorrect =false;
var QnAareaFlexFlug = false;
var slashKakko = "\\\(";
var musicStartFlug = false;

const text1 = document.getElementById('textareas');



for (let i = 1; i < 500; i++) {//Mp3開始地点セレクト要素追加
    // selectタグを取得する
  var select = document.getElementById("mp3StartPoint");
  // optionタグを作成する
  var option = document.createElement("option");
  // optionタグのテキストを4に設定する
  option.text = i * 0.01 ;
  // optionタグのvalueを4に設定する
  option.value = i * 0.01;
  // selectタグの子要素にoptionタグを追加する
  select.appendChild(option);
}



async function sendRequest(){
    let parent = document.getElementById("answerMath");
    while(parent.lastChild){
      parent.removeChild(parent.lastChild);
    }
    if ((document.getElementById("novelSelect").value) && !(document.getElementById("novelSelect").value == "なし")){
      novelRowNum = Number(novelRowNum) +1;
      getNovelSentence();
    }

    if (!document.getElementById("mypic2")=== null) {
      if (document.getElementById("mypic2").src){
        document.getElementById("mypic2").src= "";
      }      
    }
    
    clearTimeout(sleepId);//自動解答表示のタイマーをクリア
    AnswerShown2 = false;//答えはまだ表示されていない
    if (num < MaxQuestionNumber ) {
      num++;
    } else {
      num=0;
    }
    now = new Date();
    getQstartTime = now.getTime();
    answertextareaflag = false;
    var QAChangeChecked = document.getElementById("qachange").checked;////

    if (flag1 == false){
      if (document.getElementById("MaxQuestionNumber").value == "all") {
        MaxQuestionNumber = questionnumbers.length;
      } else {
        MaxQuestionNumber = Number(document.getElementById("MaxQuestionNumber").value);
      }
      MaxQuestionNumber = Number(document.getElementById("MaxQuestionNumber").value);
    }


    if (QAChangeChecked) {
        var phpfile1 = "getonequestion2.php";
        var phpfile2 = "getanswer2.php";
    } else {
        var phpfile1 = "getonequestion1.php";
        var phpfile2 = "getanswer1.php";
    }

    if (num+1 > MaxQuestionNumber ) {
      removeCorrects();
      num=0;
      randoms = [];
      // max = questionnumbers.length-1;
        if (max==0) {
          max=1;
        }
      /** 重複チェックしながら乱数作成 */
      for(i = min; i < questionnumbers.length; i++){
        while(true){
          // alert(i);
          var tmp = intRandom(min, questionnumbers.length-1);
          if(!randoms.includes(tmp)){
            randoms.push(tmp);
            break;
          }
        }
      }
      var randQNum = new Array();
      for (let i = 0; i < questionnumbers.length; i++) {
        randQNum[i] = questionnumbers[randoms[i]];
      }
      var correctQuestionsSave = correctQuestions;
      // console.log('correctQuestions  is '+correctQuestions );
      correctQuestions = correctQuestionsSave;
      // console.log('correctQuestions  is '+correctQuestions );
      if (document.getElementById("randomOrNot").checked) {
        questionnumbers.length = 0;
        questionnumbers = randQNum;
      }
    }
    var category1Value = new Array();
    var elemCategory1 = document.getElementById('ctg1');
    var optsCategory1 = elemCategory1.options; // select要素のoptionプロパティ
    for (var i = 0; i < optsCategory1.length; i++) {
      if (optsCategory1[i].selected) {
        category1Value[i] = optsCategory1[i].value;
      }
    }
    category1Value = category1Value.filter(Boolean);
    category1Value = category1Value.join('@');

    var category2Value = new Array();
    var elemCategory2 = document.getElementById('ctg2');
    var optsCategory2 = elemCategory2.options; // select要素のoptionプロパティ
    for (var i = 0; i < optsCategory2.length; i++) {
      if (optsCategory2[i].selected) {
        category2Value[i] = optsCategory2[i].value;
        // console.log('category1Value[i] is ' + category2Value[i]);
      }
    }
    category2Value = category2Value.filter(Boolean);
    category2Value = category2Value.join('@');

    var category3Value = new Array();
    var elemCategory3 = document.getElementById('ctg3');
    var optsCategory3 = elemCategory3.options; // select要素のoptionプロパティ
    for (var i = 0; i < optsCategory3.length; i++) {
      if (optsCategory3[i].selected) {
        category3Value[i] = optsCategory3[i].value;
      }
    }
    category3Value = category3Value.filter(Boolean);
    category3Value = category3Value.join('@');

    var category4Value = new Array();
    var elemCategory4 = document.getElementById('ctg4');
    var optsCategory4 = elemCategory4.options; // select要素のoptionプロパティ
    for (var i = 0; i < optsCategory4.length; i++) {
      if (optsCategory4[i].selected) {
        category4Value[i] = optsCategory4[i].value;
      }
    }
    category4Value = category4Value.filter(Boolean);
    category4Value = category4Value.join('@');

    var category5Value = new Array();
    var elemCategory5 = document.getElementById('ctg5');
    var optsCategory5 = elemCategory5.options; // select要素のoptionプロパティ
    for (var i = 0; i < optsCategory5.length; i++) {
      if (optsCategory5[i].selected) {
        category5Value[i] = optsCategory5[i].value;
      }
    }
    category5Value = category5Value.filter(Boolean);
    category5Value = category5Value.join('@');




    var moji=rand + "." + category1Value + "." + category2Value + "." + category3Value  + "." + 
        document.mainform.category4.value + "." + document.mainform.category5.value + "." + 
        document.mainform.category6.value + "." + document.mainform.operator1.value + "." + 
        document.mainform.operator2.value + "." + document.mainform.operator3.value + "." + 
        document.mainform.criteria1.value + "." + document.mainform.criteria2.value + "." + 
        document.mainform.criteria3.value + "." + document.mainform.DB_name.value + "." + 
        document.mainform.poorat2.value + "." + document.mainform.wordSearch.value + "." + 
        document.mainform.qlevel.value + "." + category4Value + "." + category5Value + "." + 
        document.mainform.novelSentenceNumber.value + "." + yesterdayIncorrect;
    moji = encodeURIComponent(moji);
    yesterdayIncorrect = false;

    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {

      if (flag1 == false){
        var raw_res = await myFetch( "../getqestions.php", "data=" + moji);
          var res = raw_res.split('^^^');
        console.log('0817 res is '+res);
        questionnumbers = res[1].split(',');
        document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
      }
      if (oneByOneflag == true){
        var raw_res = await myFetch( "../getqestionsOneByOne.php", "data=" + moji);
          var res = raw_res.split('^^^');
        console.log('0817 res is '+res);
        questionnumbers = res[1].split(',');
        document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
      }
      if (twoByTwoflag == true){
        var raw_res = await myFetch( "../getqestionsTwoByTwo.php", "data=" + moji);
          var res = raw_res.split('^^^');
        console.log('0817 res is '+res);
        questionnumbers = res[1].split(',');
        document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
      }
      if (threeByThreeflag == true){
        var raw_res = await myFetch( "../getqestionsThreeByThree.php", "data=" + moji);
          var res = raw_res.split('^^^');
        console.log('0817 res is '+res);
        questionnumbers = res[1].split(',');
        document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
      }
      if (MaxQuestionNumber <= questionnumbers.length) {
        max = Number(MaxQuestionNumber);
      } else {
        max = questionnumbers.length;
        MaxQuestionNumber = questionnumbers.length;
      }


      document.getElementById("press-button").innerHTML = num+1  +"/"+　Number(max);

      if (flag1 == false){
        // alert(max);
          randoms = [];
        /** 重複チェックしながら乱数作成 */
        for(i = min; i < questionnumbers.length; i++){
          while(true){
            // alert(i);
            var tmp = intRandom(min, questionnumbers.length-1);
            if(!randoms.includes(tmp)){
              randoms.push(tmp);
              break;
            }
          }
        }
        flag1 = true;
        var randQNum = new Array();
        for (let i = 0; i < questionnumbers.length; i++) {
          randQNum[i] = questionnumbers[randoms[i]];
        }
        var correctQuestionsSave = correctQuestions;
        // console.log('correctQuestions  is '+correctQuestions );

        correctQuestions = correctQuestionsSave;
        // console.log('correctQuestions  is '+correctQuestions );
        if (document.getElementById("randomOrNot").checked) {
          questionnumbers.length = 0;
          questionnumbers = randQNum;
        }

        questionnumbers = questionnumbers.slice(0, MaxQuestionNumber);
      }

    }

    if (max==1) {
    rand = questionnumbers[0];
    } else {
    rand = questionnumbers[num];
    }
    // console.log('questionnumbers is '+questionnumbers);
    // console.log(' randoms[num]is '+randoms[num]);
    // console.log('376 rand is '+rand);


    // alert(num);
    /*alert(rand);*/
    // alert(questionnumbers[1]);


    var moji=rand + "." + document.mainform.DB_name.value + "." + 
    document.mainform.novelSentenceNumber.value;
    moji = encodeURIComponent(moji);



    var xmlhttp=createXmlHttpRequest();

    if(xmlhttp!=null)
    {

        var res = await myFetch("../" + phpfile1, "data=" + moji);

        // console.log('558 res is '+res);
        var res = res.split('^^^');
        imagefolder = res[2];

        var doc0= document.getElementById("questionInfo");

        var correctNum = ""
        var question = ""
        if (res[0].indexOf("正解数")<0) {
            question = res[0];
            correctNum = res[1];
        } else {
            question = res[1];
            correctNum = res[0];
        }

        doc0.innerHTML= correctNum;
        questiontext = question;


        if ((question.indexOf( "jpg" ) > -1)||(question.indexOf( "png" ) > -1)||(question.indexOf( "gif" ) > -1)||(question.indexOf( "jpeg" ) > -1)) {
          document.getElementById("textareas").style.display = "none";
          document.getElementById("mypic1").style.display = "block";
          document.getElementById("div1").style.display = "block";          
          document.getElementById("questionMath").innerText ="";
          
          // var imageadress =  res.split('\n');
          // console.log('question is ' + question);
          question = question.split('\n\n');
          if (question.length > 1) {
            if (question[1].indexOf( "ttp" ) > 0){
              document.getElementById("mypic1").src=question[1];
            } else {
              document.getElementById("mypic1").src='images/'+imagefolder+'/' + question[1];
            }
          } else {
            if (question[0].indexOf( "ttp" ) > 0){
              document.getElementById("mypic1").src=question[0];
            } else {
              document.getElementById("mypic1").src='images/'+imagefolder+'/' + question[0];
            }
          }


          var image1 = new Image();
          var width;
          var height;

          image1.onload = function(){
              width = image1.width;
              height = image1.height;
              imageSize = document.getElementById("imageSize1").value * image1.width ;
              if ((imageSize>1000)){
               imageSize = 1000;
              }
              if ((width>height)){
                  document.getElementById("mypic1").style.width = imageSize + "px";  // 横幅を400pxにリサイズ
                  document.getElementById("mypic1").style.height = height * (imageSize / width)+"px"; // 高さを横幅の変化割合に合わせる;
                  if (parseInt(document.getElementById("mypic1").style.height)>parseInt(document.getElementById("div1").clientHeight)) {
                    document.getElementById("mypic1").style.height = document.getElementById("div1").clientHeight +"px";
                    document.getElementById("mypic1").style.width = (document.getElementById("mypic1").height*width)/height + "px";
                  } else {
                  }
              } else {
                document.getElementById("mypic1").style.width = image1.width * 1 * document.getElementById("imageSize1").value + "px";
                document.getElementById("mypic1").style.height = height * (image1.width * 1 * document.getElementById("imageSize1").value/ width)+"px";
                // document.getElementById("mypic1").style.height = document.getElementById("div1").clientHeight +"px";
                // document.getElementById("mypic1").style.width = (document.getElementById("mypic1").height*width)/height + "px";
              }

              imageWidth1 = Number(document.getElementById("mypic1").style.width.substr(0,document.getElementById("mypic1").style.width.length -2));
              imageHeight1 = Number(document.getElementById("mypic1").style.height.substr(0,document.getElementById("mypic1").style.height.length -2));

          }
          // if (question.length > 1) {
          //   image1.src ='images/'+imagefolder+'/' + question[1];
          // } else {
          //   image1.src ='images/'+imagefolder+'/' + question[0];
          // }
          // image1.src = 'images/'+imagefolder+'/' + question;
          if (question.length > 1) {
            if (question[1].indexOf( "ttp" ) > 0){
              image1.src=question[1];
            } else {
              image1.src='images/'+imagefolder+'/' + question[1];
            }
          } else {
            if (question[0].indexOf( "ttp" ) > 0){
              image1.src=question[0];
            } else {
              image1.src='images/'+imagefolder+'/' + question[0];
            }
          }

       

        } else if ((question.indexOf( slashKakko ) > -1)){
          document.getElementById("textareas").style.display = "none";
          document.getElementById("div1").style.display = "block";
          document.getElementById("mypic1").style.display = "none";
          document.getElementById("questionMath").innerText = question;
          if (!(document.getElementById("mypic1")=== null)) {
            if (document.getElementById("mypic1").src){
              document.getElementById("mypic1").src= "";
            }      
          }else{
            var img_element = document.createElement('img');
            img_element.id= 'mypic1';
            // 指定した要素にimg要素を挿入
            var content_area = document.getElementById("div1");
            content_area.appendChild(img_element);
          }
          
          MathJax.Hub.Typeset(document.getElementById("div1"));//数式再読み込み
        
        } else if (isHTML(question)){
          document.getElementById("textareas").style.display = "none";
          document.getElementById("div1").style.display = "block";
          document.getElementById("mypic1").style.display = "none";
          document.getElementById("questionMath").innerHTML = question;
        } else {
          document.getElementById("div1").style.display = "none";
          document.getElementById("textareas").style.display = "block";
          document.getElementById( "textareas" ).value = "";
          document.getElementById( "textareas" ).value = question ;////////
          document.getElementById( "textareas2" ).value = "";
          AnswerShown = false;
        }



    }　//苦手度を取得

    var moji=rand + "." + document.mainform.DB_name.value;
    moji = encodeURIComponent(moji);
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
        var res = await myFetch( "../getpoorat.php", "data=" + moji);
        // console.log('534 getpoorat res is '+res);
        document.getElementById( "poorat" ).value = res;

    }
    var slcLang = document.getElementById("autoReading").value;
    if (document.getElementById("autoread").checked && !(document.getElementById( "textareas" ).value == "")
    && !(slcLang == "*e") && !(slcLang == "*j")) {
      readQuestion();
    }

    var ifautoAnswer = document.getElementById("autoAnswer");

    if ((ifautoAnswer.value > 0)) { //最初だけは自動で音楽を流さない
      async function main(){
      var sec = Number(ifautoAnswer.value);
      await sleep(sec*1000);
        if (AnswerShown2 == false){
          sendRequest2();
        }
      }
      main();
    }else {
      
    }
    if ((document.getElementById("chordsOrNot").checked)&&((document.getElementById("ctg3").value ==="コード")||(document.getElementById("ctg3").value ==="音程"))) {
      playChords(document.getElementById("textareas").value);
    }


  // imageResize();
    // settingSave()
  if (mp3PlayFlag != false||music.paused===false) {
    stop();
    music.currentTime = 0;
    mp3PlayFlag=false;
  }
}

function isHTML(str) {
    // 正規表現を使用してHTMLタグをチェック
    const pattern = /<\/?[a-z][\s\S]*>/i;
    return pattern.test(str);
}


function createXmlHttpRequest()
{
    var xmlhttp=null;
    //alert("3");
    if(window.ActiveXObject)
    {
        try
        {
            xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e)
        {
            try
            {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e2)
            {
            }
        }
    }
    else if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;

}


async function sendRequest2(){

 randoms = [];
  AnswerShown = true;
  AnswerShown2 = true;
  
  /** 重複チェックしながら乱数作成 */
  for(i = min; i < max+1; i++){
    while(true){
      // alert(i);
      var tmp = intRandom(min, max);
      if(!randoms.includes(tmp)){
        randoms.push(tmp);
        break;
      }
    }
  }




  // console.log('606 getpastTime is '+getpastTime);
  var QAChangeChecked = document.getElementById("qachange").checked;////

  if (QAChangeChecked) {
      var phpfile1 = "getonequestion2.php";
      var phpfile2 = "getanswer2.php";
  } else {
      var phpfile1 = "getonequestion1.php";
      var phpfile2 = "getanswer1.php";
  }
  var moji=rand + "." + document.mainform.DB_name.value;
  moji = encodeURIComponent(moji);
  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null){
    // alert(phpfile2);
    var res = await myFetch( "../"　+ phpfile2 , "data=" + moji);
    // console.log('502 res is '+ res);
    var AnswerTyped = document.getElementById( "textareas2" ).value;
    document.getElementById( "textareas2" ).value = "";


    if ((res.indexOf( "jpg" ) > -1)||(res.indexOf( "png" ) > -1)||(res.indexOf( "gif" ) > -1)||(res.indexOf( "jpeg" ) > -1)) {
      var resArr=Array();
      if (res.indexOf( "\n.....\n" ) > -1){
        resArr = res.split('\n.....\n');
        res = resArr[0];
        document.getElementById("answerHint").innerText = resArr[1];
      }
      
      document.getElementById("textareas2").style.display = "none";
      document.getElementById("mypic2").style.display = "block";
      document.getElementById("div2").style.display = "block";
      document.getElementById("answerMath").innerText ="";
      let parent = document.getElementById("answerMath");
      while(parent.lastChild){
        parent.removeChild(parent.lastChild);
      }
      // resizeTextareas();
      if (!resArr.length){
        document.getElementById("answerHint").innerText ="";
      }
      var imageadress =  res.split('\n');
      // console.log('imageadress is ' + imageadress);
      if (res.indexOf( "ttp" ) > 0){
        document.getElementById("mypic2").src=res;
      } else {
        document.getElementById("mypic2").src='images/'+imagefolder+'/' + imageadress[0];
      }
      
      // document.getElementById("mypic2").style.width = "200px"
      var el = document.getElementById("mypic2");
      var image2 = new Image();
      var width2;
      var height2;


      image2.onload = function(){
        width2 = image2.width;//画像の幅
        height2 = image2.height;//画像の高さ
        modifiedWidth2 = document.getElementById("imageSize2").value * width2 ;//画像幅に指定値をかけたもの
        modifiedHeight2  = document.getElementById("imageSize2").value * height2 ;
        if ((imageSize2>1000)){
          imageSize2 = 1000;
        }
        console.log('div2.width is ' + $('#div2').width());
        console.log('div2.height is ' + $('#div2').height());
        var result = $('#div2').innerWidth() - $('#div2').clientWidth;
        console.log('result is ' + result);
        if ((width2>height2)){
          document.getElementById("mypic2").style.width = modifiedWidth2 + "px";  // 
          document.getElementById("mypic2").style.height = modifiedHeight2　+"px"; // 高さを横幅の変化割合に合わせる;
          // document.getElementById("mypic2").style.width = $('#div1').width() + "px";  // 
          // document.getElementById("mypic2").style.height = $('#div1').height()　+"px"; // 高さを横幅の変化割合に合わせる;
          if (parseInt(document.getElementById("mypic2").style.width) > $('#div2').width()) {
            var pic2w = parseInt(document.getElementById("mypic2").style.width);
            var pic2h = parseInt(document.getElementById("mypic2").style.height);
            document.getElementById("mypic2").style.width = $('#div2').width() + "px";  // 
            document.getElementById("mypic2").style.height =  ($('#div2').width() * pic2h)/pic2w + "px";
          }
          if (parseInt(document.getElementById("mypic2").style.height) > $('#div2').height()) {
            var pic2w = parseInt(document.getElementById("mypic2").style.width);
            var pic2h = parseInt(document.getElementById("mypic2").style.height);
            document.getElementById("mypic2").style.height = $('#div2').height() + "px";  // 
            document.getElementById("mypic2").style.width =  ($('#div2').height() * pic2w)/pic2h + "px";
          }
        } else {
          document.getElementById("mypic2").style.width = image2.width * document.getElementById("imageSize2").value + "px";
          document.getElementById("mypic2").style.height = height2 * (image2.width * document.getElementById("imageSize2").value/ width2)+"px";
          // document.getElementById("mypic1").style.height = document.getElementById("div1").clientHeight +"px";
          // document.getElementById("mypic1").style.width = (document.getElementById("mypic1").height*width)/height + "px";
          if (parseInt(document.getElementById("mypic2").style.height) > $('#div2').height()) {
            var pic2w = parseInt(document.getElementById("mypic2").style.width);
            var pic2h = parseInt(document.getElementById("mypic2").style.height);
            document.getElementById("mypic2").style.height = $('#div2').height() + "px";  // 
            document.getElementById("mypic2").style.width =  ($('#div2').height() * pic2w)/pic2h + "px";
          }
          if (parseInt(document.getElementById("mypic2").style.width) > $('#div2').width()) {
            var pic2w = parseInt(document.getElementById("mypic2").style.width);
            var pic2h = parseInt(document.getElementById("mypic2").style.height);
            document.getElementById("mypic2").style.width = $('#div2').width() + "px";  // 
            document.getElementById("mypic2").style.height =  ($('#div2').width() * pic2h)/pic2w + "px";
          }
        }

        imageWidth2 = Number(document.getElementById("mypic2").style.width.substr(0,document.getElementById("mypic2").style.width.length -2));
        imageHeight2 = Number(document.getElementById("mypic2").style.height.substr(0,document.getElementById("mypic2").style.height.length -2));
      }

        if (res.indexOf( "ttp" ) > 0){
          image2.src=res;
        } else {
          image2.src='images/'+imagefolder+'/' + imageadress[0];
        }
    }else if (res.indexOf( "mp3" ) > 0||music.paused===false){//答えがmp3なら
      if (musicStartFlug === false){
        musicStartFlug = true;
      }else{
        music.preload = "auto";
        music.src = "./mp3/" + res;
        music.load();
        init(res);
        if (mp3PlayFlag != true) {
          play();
          mp3PlayFlag=true;
        } else {
          stop();
          mp3PlayFlag=false;
        }
        if (res === "問題がありません。"){
          stop();
          mp3PlayFlag=false;
        }
      }      
    } else if ((res.indexOf( slashKakko ) > -1)||(res.indexOf("span") > -1)){
      document.getElementById("textareas2").style.display = "none";
      document.getElementById("div2").style.display = "block";
      document.getElementById("mypic2").style.display = "none";
      // document.getElementById("answerMath").innerText = res;
      if (res.indexOf("span") > -1){ //Html形式の解答なら
        let parent = document.getElementById("answerMath");
        while(parent.lastChild){
          parent.removeChild(parent.lastChild);
        }
        document.getElementById("answerMath").insertAdjacentHTML('afterbegin',res);
      }else{
        
        document.getElementById("answerMath").innerText = res;
      }
      if (!(document.getElementById("mypic2")=== null)) {
        if (document.getElementById("mypic2").src){
          document.getElementById("mypic2").src= "";
        }      
      }else{
        var img_element = document.createElement('img');
        img_element.id= 'mypic2';
        // 指定した要素にimg要素を挿入
        var content_area = document.getElementById("div2");
        content_area.appendChild(img_element);
      }

      MathJax.Hub.Typeset(document.getElementById("div2"));//数式再読み込み
    } else if (isHTML(res)){
          document.getElementById("textareas2").style.display = "none";
          document.getElementById("div2").style.display = "block";
          document.getElementById("mypic2").style.display = "none";
          document.getElementById("answerMath").innerHTML = res;
    } else {
      document.getElementById("answerMath").innerText ="";
      let parent = document.getElementById("answerMath");
      while(parent.lastChild){
        parent.removeChild(parent.lastChild);
      }
      
      document.getElementById("div2").style.display = "none";
      document.getElementById("textareas2").style.display = "block";
      document.getElementById( "textareas2" ).value = "";
      if (AnswerTypedFlag === true) {
  		document.getElementById( "textareas2" ).value = document.getElementById( "textareas2" ).value + res + "\n";
        document.getElementById( "textareas2" ).value = document.getElementById( "textareas2" ).value + AnswerTyped ; 

        
        event.keyCode = 0;
      } else {
        document.getElementById( "textareas2" ).value = res;
      }
      answertext = res ;

    }
  }
  if (answertextareaflag == false ) {
      answertextareaflag = true;
  }else{
      answertextareaflag = false
      document.getElementById( "textareas2" ).value = "";
      document.getElementById("mypic2").src= "";

  }
  var slcLang = document.getElementById("autoReading").value;
  if (document.getElementById("autoread").checked && !(document.getElementById( "textareas2" ).value == "")
  && !(slcLang == "e*") && !(slcLang == "j*")) {
    readAnswer();
  }

}

async function sendRequest3(goodPoor)
{
  now = new Date();
  getQendTime = now.getTime();
  getpastTime = Math.round((getQendTime-getQstartTime)/100)/10;
  correctQuestions.push(rand);
  document.mainform.poorat.value = goodPoor;
  incorrectNumber = 0;
  // console.log('document.mainform.poorat.value is ' + document.mainform.poorat.value);
  var moji=rand + "^" + document.mainform.DB_name.value + "^" + document.mainform.poorat.value + "^" +getpastTime;
  moji = encodeURIComponent(moji);
  // console.log('656 poorat is '+ document.mainform.poorat.value);
  // console.log('657 getpastTime is '+ getpastTime);
  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null)
  {
    var res = await myFetch( "../addcorrect.php", "data=" + moji);
    // console.log('534 addcorrectres is '+res);
    document.getElementById( "textareas2" ).value = "";
    // document.getElementById( "preQInfo" ).innerHTML = "前問の結果  " +res;
    document.getElementById("div2").style.display = "none";
    document.getElementById("textareas2").style.display = "block";
  }


  sendRequest();

}


var incorrectNumber = 0;


async function sendRequest4(goodPoor){
  now = new Date();
  getQendTime = now.getTime();
  getpastTime = Math.round((getQendTime-getQstartTime)/100)/10;
  incorrectQuestions.push(rand);
  let arr = incorrectQuestions.filter(element => element == rand)//何回同じ問題を間違えているのか
  if (arr.length >20){return};
  incorrectNumber = incorrectNumber + 1
  if (incorrectNumber >100){
    return;
  };
  document.mainform.poorat.value = goodPoor;
  var moji=rand + "^" + document.mainform.DB_name.value + "^" + document.mainform.poorat.value + "^" +getpastTime;
  moji = encodeURIComponent(moji);
  // console.log('678 poorat is '+ document.mainform.poorat.value);
  // console.log('679 getpastTime is '+ getpastTime);
  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null){
    var res = await myFetch( "../addincorrect.php", "data=" + moji);
    document.getElementById( "textareas2" ).value = "";
    // document.getElementById( "preQInfo" ).innerHTML = "前問の結果  " +res;
    document.getElementById("div2").style.display = "none";
    document.getElementById("textareas2").style.display = "block";
  }

  sendRequest();
}

async function correctMinus(){
  var moji=rand + "^" + document.mainform.DB_name.value;
  moji = encodeURIComponent(moji);
  // console.log('678 poorat is '+ document.mainform.poorat.value);
  // console.log('679 getpastTime is '+ getpastTime);
  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null)
  {
    var res = await myFetch( "../correctMinus.php", "data=" + moji);
    document.getElementById( "textareas2" ).value = "";
    document.getElementById( "textareas2" ).value = res;
    document.getElementById("div2").style.display = "none";
    document.getElementById("textareas2").style.display = "block";
  }
}

async function incorrectMinus(){
  var moji=rand + "^" + document.mainform.DB_name.value;
  moji = encodeURIComponent(moji);
  // console.log('678 poorat is '+ document.mainform.poorat.value);
  // console.log('679 getpastTime is '+ getpastTime);
  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null)
  {
    var res = await myFetch( "../incorrectMinus.php", "data=" + moji);
    document.getElementById( "textareas2" ).value = "";
    document.getElementById( "textareas2" ).value = res;
    document.getElementById("div2").style.display = "none";
    document.getElementById("textareas2").style.display = "block";
  }
}

async function sendRequest5(){
  var QAChangeChecked = document.getElementById("qachange").checked;
  if (QAChangeChecked) {      
      var moji=rand + "^^^^^" +
      document.mainform.DB_name.value + "^^^^^" +
      document.getElementById( "textareas2" ).value + "^^^^^" +
      document.getElementById( "textareas" ).value;      
  } else {
    if (document.getElementById( "textareas2" ).value.indexOf('...............')=== -1){
      var moji=rand + "^^^^^" +
      document.mainform.DB_name.value + "^^^^^" +
      document.getElementById( "textareas" ).value + "^^^^^" +
      document.getElementById( "textareas2" ).value;
    }else{
      var split =document.getElementById( "textareas2" ).value.split('\n............................................................\n');
      var moji=rand + "^^^^^" +
      document.mainform.DB_name.value + "^^^^^" +
      document.getElementById( "textareas" ).value + "^^^^^" +
      split[0]+ "^^^^^" +split[1];
    }
  }
  moji = encodeURIComponent(moji);
  var xmlhttp=createXmlHttpRequest2();
  if ((xmlhttp!=null)　&& ((moji.indexOf('Your%20Answer')=== -1) && (moji.indexOf('...............')=== -1))) {//修正する問題と答えに自分の解答やヒントがなければ修正する。
    var res = await myFetch( "../modifyquestionanswer.php", "data=" + moji);
    // console.log('721 res is '+res);
  }
}

async function deleteQ(){
  var moji=rand + "^" + document.mainform.DB_name.value;
  moji = encodeURIComponent(moji);
  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null){
    var res = await myFetch( "../deleteQuestion.php", "data=" + moji);
    // console.log('delete is ' + res);
    document.getElementById( "textareas" ).value = "問題を削除しました。";
    document.getElementById( "textareas2" ).value = "";
  }
}

function createXmlHttpRequest2(){
  var xmlhttp=null;
  if(window.ActiveXObject){
    try{
      xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e){
      try{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch (e2){
      }
    }
  }
  else if(window.XMLHttpRequest){
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

/** min以上max以下の整数値の乱数を返す */
function intRandom(min, max){
    return Math.floor( Math.random() * (max - min + 1)) + min;
}

async function listChange(categorySelect){
    // console.log("1");
    console.log(categorySelect.id);
    
    firstRemoveFlag =false;
    num=0;
    // document.getElementById("press-button").innerHTML = num +"/"+ max;
    flag1 = false;
    var sampleArea = document.getElementById("textareas");
    

    var elem = document.getElementById('ctg1');
    var opts = elem.options; // select要素のoptionプロパティ
    // console.log(opts);       // HTMLOptionsCollection(3)
    var selectedCategory1 = [];
    for (var i = 0; i < opts.length; i++) {          
      if (opts[i].selected) {
        selectedCategory1.push(opts[i].value);
      }
    }
    var selectedCategory1 = selectedCategory1.join("^");
    //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory1"+selectedCategory1+"<br><br><br>");
    var elem = document.getElementById('ctg2');
    var opts = elem.options; // select要素のoptionプロパティ
    // console.log(opts);       // HTMLOptionsCollection(3)
    var selectedCategory2 = [];
    for (var i = 0; i < opts.length; i++) {          
      if (opts[i].selected) {
        selectedCategory2.push(opts[i].value);
      }
    }
    var selectedCategory2 = selectedCategory2.join("^");
    //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory2"+selectedCategory2+"<br><br><br>");
    var elem = document.getElementById('ctg3');
    var opts = elem.options; // select要素のoptionプロパティ
    // console.log(opts);       // HTMLOptionsCollection(3)
    var selectedCategory3 = [];
    for (var i = 0; i < opts.length; i++) {          
      if (opts[i].selected) {
        selectedCategory3.push(opts[i].value);
      }
    }
    var selectedCategory3 = selectedCategory3.join("^");
    //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory3"+selectedCategory3+"<br><br><br>");
    var elem = document.getElementById('ctg4');
    var opts = elem.options; // select要素のoptionプロパティ
    // console.log(opts);       // HTMLOptionsCollection(3)
    var selectedCategory4 = [];
    for (var i = 0; i < opts.length; i++) {          
      if (opts[i].selected) {
        selectedCategory4.push(opts[i].value);
      }
    }
    var selectedCategory4 = selectedCategory4.join("^");
    //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory4"+selectedCategory4+"<br><br><br>");
    var elem = document.getElementById('ctg5');
    var opts = elem.options; // select要素のoptionプロパティ
    // console.log(opts);       // HTMLOptionsCollection(3)
    var selectedCategory5 = [];
    for (var i = 0; i < opts.length; i++) {          
      if (opts[i].selected) {
        selectedCategory5.push(opts[i].value);
      }
    }
    var selectedCategory5 = selectedCategory5.join("^");
    //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory5"+selectedCategory5+"<br><br><br>");

    if(categorySelect.id != "ctg2"){
      var moji= document.mainform.DB_name.value 
      + "." + selectedCategory1
      + "." + selectedCategory2
      + "." + selectedCategory3
      + "." + selectedCategory4
      + "." + selectedCategory5
      + "." + "category2";
      var sampleArea = document.getElementById("textareas");
      //sampleArea.insertAdjacentHTML("beforebegin",moji+"<br><br><br>");
      moji = encodeURIComponent(moji);
      // console.log(moji);
      var xmlhttp=createXmlHttpRequest();
      if(xmlhttp!=null)
      {
          // console.log("2");
          var raw_res = await myFetch("../ctgchange.php", "data=" + moji);
          var res=raw_res.split("^^^");
          // console.log("2.2"+" "+res);
          // console.log("2.2"+res);
          res=res[1].replace(',,,,,,', '');
          var selectedcategory2 = res.split(',,,');
          var sampleArea = document.getElementById("textareas");
          //sampleArea.insertAdjacentHTML("beforebegin",selectedcategory2+"<br><br><br>");
          // console.log(selectedcategory2);
          // console.log(selectedcategory2[1]);
          var ctg2selectedindex = document.getElementById('ctg2').value;
          // console.log(ctg2selectedindex);
          var sl = document.getElementById('ctg2');
          while(sl.lastChild)
          {
              sl.removeChild(sl.lastChild);
          }

          var selectElement = document.getElementById("ctg2");

          for(var i = 1; i < selectedcategory2.length; i ++){
              var option = document.createElement("option");
              option.value = selectedcategory2[i];
              option.innerText = selectedcategory2[i];
              selectElement.appendChild(option);
          }
          // console.log(ctg2selectedindex);
          document.getElementById('ctg2').value = ctg2selectedindex;
          // console.log(document.getElementById('ctg2').value);
          $("#ctg2").val(ctg2selectedindex);
      }
    }


    if(categorySelect.id != "ctg3"){
      var moji= document.mainform.DB_name.value 
      + "." + selectedCategory1
      + "." + selectedCategory2
      + "." + selectedCategory3
      + "." + selectedCategory4
      + "." + selectedCategory5
      + "." + "category3";
      moji = encodeURIComponent(moji);
      // console.log(moji);
      var xmlhttp=createXmlHttpRequest();
      if(xmlhttp!=null)
      {
        // console.log("3");
        var raw_res = await myFetch("../ctgchange.php", "data=" + moji);
          var res=raw_res.split("^^^");
        // console.log("2.2"+" "+res);
        // console.log("627 "+ res);
        //res=res.replace(',,,,,,', '');
        var selectedcategory3 = res[1].split(',,,');
        var sampleArea = document.getElementById("textareas");
        //sampleArea.insertAdjacentHTML("beforebegin",selectedcategory3+"<br><br><br>");
        // console.log("629 "+selectedcategory3);
        // console.log(selectedcategory2[1]);
        var ctg3selectedindex = document.getElementById('ctg3').value;
        // console.log(ctg2selectedindex);
        var sl = document.getElementById('ctg3');
        while(sl.lastChild)
        {
            sl.removeChild(sl.lastChild);
        }

        var selectElement = document.getElementById("ctg3");

        for(var i = 1; i < selectedcategory3.length; i ++){
            var option = document.createElement("option");
            option.value = selectedcategory3[i];
            option.innerText = selectedcategory3[i];
            selectElement.appendChild(option);
        }

        document.getElementById('ctg3').value = ctg3selectedindex;
        // console.log(document.getElementById('ctg3').value);
        // $("#ctg2").val(ctg2selectedindex);

      }
    }

    if(categorySelect.id != "ctg4"){
      var moji= document.mainform.DB_name.value 
      + "." + selectedCategory1
      + "." + selectedCategory2
      + "." + selectedCategory3
      + "." + selectedCategory4
      + "." + selectedCategory5
      + "." + "category4";
      moji = encodeURIComponent(moji);
      // console.log(moji);
      var xmlhttp=createXmlHttpRequest();
      if(xmlhttp!=null)
      {
        // console.log("3");
        var raw_res = await myFetch("../ctgchange.php", "data=" + moji);
          var res=raw_res.split("^^^");
        // console.log("2.2"+" "+res);
        // console.log("627 "+ res);
        res=res[1].replace(',,,,,,', '');
        var selectedcategory3 = res.split(',,,');
        // console.log("629 "+selectedcategory3);
        // console.log(selectedcategory2[1]);
        var ctg3selectedindex = document.getElementById('ctg4').value;
        // console.log(ctg2selectedindex);
        var sl = document.getElementById('ctg4');
        while(sl.lastChild)
        {
            sl.removeChild(sl.lastChild);
        }

        var selectElement = document.getElementById("ctg4");

        for(var i = 1; i < selectedcategory3.length; i ++){
            var option = document.createElement("option");
            option.value = selectedcategory3[i];
            option.innerText = selectedcategory3[i];
            selectElement.appendChild(option);
        }

        document.getElementById('ctg4').value = ctg3selectedindex;
        // console.log(document.getElementById('ctg3').value);
        // $("#ctg2").val(ctg2selectedindex);

      }
    }

    if(categorySelect.id != "ctg5"){
      var moji= document.mainform.DB_name.value 
      + "." + selectedCategory1
      + "." + selectedCategory2
      + "." + selectedCategory3
      + "." + selectedCategory4
      + "." + selectedCategory5
      + "." + "category5";
      moji = encodeURIComponent(moji);
      // console.log(moji);
      var xmlhttp=createXmlHttpRequest();
      if(xmlhttp!=null)
      {
        // console.log("3");
        var raw_res = await myFetch("../ctgchange.php", "data=" + moji);
          var res=raw_res.split("^^^");
        // console.log("2.2"+" "+res);
        // console.log("627 "+ res);
        res=res[1].replace(',,,,,,', '');
        var selectedcategory3 = res.split(',,,');
        // console.log("629 "+selectedcategory3);
        // console.log(selectedcategory2[1]);
        var ctg3selectedindex = document.getElementById('ctg5').value;
        // console.log(ctg2selectedindex);
        var sl = document.getElementById('ctg5');
        while(sl.lastChild)
        {
            sl.removeChild(sl.lastChild);
        }

        var selectElement = document.getElementById("ctg5");

        for(var i = 1; i < selectedcategory3.length; i ++){
            var option = document.createElement("option");
            option.value = selectedcategory3[i];
            option.innerText = selectedcategory3[i];
            selectElement.appendChild(option);
        }

        document.getElementById('ctg5').value = ctg3selectedindex;
        // console.log(document.getElementById('ctg3').value);
        // $("#ctg2").val(ctg2selectedindex);

      }
    }
}


function listChanged(){
  firstRemoveFlag =false;
  // alert(flag1);
  num=-1;
  // document.getElementById("press-button").innerHTML = num +"/"+ max;
  flag1 = false;
  // alert(flag1);
}

async function backQuestion(){
  if ((document.getElementById("novelSelect").value) && !(document.getElementById("novelSelect").value == "なし")){
    //小説戻す
    novelRowNum = Number(novelRowNum)-1
    getNovelSentence();
  }
  now = new Date();
  getQstartTime = now.getTime();
  console.log(`backQuestion`);
  answertextareaflag = false;
  var QAChangeChecked = document.getElementById("qachange").checked;////

  if (QAChangeChecked) {
      var phpfile1 = "getonequestion2.php";
      var phpfile2 = "getanswer2.php";
  } else {
      var phpfile1 = "getonequestion1.php";
      var phpfile2 = "getanswer1.php";
  }

  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null){
    if (num>0) {
        num = num -1;
    } else {
        num=Number(max)-1;
    }
    // console.log('num is '+num);
    document.getElementById("press-button").innerHTML = num+1   +"/"+Number(max);
    rand = questionnumbers[num];
    var moji=rand + "." + document.mainform.DB_name.value;
    moji = encodeURIComponent(moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null){
      var res = await myFetch("../" + phpfile1, "data=" + moji);
      // console.log('1120 res is '+res);
      var res = res.split('^^^');
      var doc0= document.getElementById("questionInfo");
      var correctNum = ""
      var question = ""

      if (res[0].indexOf("正解数")<0) {
        question = res[0];
        correctNum = res[1];
      } else {
        question = res[1];
        correctNum = res[0];
      }

      doc0.innerHTML= correctNum;

      if ((question.indexOf( "jpg" ) > -1)||(question.indexOf( "png" ) > -1)||(question.indexOf( "gif" ) > -1)||(question.indexOf( "jpeg" ) > -1)) {
        document.getElementById("textareas").style.display = "none";
        document.getElementById("div1").style.display = "block";
        // var imageadress =  res.split('\n');
        // console.log('question is ' + question);
        // console.log('imagefolder is ' + res[2]);
        document.getElementById("mypic1").src='images/'+res[2]+'/' + question;
        // document.getElementById("mypic1").style.width = "700px";
      } else {
        document.getElementById("div1").style.display = "none";
        document.getElementById("textareas").style.display = "block";
        document.getElementById( "textareas" ).value = "";
        document.getElementById( "textareas" ).value = question ;
        document.getElementById( "textareas2" ).value = "";;
      }
    }　//苦手度を取得
    var moji=rand + "." + document.mainform.DB_name.value;
    moji = encodeURIComponent(moji);
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
      var res = await myFetch( "../getpoorat.php", "data=" + moji);
      // console.log('534 getpoorat res is '+res);
      document.getElementById( "poorat" ).value = res;
    }
  }
}

function forgettingcurve(){
  listChanged()
  var now = new Date();
  var yesterday = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 1);
  var aweekago = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 7);
  var amonthago = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 30);

  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "=";
  document.getElementById("criteria1").value = formatDate(yesterday, 'YYYYMMDD');
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  document.getElementById("criteria2").value = formatDate(aweekago, 'YYYYMMDD');
  document.getElementById("category6").value = "qdate";
  document.getElementById("operator3").value = "=";
  document.getElementById("criteria3").value = formatDate(amonthago, 'YYYYMMDD');
  sendRequest()
}

function NotYetQuestion(){
  listChanged()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "<";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category4").value = "";
  document.getElementById("operator1").value = "";
  document.getElementById("criteria1").value = "";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  sendRequest()
}

function UnderFifty(){
  listChanged()
  document.getElementById("category6").value = "pca";
  document.getElementById("operator3").value = "<";
  document.getElementById("criteria3").value = "50";
  document.getElementById("category5").value = "incorrect";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "0";
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  sendRequest()
}
function yesterdayQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  yesterdayIncorrect = true;
  getYesterdayNumberFunc();
  sendRequest()
}
function threeDaysAgoQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  getThreeDaysAgoNumberFunc()
  sendRequest()
}
function noTodayQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  sendRequest()
}
function errTodayQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "=";
  getTodayNumberFunc()
  yesterdayIncorrect = true;
  sendRequest()
}
function errLastQuestion(){
  yesterdayIncorrect = true;
  sendRequest()
}
function aWeekAgoQuestion(){
  listChanged()
 
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()  
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  getAWeekAgoNumberFunc();
  document.getElementById("category6").value = "qdate";
  document.getElementById("operator3").value = ">";
  document.getElementById("criteria3").value = "20190101";
  sendRequest()
}
function aMonthAgoQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()  
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  getAMonthAgoNumberFunc();
  document.getElementById("category6").value = "qdate";
  document.getElementById("operator3").value = ">";
  document.getElementById("criteria3").value = "20190101";
  sendRequest()
}
function levelZero(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "0";
  sendRequest()
}
function levelOne(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "1";
  sendRequest()
}
function levelTwo(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "2";
  sendRequest()
}
function levelThree(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "3";
  sendRequest()
}
function levelFour(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "4";
  sendRequest()
}
function ZeroPercent(){
  listChanged()
  document.getElementById("category6").value = "pca";
  document.getElementById("operator3").value = "=";
  document.getElementById("criteria3").value = "0";
  document.getElementById("category5").value = "incorrect";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "0";
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  sendRequest()
}
function atLeastOneFunc(){
  listChanged()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  sendRequest()
}

function oneByOneFunc(){
  oneByOneflag = true;
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  document.getElementById("criteria1").value = "20190101";
  document.getElementById("category5").value = "";
  document.getElementById("operator2").value = "";
  document.getElementById("criteria2").value = "";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  sendRequest()
  oneByOneflag = false;
}

function twoByTwoFunc(){
  twoByTwoflag = true;
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  document.getElementById("criteria1").value = "20190101";
  document.getElementById("category5").value = "";
  document.getElementById("operator2").value = "";
  document.getElementById("criteria2").value = "";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  sendRequest()
  twoByTwoflag = false;
}

function threeByThreeFunc(){
  threeByThreeflag = true;
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  document.getElementById("criteria1").value = "20190101";
  document.getElementById("category5").value = "";
  document.getElementById("operator2").value = "";
  document.getElementById("criteria2").value = "";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  sendRequest()
  threeByThreeflag = false;
}
var formatDate = function (date, format) {
  if (!format) format = 'YYYY-MM-DD hh:mm:ss.SSS';
  format = format.replace(/YYYY/g, date.getFullYear());
  format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
  format = format.replace(/DD/g, ('0' + date.getDate()).slice(-2));
  format = format.replace(/hh/g, ('0' + date.getHours()).slice(-2));
  format = format.replace(/mm/g, ('0' + date.getMinutes()).slice(-2));
  format = format.replace(/ss/g, ('0' + date.getSeconds()).slice(-2));
  if (format.match(/S/g)) {
    var milliSeconds = ('00' + date.getMilliseconds()).slice(-3);
    var length = format.match(/S/g).length;
    for (var i = 0; i < length; i++) format = format.replace(/S/, milliSeconds.substring(i, i + 1));
  }
  return format;
};



const uttr2 = new SpeechSynthesisUtterance()

function readAnswer(){//
  // 発言を作成
  uttr2.text = answerText2.value;

  var isJapanese = false;  //日本語（英語以外）の場合「true」に設定
  for(var i=0; i < uttr2.text.length; i++){
      if(uttr2.text.charCodeAt(i) >= 256) {
        isJapanese = true;
        break;
      }
  }

  var lang;

  if (isJapanese){
    lang=readVoices.find(el => el.indexOf('Japanese')>-1);
    if (!lang){
      lang=readVoices.find(el => el.indexOf('Kyoko')>-1);
    }
  }else{
    lang=readVoices.find(el => el.indexOf('English')>-1);
    if (!lang){
      lang=readVoices.find(el => el.indexOf('Samantha')>-1);
    }
  }

  // 言語 (日本語:ja-JP, アメリカ英語:en-US, イギリス英語:en-GB, 中国語:zh-CN, 韓国語:ko-KR)
  var slcLang = document.getElementById("autoReading").value




  uttr2.rate = 0.7

  if (isJapanese == true) {
    uttr2.rate = document.getElementById("jpSpeed").value;
  } else {      
    uttr2.rate = document.getElementById("engSpeed").value;
  }

  // 高さ 0-2 初期値:1
  uttr2.pitch = 1

  // 音量 0-1 初期値:1
  uttr2.volume = 0.75

  
  // // ③ 選択された声を指定
  // uttr2.voice = window.speechSynthesis.getVoices()[voice];
  // alert(readVoices);
  uttr2.voice = speechSynthesis
  .getVoices()
  .filter(voice => voice.name == lang)[0]; //言語設定

  speechSynthesis.speak(uttr2)
  // alert(uttr2.voice.name);



}
const uttr = new SpeechSynthesisUtterance();

function readQuestion(){
  // const uttr = new SpeechSynthesisUtterance(questionText2.value)
  uttr.text = questionText2.value;
  var isJapanese = false;  //日本語（英語以外）の場合「true」に設定
  for(var i=0; i < uttr.text.length; i++){
      if(uttr.text.charCodeAt(i) >= 256) {
        isJapanese = true;
        break;
      }
  }

  var lang;

  if (isJapanese){
    lang=readVoices.find(el => el.indexOf('Japanese')>-1);
    if (!lang){
      lang=readVoices.find(el => el.indexOf('Kyoko')>-1);
    }
  }else{
    lang=readVoices.find(el => el.indexOf('English')>-1);
    if (!lang){
      lang=readVoices.find(el => el.indexOf('Samantha')>-1);
    }
  }

  // 言語 (日本語:ja-JP, アメリカ英語:en-US, イギリス英語:en-GB, 中国語:zh-CN, 韓国語:ko-KR)
  var slcLang = document.getElementById("autoReading").value
  

  uttr.rate = 0.7

  if (isJapanese == true) {
    uttr.rate = document.getElementById("jpSpeed").value;
  } else {      
    uttr.rate = document.getElementById("engSpeed").value;
  }

  // 高さ 0-2 初期値:1
  uttr.pitch = 1

  // 音量 0-1 初期値:1
  uttr.volume = 0.75
  // ③ 選択された声を指定
  // uttr.voice = window.speechSynthesis.getVoices()[voice];

  // alert (uttr.rate);
  uttr.voice = speechSynthesis
  .getVoices()
  .filter(voice => voice.name == lang)[0]; 
  // .filter(voice => voice.name == readVoices[0])[0];      //言語設定
  // uttr.voice = speechSynthesis
  //   .getVoices()
  //   .filter(voice => voice.name === voiceSelect.value)[0]
  // 発言を再生 (発言キュー発言に追加)
  speechSynthesis.speak(uttr)



}

function autoQuestion(){
  // console.log('document.getElementById("jpSpeed").value is ' + document.getElementById("jpSpeed").value);
  var slcLang = document.getElementById("autoReading").value;
  if (autoflag==false) {
  autoflag = true;
  } else {
  autoflag = false;
  }
  var finishReading = false;
  var finishReading2 = false;
  // console.log('autoflag is ' + autoflag);
  if (document.getElementById("autoread").checked) {
    async function main(){
      for(;;) {
        if (autoflag == false) {
            break;
        }

        sendRequest();
        if (!(slcLang == "*e") && !(slcLang == "*j")){
          uttr.onend = function (event) {
            // console.log(`3`);
            finishReading = true;
          }
          while (finishReading == false){
            // i++;    // この文が無いと無限ループになってしまう。
            // console.log(i);
            await sleep(500);
          }
        }

        sendRequest2();
        if (!(slcLang == "e*") && !(slcLang == "j*")){
              uttr2.onend = function (event) {
                // console.log(`4`);
                finishReading2 = true;
              }
              while (finishReading2 == false){
                i++;    // この文が無いと無限ループになってしまう。
                // console.log(i);
                await sleep(500);
              }
        }
        finishReading = false;
        finishReading2 = false;
      }
    }
    main();

  } else {
    var speed = document.getElementById("autoSpeed").value * 1000;
    async function main(){
      for(;;) {
        if (autoflag == false) {
            break;
        }
        sendRequest();
        await sleep(speed);
        sendRequest2();
        await sleep(speed);
      }
    }
    main();
  }
}

function sleep(time){
  return new Promise(resolve => {
    sleepId = setTimeout(resolve, time);
  });
}

function textareafontresize(){
  document.getElementById("textareas").style.fontSize = document.getElementById("fontresize").value;
  document.getElementById("textareas2").style.fontSize = document.getElementById("fontresize").value;
  document.getElementById("questionMath").style.fontSize = document.getElementById("fontresize").value;
  document.getElementById("answerMath").style.fontSize = document.getElementById("fontresize").value;
  document.getElementById("answerHint").style.fontSize = document.getElementById("fontresize").value;

    
}

var firstRemoveFlag =false;

function removeCorrects(){
  var counts = {};
  minimumCorrect = Number(document.getElementById("NOC").value);
  console.log('削除前　questionnumbers is ' + questionnumbers);
  for(var i=0;i< correctQuestions.length;i++){
    var key = correctQuestions[i];
    counts[key] = (counts[key])? counts[key] + 1 : 1 ;
  }
  for (var key in counts) {
      console.log(key + " : " + counts[key]);
  }
  if (!firstRemoveFlag) {
    for (let i = 0; i < questionnumbers.length; i++) {
      if (Number(counts[questionnumbers[i]]) == 1) {
        questionnumbers.splice(i, 1);
        i=i-1;
        
      }
      firstRemoveFlag =true;
    }
  } else {
    for (let i = 0; i < questionnumbers.length; i++) {
      if (Number(counts[questionnumbers[i]]) >= minimumCorrect) {
        questionnumbers.splice(i, 1);
        i=i-1;
      }
    }
  }
  // console.log('削除後　questionnumbers is ' + questionnumbers);
  MaxQuestionNumber = questionnumbers.length;
}



// document.onkeydown = keydown;
document.addEventListener('keydown', (ev) => {
  if(!ev.repeat)
  keydown()
})
function keydown() {
  console.log('event.keyCode is ' + event.keyCode);
  console.log('event.code is ' + event.code);
  console.log('event.shiftKey is ' + event.altKey);
  // 現在フォーカスが与えられている要素を取得する
  var active_element = document.activeElement;

  // 出力テスト
  console.log(active_element);
  if ((document.getElementById("keyControl").checked) && (AnswerShown)//キー操作にチェックがあり
  && (document.activeElement.id == "textareas2")//解答欄がアクティブであり
  && (document.getElementById("answerByMyself").checked)) {//解答入力にチェックがあるとき
    // console.log('event.keyCode is ' + event.keyCode);
    // console.log('event.key is ' + event.key);
    whichKey1()
  }else if((document.getElementById("keyControl").checked) //キー操作にチェックがあり
  && (!document.getElementById("answerByMyself").checked)//解答入力にチェックがあり
  && (document.activeElement.id != "textareas2")//解答欄がアクティブでなく
  && (document.activeElement.id != "textareas")//問題欄がアクティブでなく
  && (document.activeElement.id != "criteria1")//基準欄がアクティブでなく
  && (document.activeElement.id != "criteria2")
  && (document.activeElement.id != "criteria3")
  && (document.activeElement.id != "wordSearch")//検索欄がアクティブでなく
  && (document.activeElement.id != "information")//通信欄がアクティブでなく
  && (document.activeElement.id != "DB_name")){//データベース名欄がアクティブでないとき　⇒つまり文字入力しないでキー操作のみで学習するとき

    whichKey2()
  }
}

function whichKey1(){
  if ((event.ctrlKey)) {
    if (event.keyCode === 229){
        switch (event.code) {
          case "KeyE":
              sendRequest2();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyR":
              sendRequest2();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyQ":
              sendRequest();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyW":
              sendRequest();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyF":
              sendRequest3('good1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyD":
              sendRequest3('good2');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyS":
              sendRequest3('good3');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyA":
              sendRequest3('good4');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          
          case "KeyJ":
              sendRequest3('good1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyH":
              sendRequest3('good1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyV":
              sendRequest4('poor1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyB":
              sendRequest4('poor1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyN":
              sendRequest4('poor1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyC":
              sendRequest4('poor2');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyX":
              sendRequest4('poor3');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyZ":
              sendRequest4('poor4');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyM":
              readQuestion();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          default:
              ;
              break;
        }
    } else {
      switch (event.keyCode) {
        case 82:
          sendRequest2();
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 69:
          sendRequest2();
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 87:
          sendRequest();
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 81:
          sendRequest();
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 70:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 74:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 72:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 52:
          readAnswer()
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 68:
          sendRequest3('good2');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 83:
          sendRequest3('good3');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 65:
          sendRequest3('good4');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 86:
          sendRequest4('poor1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        // case 54:
          // sendRequest4('poor1');
          // event.keyCode = 0;
          // event.returnValue = false;
          // break;
        case 73:
          sendRequest4('poor1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 67:
          sendRequest4('poor2');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 88:
          sendRequest4('poor3');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 90:
          sendRequest4('poor4');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        
        default:
          ;
          break;
      }
    }
  }else if(event.keyCode === 219){
    sendRequest3('good1');
    event.keyCode = 0;
    event.returnValue = false;
  }else if(event.keyCode === 221){
    sendRequest4('poor1');
    event.keyCode = 0;
    event.returnValue = false;
  }
}
function whichKey2(){
  if (event.keyCode === 229 && event.keyCode != "ControlLeft"){
    switch (event.code) {
      case "KeyE":
          sendRequest2();
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyR":
          sendRequest2();
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyQ":
          sendRequest();
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyW":
          sendRequest();
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyF":
          sendRequest3('good1');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyD":
          sendRequest3('good2');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyS":
          sendRequest3('good3');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyA":
          sendRequest3('good4');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyV":
          sendRequest4('poor1');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyC":
          sendRequest4('poor2');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyX":
          sendRequest4('poor3');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyZ":
          sendRequest4('poor4');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;

      default:
          ;
          break;
    }
  } else {
    switch (event.keyCode) {
      case 82:
          sendRequest2();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 69:
          sendRequest2();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 87:
          sendRequest();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 81:
          sendRequest();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 70:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 74:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 72:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 68:
          sendRequest3('good2');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 83:
          sendRequest3('good3');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 65:
          sendRequest3('good4');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 86:
          sendRequest4('poor1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      // case 54:
      //     sendRequest4('poor1');
      //     event.keyCode = 0;
      //     event.returnValue = false;
      //     break;
      case 52:
          readAnswer()
          event.keyCode = 0;
          event.returnValue = false;
        break;
      case 73:
          sendRequest4('poor1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 67:
          sendRequest4('poor2');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 88:
          sendRequest4('poor3');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 90:
          sendRequest4('poor4');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 80:
          backQuestion();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      
      default:
          ;
          break;
    }
  }
}

async function settingSave(){
  // console.log('document.getElementById("fontresize").value is '+document.getElementById("fontresize").value);
  moji = document.mainform.DB_name.value + "^^" + 
  document.getElementById("MaxQuestionNumber").value + "^^" +
  document.getElementById("fontresize").value + "^^" +
  document.getElementById("autoSpeed").value + "^^" +
  document.getElementById("autoReading").value + "^^" +
  document.getElementById("jpSpeed").value + "^^" +
  document.getElementById("engSpeed").value + "^^" +
  document.getElementById("NOC").value + "^^" +
  document.getElementById("autoAnswer").value + "^^" +
  document.getElementById("qachange").checked + "^^" +
  document.getElementById("autoread").checked + "^^" +
  document.getElementById("keyControl").checked + "^^" +
  document.getElementById("answerByMyself").checked + "^^" +
  document.getElementById("randomOrNot").checked + "^^" +
  document.getElementById("backGround").value + "@@@@" +
  document.getElementById("fontSelect").value + "^^" + 
  document.getElementById("novelSelect").value + "^^" + 
  document.getElementById("novelSentenceNumber").value + "^^" + 
  document.getElementById("flexButton").checked + "^^" + 
  document.getElementById("blackCheck").checked;
  novelRowNum = Number(document.getElementById("novelSentenceNumber").value);
  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null)
  {
    var res = await myFetch( "../settingSave.php", "data=" + moji);
    // console.log('settingSave res is '+res);
  }


}
function parseStrToBoolean(str) {
  // 文字列を判定
  return (str == 'true') ? true : false;

}

var selectElement = document.getElementById("novelSelect");
var novels = "";　// 変数受け渡し。
novels = novels.split(",", -1);　// bb_csvをsplit()でカンマ区切り配列に再編成。
for(var i = 1; i < novels.length; i ++){
  var option = document.createElement("option");
  option.value = novels[i];
  option.innerText = novels[i];
  selectElement.appendChild(option);
}



var response = '';
response = response.split('^');
// console.log('response is '+response);
if (response[0]) {
  if (response[0]==="all"){
    document.getElementById("MaxQuestionNumber").value = "all"
  } else {
    document.getElementById("MaxQuestionNumber").value = Number(response[0]);
  }
}
// document.getElementById("MaxQuestionNumber").value = Number(response[0]);
if (response[1]) {
  document.getElementById("fontresize").value = response[1];
}
textareafontresize()
if (response[2]) {
  document.getElementById("autoSpeed").value =  Number(response[2]);
}
if (response[3]) {
  document.getElementById("autoReading").value = response[3];
  }
if (response[4]) {
  document.getElementById("jpSpeed").value = response[4];
}
if (response[5]) {
  document.getElementById("engSpeed").value = response[5];
}
// console.log('document.getElementById("engSpeed").value is ' + document.getElementById("engSpeed").value);
if (response[6]) {
  document.getElementById("NOC").value = Number(response[6]);
}
if (response[7]) {
  document.getElementById("autoAnswer").value = Number(response[7]);
}
document.getElementById("qachange").checked = parseStrToBoolean(response[8]);
document.getElementById("autoread").checked = parseStrToBoolean(response[9]);
document.getElementById("keyControl").checked = parseStrToBoolean(response[10]);
document.getElementById("answerByMyself").checked = parseStrToBoolean(response[11]);
document.getElementById("randomOrNot").checked = parseStrToBoolean(response[12]);
document.getElementById("flexButton").checked = parseStrToBoolean(response[18]);
if (response[13]) {  
response2 = response[13].split('@@@@');}
if (response2[0]) {
document.getElementById("backGround").value = response2[0];}
changeBG();
if (response2[1]) {
document.getElementById("fontSelect").value = response2[1];}
changeFont();
if (response[16]) {
document.getElementById("novelSelect").value = response[16];}
if (response[21]) {
  if (response[21]==='true'){
    document.getElementById("blackCheck").checked = true;
    turnBlack()
  } else{
    document.getElementById("blackCheck").checked = false;
  }
}

if (response[18]==="true") {
  QnAareaFlex();
}
if (response[20]) {
  if ((document.getElementById("novelSelect").value) && !(document.getElementById("novelSelect").value == "なし")){
    document.getElementById("novelSentenceNumber").value = response[20];
  }
}


function AnswerSent(code)
{
    //エンターキー押下なら
    if((13 === code) && (AnswerShown === false) && (document.getElementById("autoAnswer").value === "0")
    && (document.getElementById("answerByMyself").checked))
    {
        AnswerTypedFlag = true;
        sendRequest2();
    }
}
function getTodayNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate());
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m  + d;
  document.getElementById("criteria1").value = result;
}
function getYesterdayNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate()-1);
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m +  d;
  document.getElementById("criteria2").value = result;
}
function getThreeDaysAgoNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate()-3);
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m +  d;
  document.getElementById("criteria2").value = result;
}
function getAfterNdays(n){
   var dt = new Date();
   dt.setDate(dt.getDate()+n);
   return formatDate(dt);
}
function getAWeekAgoNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate()-7);
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m +  d;
  document.getElementById("criteria2").value = result;
}
function getAMonthAgoNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate()-31);
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m +  d;
  document.getElementById("criteria2").value = result;
  // var objDate = new Date();

  // objDate.setDate(objDate.getDate() - 1);
  // var result = String(objDate.getFullYear())+String(objDate.getMonth())+String(objDate.getDate())
  // console.log(objDate.getFullYear())
  // console.log(objDate.getMonth())
  // console.log(objDate.getDate())
  document.getElementById("criteria2").value = result;
}
function getFirstDayFunc()
{
  document.getElementById("criteria2").value ="20010101";
}

var base = 60;

var key =  ["C","C#","D","E♭","E","F","F#","G","A♭","A","B♭","B"];

var chordname={"△":"100010010000",
"maj":"100010010000",
"m":"100100010000",
"dim":"100100100000",
"aug":"100010001000",
"△7":"100010010001",
"maj7":"100010010001",
"m7":"100100010010",
"7":"100010010010",
"dim7":"100100100100",
"m7♭5":"100100100010",
"minmaj7":"100100010001",
"6":"100010010100",
"m6":"100100010100",
"9":"100010010010001",
"maj9":"101010010001",
"m9":"101100010010",
"sus2":"101000010000",
"sus4":"100001010000",
"7b9":"10001001001001",
"7s9":"100110010010",
"7s11":"100010110010",
"7b13":"100010011010",
"7sus4":"100001010010",
"aug7":"100010001010",
"maj7s11":"100010110001",
"7#5":"100010001010",
"m#5":"100100001000",
"7b5":"100010100010"};

function getNote(_chordname){
  j=0;
  note=[];
  for(i=0;i<12;i++){
    j = chordname[_chordname].indexOf("1",j);
    if(j == -1){break;}
    note[note.length]=j;
    j=j+1;
  }
  return note;
};

function getMIDI(chord){
  if (chord.substr(1,3) === "sus") {
    _key=chord.substr(0,1);
    _chordname=chord.substr(1);
  } else if (chord.substr(2,3) === "sus") {
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else if (chord.substr(1,1) === "s"){
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else if (chord.substr(1,1) === "#"){
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else if (chord.substr(1,1) === "b"){
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else if (chord.substr(1,1) === "♭"){
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else {
    _key=chord.substr(0,1);
    _chordname=chord.substr(1);
  }
  if (_chordname===""){_chordname="maj"};
  if (_key==="G♭"){_key==="F#"};
  if (_key==="D♭"){_key==="C#"};
  if (_key==="A#"){_key==="B♭"};
  if (_key==="Gb"){_key==="F#"};
  if (_key==="Db"){_key==="C#"};
  if (_key==="As"){_key==="B♭"};
  if (_key==="Fs"){_key==="F#"};
  if (_key==="Cs"){_key==="C#"};

  root = base + key.indexOf(_key);
  note= getNote(_chordname);
  midi=[];
  for(i=0;i<note.length;i++){
      midi[i]=root+note[i];
  }
  return midi;
};

function playMIDI(midi){
    MIDI.loadPlugin({
        soundfontUrl: "./soundfont/",
        instrument: "acoustic_grand_piano",
        onprogress: function(state, progress) {
            console.log(state, progress);
        },
        onsuccess: function() {
            var delay = 0; // play one note every quarter second
            var velocity = 127; // how hard the note hits
            // play the note
            MIDI.setVolume(0, 127);
            for(i=0;i<midi.length;i++){
                for(j=0;j<midi[i].length;j++){
                    MIDI.noteOn(0, midi[i][j], velocity, delay);
                    MIDI.noteOff(0, midi[i][j], delay + 0.75);
                }
                delay = delay +1;
            }
        }
    });
    return "";
};

function playChords(chords){
    _chords=chords.split(/\r\n|\r|\n| |,/);//改行コードもしくは空白もしくはカンマ
    console.log(_chords);
    //_chords = chords.split(" ");
    _midi = []
    for(_c in _chords){
        if(_chords[_c].length==0){continue;}
        _midi[_midi.length]=getMIDI(_chords[_c]);
    }
    playMIDI(_midi);
}

var music = new Audio();
var music2 = new Audio();
var musicFlag = false;
var rres;
var musicDuration ="";
function init(res) {
  rres = res;
  music.preload = "auto";
  music.src = "./mp3/" + res;
  music.load();
  music2.preload = "auto";
  music2.src = "./mp3/" + res;
  music2.load();

  music.addEventListener('loadedmetadata',function(e) {
      console.log(music.duration); // 総時間の取得
      musicDuration = music.duration

  });

  music.addEventListener('pause',function(e) {
  console.log("pause!");
  music.currentTime = 0;


  var isPlaying = music.currentTime > 0 && !music.paused && !music.ended
      && music.readyState > 2;

  if (!isPlaying) {
    music.src = "./mp3/" + res + "#t=0," + String(musicDuration - Number(document.getElementById("mp3StartPoint").value));
    setTimeout(function() {
        music.playbackRate = document.getElementById("mp3Speed").value;
      music.play();
      var musicFlag = true;
    }, 0);
    }

  });

}

var timeout_id = null;

function play() {
  // music.loop = true;


  // music.currentTime = Number(document.getElementById("mp3StartPoint").value);
  music.playbackRate = document.getElementById("mp3Speed").value;
  music.play();
  var musicFlag = true;
  // timeout_id =setTimeout("play();", musicDuration- Number(document.getElementById("mp3StartPoint").value));

  // timeout_id =setTimeout("play();", 3000);
}



function stop() {
  music.pause();
  // music2.pause();
  // music.currentTime = Number(document.getElementById("mp3StartPoint").value);
  // setTimeout() メソッドの動作をキャンセルする
clearTimeout(timeout_id);
timeout_id = null;
}


function imageSizeChange1(){
  imageSize = document.getElementById("imageSize1").value;
  document.getElementById("mypic1").style.width = imageWidth1 * Number(imageSize) + "px";  // 横幅を400pxにリサイズ
  document.getElementById("mypic1").style.height = imageHeight1 * Number(imageSize) + "px";  // 横幅を400pxにリサイズ
}


function imageSizeChange2(){
  imageSize = document.getElementById("imageSize2").value;
  document.getElementById("mypic2").style.width = imageWidth2 * Number(imageSize) + "px";  // 横幅を400pxにリサイズ
  document.getElementById("mypic2").style.height = imageHeight2 * Number(imageSize) + "px";  // 横幅を400pxにリサイズ
}
async function informationChange(){
  var moji=  document.mainform.DB_name.value + "^" + document.mainform.information.value;
  moji = encodeURIComponent(moji);

  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null)
  {
      var res = await myFetch( "../informationChange.php", "data=" + moji);

  }
}

function changeBG(wIMG) {
  var wIMG = document.getElementById("backGround").value;
  document.body.style.backgroundImage = "url(./bg/" + wIMG + ")";///////////////////
}

function　changeFont(){
  var elements = document.getElementsByClassName('textlines');
  for(i=0;i<elements.length;i++){
    elements[i].style.fontFamily = document.getElementById("fontSelect").value;;
  }
}

function newOnesFunc(){

}
//音声読み上げ
const answerText2        = document.querySelector('#textareas2')
const questionText2        = document.querySelector('#textareas')
const voiceSelect = document.querySelector('#voice-select')
const speakBtn    = document.querySelector('#speak-btn')
var readVoices = new Array();
var readVoiceJp ="";
var readVoiceEng ="";

// selectタグの中身を声の名前が入ったoptionタグで埋める
function appendVoices() {
  // ①　使える声の配列を取得
  // 配列の中身は SpeechSynthesisVoice オブジェクト
  const voices = speechSynthesis.getVoices()
  voices.forEach(voice => { //　アロー関数 (ES6)
    // 日本語と英語以外の声は選択肢に追加しない。
    if(!voice.lang.match('ja|en-US')) return
    readVoices.push(voice.name);
  });
  // alert(readVoices);
  var voiceNum =0;
  readVoices.forEach( function( item ) {
    if (item.includes('ja') || item.includes('Ja')|| item.includes('Kyoko')) {
      if(!readVoiceJp){readVoiceJp = voiceNum};
    }
    if (item.includes('en') || item.includes('En')|| item.includes('Samantha')) {
      if(!readVoiceEng){readVoiceEng = voiceNum;}
    }
    voiceNum += 1;
  });
  // alert(readVoices);
}

appendVoices()

// // ② 使える声が追加されたときに着火するイベントハンドラ。
// // Chrome は非同期に(一個ずつ)声を読み込むため必要。
speechSynthesis.onvoiceschanged = e => {
  appendVoices();
}



    // Execute loadVoices.
    






var novelRowNum = 1;
if (document.getElementById("novelSentenceNumber").value) {
  novelRowNum = Number(document.getElementById("novelSentenceNumber").value);
}
    

async function getNovelSentence(){
  var moji=document.mainform.DB_name.value + "." + Number(novelRowNum) + "." + 
  document.mainform.novelSelect.value;
  moji = encodeURIComponent(moji);
  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null)
  {
      var res = await myFetch( "../getNovelSentence.php", "data=" + moji);
      document.getElementById("novel").innerHTML = res;
      document.getElementById("novelSentenceNumber").value = Number(novelRowNum);

  }
    
    
}
function  category1Change(){
  // var elem = document.querySelectorAll('select[name="category2"] option');
  // for(var i=0; i<elem.length; i++) {
  //   elem[i].selected = false;
  // }
  // var elem = document.querySelectorAll('select[name="category3"] option');
  // for(var i=0; i<elem.length; i++) {
  //   elem[i].selected = false;
  // }
  // var elem = document.querySelectorAll('select[name="category4"] option');
  // for(var i=0; i<elem.length; i++) {
  //   elem[i].selected = false;
  // }
  // var elem = document.querySelectorAll('select[name="category5"] option');
  // for(var i=0; i<elem.length; i++) {
  //   elem[i].selected = false;
  // }
}

function QnAareaFlex(){
  var mainform = document.getElementById("mainform");
  var Qarea = document.getElementById("textareas");
  var QareaImage = document.getElementById("div1");
  var Aarea = document.getElementById("textareas2");
  var AareaImage = document.getElementById("div2");
  var PrePosision = document.getElementById("questionbuttonbox");
  var ParentElement = document.getElementById("QandAwindow");
  if (QnAareaFlexFlug === false){
    Qarea.style.width= "42%"; 
    QareaImage.style.width= "42%";
    Qarea.style.height= "60vh"; 
    QareaImage.style.height= "62.5vh";
    Aarea.style.width= "42%"; 
    AareaImage.style.width= "42%"; 
    Aarea.style.height= "60vh"; 
    AareaImage.style.height= "62.5vh"; 
    Qarea.style.float = "left";
    QareaImage.style.float = "left";
    // AareaImage.style.float = "left";
    // Aarea.style.display= "flex"; 
    // AareaImage.style.display= "flex"; 
    if (AareaImage.style.display === "none"){
      AareaImage.style.display= "none";
    }
    ParentElement.insertBefore(AareaImage,QareaImage.nextSibling);
    ParentElement.insertBefore(Aarea,QareaImage.nextSibling);
    // document.getElementById("flexButton").checked = true;
    QnAareaFlexFlug = true;
  }else{
    Qarea.style.width= "97%";
    QareaImage.style.width= "97%"; 
    Qarea.style.height= "24vh"; 
    QareaImage.style.height= "27.5vh";
    Aarea.style.width= "97%"; 
    AareaImage.style.width= "97%";
    Aarea.style.height= "24vh"; 
    AareaImage.style.height= "27.5vh"; 
    // Aarea.style.display= "block"; 
    // AareaImage.style.display= "block"; 
    if (AareaImage.style.display === "none"){
      AareaImage.style.display= "none";
    }
    ParentElement.insertBefore(Aarea,PrePosision.nextSibling);
    ParentElement.insertBefore(AareaImage,Aarea.nextSibling);
    QnAareaFlexFlug = false;
    // document.getElementById("flexButton").checked = false;
  }
}
function blackOrWhite(){
  if (document.getElementById("blackCheck").checked){
    
    turnBlack();
  } else {
    turnWhite();
  }
}

function turnBlack(){

  var elements = document.getElementsByClassName('info02');
  for(i=0;i<elements.length;i++){
    // elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('textlines');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('button');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('selectBox');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('setting');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('checkText');
  for(i=0;i<elements.length;i++){
    elements[i].style.color = '#7a7a7a';
  }
  var wIMG = document.getElementById("backGround").value;
  document.body.style.backgroundImage = "url(./bg/" + "1701.png" + ")";
  document.getElementById("questionInfo").style.color = '#7a7a7a';
}
function turnWhite(){

  var elements = document.getElementsByClassName('info02');
  for(i=0;i<elements.length;i++){
    // elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('textlines');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#ffccff'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('button');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#EEEEEE'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('selectBox');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#EEEEEE'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('setting');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#e4fcff'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('checkText');
  for(i=0;i<elements.length;i++){
    elements[i].style.color = '#000000';
  }
  var wIMG = document.getElementById("backGround").value;
  document.body.style.backgroundImage = "url(./bg/" + response2[0] + ")";
  document.getElementById("questionInfo").style.color = '#000000';
}
function removeQuestion(){
  if (questionnumbers != ""){
    if (!firstRemoveFlag) {
    //  questionnumbers.splice(num, 1);
      correctQuestions.push(rand);
    } else {
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
    }
  }
}
function escape_html (string) {//HTMLエスケープ処理
  if(typeof string !== 'string') {
    return string;
  }
  return string.replace(/[&'`"<>]/g, function(match) {
    return {
      '&': '&amp;',
      "'": '&#x27;',
      '`': '&#x60;',
      '"': '&quot;',
      '<': '&lt;',
      '>': '&gt;',
    }[match]
  });
}


function resizeTextareas(){
  var width;
  var height;
  observer.disconnect();
  observer2.disconnect();

  if ( elementTextareas.style.width.match("%")) {//%が含まれているか
    // width=elementTextareas.style.width; 
    // height=elementTextareas.style.height; 
    width=Number(parseInt(elementTextareas.style.width))+Number(2); 
    width=width+"%"
    height=Number(parseInt(elementTextareas.style.height))+Number(2); 
    height=height+"vh"
  }else{
    width=Number(parseInt(elementTextareas.style.width))+Number(25); 
    width=width+"px"
    height=Number(parseInt(elementTextareas.style.height))+Number(25); 
    height=height+"px"
  }
  console.log("11  "+elementTextareas.style.width);
  console.log("12  "+ width);
  console.log("13  "+height);
  
  console.log("13.1  "+$('#div2').width());
  console.log("13.2  "+$('#div2').height());
  $('#textareas2').width(elementTextareas.style.width); 
  $('#textareas2').height(elementTextareas.style.height); 
  $('#div1').width(width); 
  $('#div1').height(height); 
  $('#div2').width(width); 
  $('#div2').height(height); 
  console.log("14  "+$('#div2').width());
  console.log("15  "+$('#div2').height());

  observer2.observe(elementTextareas2, options);
  observer.observe(elementTextareas, options);
}
document.addEventListener('keydown', function(event) {
    // Ctrlキーが押されているか、F12キーが押されているかを確認
    if (event.ctrlKey && event.key === 'F12') {
        readQuestion();
        event.preventDefault(); // デフォルトの動作をキャンセル
    }
});

