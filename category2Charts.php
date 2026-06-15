<!DOCTYPE html>
<html lang="ja">
<head>
  <title>Chart.js TEST</title>
  <meta charset="UTF-8">
</head>
<style type="text/css">
        body {background-color: #F0FFF0; }
</style>
<body>
  <a href="sample020.php">
      <font size="5" color="#FF0000">学習画面</font>
  </a>

  <a id="resultgraph" href="testJSCharts.php">
      <font size="5" color="#38a3ea">大カテゴリー</font>
  </a>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.js"></script>

  <p>
  <canvas id="myChart4"style="min-width: 400px; max-width: 1500px">お使いのブラウザはcanvasに対応していません。</canvas>
  <br>
  <br>
  <br>
  <canvas id="myChart3"style="min-width: 400px; max-width: 1500px">お使いのブラウザはcanvasに対応していません。</canvas>
  <br>
  <br>
  <br>
  <canvas id="myChart2"style="min-width: 400px; max-width: 1500px">お使いのブラウザはcanvasに対応していません。</canvas>
  <br>
  <br>
  <br>

  <canvas id="myChart5"style="min-width: 400px; max-width: 1500px">お使いのブラウザはcanvasに対応していません。</canvas>
  <br>
  <br>
  <br>
  <canvas id="myChart"style="min-width: 400px; max-width: 1500px">お使いのブラウザはcanvasに対応していません。</canvas>
  </p>

  <script>
    // var labels = new Array('', '', '');
    var gotcategory1 = "";
    var gotcategory1_2 = "";
    var gotover50 ="";
    var gotUnder50 ="";
    var got0 ="";

    var DatabaseName = location.search.substring(1);
    document.getElementById("resultgraph").href += "?"+DatabaseName;
    // console.log('location.search is '+location.search);
    // console.log('DatabaseName is '+ DatabaseName);

    var moji= DatabaseName
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        // console.log(`1`);
        xmlhttp.open("POST", "../getChartDataCategory2.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        // console.log('testJSCharts data is '+data);
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        // console.log('getChartData is '+res);
        gotcategory1 = res;//.split('^');
        gotcategory1_2 = res.split('^');
    }

    var moji= DatabaseName　+ "^" + gotcategory1
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../getChartDataOver50Category2.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        // console.log('testJSCharts data is '+data);
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        // console.log('testJSCharts getChartDataOver50 is '+res);
        gotover50 = res.split('^');
    }

    var moji= DatabaseName　+ "^" + gotcategory1
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../getChartDataUnder50Category2.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        // console.log('testJSCharts data is '+data);
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        // console.log('testJSCharts getChartDataUnder50 is '+res);
        gotUnder50 = res.split('^');
    }

    var moji= DatabaseName　+ "^" + gotcategory1
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../getChartData0Category2.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        // console.log('testJSCharts data is '+data);
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        // console.log('testJSCharts getChartData0 is '+res);
        got0 = res.split('^');
    }

    var moji= DatabaseName　+ "^" + gotcategory1
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {

        xmlhttp.open("POST", "../getChartDataCorrectCategory2.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        // console.log('testJSCharts data is '+data);
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        // console.log('testJSCharts116 res2 is '+res);
        gotcorrect = res.split('^');
          // console.log(`gotcorrect is `);
          // console.log(gotcorrect);
    }

    var moji= DatabaseName　+ "^" + gotcategory1
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {

        xmlhttp.open("POST", "../getChartDataIncorrectCategory2.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        // console.log('testJSCharts data is '+data);
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        // console.log('testJSCharts res2 is '+res);
        gotincorrect = res.split('^');
    }

    var moji= DatabaseName　+ "^" + gotcategory1
    // console.log('JScharts 141 moji is ' + moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {

        xmlhttp.open("POST", "../getChartLevelCategory2.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        // console.log('getChartLevel data is '+data);
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        // console.log('151 getChartLevel res2 is '+res);
        var gotlevels = res.split(',');
        // console.log('154 gotlevels is ' + gotlevels);

    }
    var gotlevels2 = new Array ();
    for (let i = 0; i < gotlevels.length; i++) {
      gotlevels2[i] = gotlevels[i].split('^');
    }
    // console.log('161 gotlevels2[0] is '+ gotlevels2[0] );

    var levelzero = Array ();
    for (let i = 0; i < gotlevels.length; i++) {
      levelzero[i] = gotlevels2[i][0];
      // console.log('levelzero is ' + levelzero[i]);
    }
    var level1 = Array ();
    for (let i = 0; i < gotlevels.length; i++) {
      level1[i] = gotlevels2[i][1];
      // console.log('levelzero is ' + levelzero[i]);
    }
    var level2 = Array ();
    for (let i = 0; i < gotlevels.length; i++) {
      level2[i] = gotlevels2[i][2];
      // console.log('levelzero is ' + levelzero[i]);
    }
    var level3 = Array ();
    for (let i = 0; i < gotlevels.length; i++) {
      level3[i] = gotlevels2[i][3];
      // console.log('levelzero is ' + levelzero[i]);
    }
    var level4 = Array ();
    for (let i = 0; i < gotlevels.length; i++) {
      level4[i] = gotlevels2[i][4];
      // console.log('levelzero is ' + levelzero[i]);
    }
    var level5 = Array ();
    for (let i = 0; i < gotlevels.length; i++) {
      level5[i] = gotlevels2[i][5];
      // console.log('levelzero is ' + levelzero[i]);
    }


    var gotcategory_cnt = new Array ();
    for (let i = 0; i < gotcategory1_2.length; i++) {
      gotcategory_cnt[i] = Number(gotover50[i])+Number(gotUnder50[i])+Number(got0[i]);
      // console.log('gotcategory_cnt is ' + gotcategory_cnt[i] );
    }
    // console.log('gotcategory_cnt is ' + gotcategory_cnt );

    var gotover50_2 = new Array ();
    for (let i = 0; i < gotcategory1_2.length; i++) {
      gotover50_2[i] = Math.round(Number(gotover50[i])/gotcategory_cnt[i]*10000)/100 ;
      // console.log('gotover50_2 is ' + gotover50_2[i] );
      // console.log(gotover50[i]);
      // console.log(Number(gotover50[i]));
      // console.log(Number(gotover50[i]*100));
    }
    // console.log('gotover50_2 is ' + gotover50_2);

	  var gotUnder50_2 = new Array ();
    for (let i = 0; i < gotcategory1_2.length; i++) {
      gotUnder50_2[i] = Math.round(Number(gotUnder50[i])/gotcategory_cnt[i]*10000)/100 ;
      // console.log('gotover50_2 is ' + gotover50_2[i] );
    }
    // console.log('gotUnder50_2 is ' + gotUnder50_2);

    var got0_2 = new Array ();
    for (let i = 0; i < gotcategory1_2.length; i++) {
      got0_2[i] = Math.round(Number(got0[i])/gotcategory_cnt[i]*10000)/100 ;
      // console.log('gotover50_2 is ' + gotover50_2[i] );
    }
    // console.log('gotUnder50_2 is ' + got0_2);

    var moji= DatabaseName　+ "^" + gotcategory1
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../getChartPoorCategory2.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        // console.log('getChartPoor res is '+res);
        var gotpoors = res.split(',');
        // console.log('gotpoors is ' + gotpoors);

    }
    var gotpoors2 = new Array ();
    for (let i = 0; i < gotpoors.length; i++) {
      gotpoors2[i] = gotpoors[i].split('^');
    }
    // console.log('gotpoors2[1] is ' + gotpoors2[1]);
    var poor4 = Array ();
    for (let i = 0; i < gotpoors.length; i++) {
      poor4[i] = gotpoors2[i][7];
    }
    // console.log('poor4 is ' + poor4);
    var poor3 = Array ();
    for (let i = 0; i < gotpoors.length; i++) {
      poor3[i] = gotpoors2[i][6];
    }
    // console.log('poor3 is ' + poor3);
    var poor2 = Array ();
    for (let i = 0; i < gotpoors.length; i++) {
      poor2[i] = gotpoors2[i][5];
    }
    // console.log('poor2 is ' + poor2);
    var poor1 = Array ();
    for (let i = 0; i < gotpoors.length; i++) {
      poor1[i] = gotpoors2[i][4];
    }
    // console.log('poor1 is ' + poor1);
    var good1 = Array ();
    for (let i = 0; i < gotpoors.length; i++) {
      good1[i] = gotpoors2[i][3];
    }
    var good2 = Array ();
    for (let i = 0; i < gotpoors.length; i++) {
      good2[i] = gotpoors2[i][2];
    }
    var good3 = Array ();
    for (let i = 0; i < gotpoors.length; i++) {
      good3[i] = gotpoors2[i][1];
    }
    var good4 = Array ();
    for (let i = 0; i < gotpoors.length; i++) {
      good4[i] = gotpoors2[i][0];
    }
    var noPoorGood = Array ();
    for (let i = 0; i < gotpoors.length; i++) {
      noPoorGood[i] = gotpoors2[i][8];
    }

    var ctx3 = document.getElementById("myChart3");
      var myChart3 = new Chart(ctx3, {
          type: 'bar',
          data: {
              labels: gotcategory1_2,
              datasets: [{
                  label: "level5",
                  borderWidth:1,
                  backgroundColor: "#21ffff",
                  borderColor: "#21ffff",
                  data: level5
              },
               {
                  label: "level4",
                  borderWidth:1,
                  backgroundColor: "#20d2ff",
                  borderColor: "#20d2ff",
                  data: level4
              },
               {
                 label: "level3",
                 borderWidth:1,
                 backgroundColor: "#20a2ff",
                 borderColor: "#20a2ff",
                 data: level3
              },
               {
                  label: "level2",
                  borderWidth:1,
                  backgroundColor: "#627fd6",
                  borderColor: "#627fd6",
                  data: level2
              },
               {
                 label: "level1",
                 borderWidth:1,
                 backgroundColor: "#1d3681",
                 borderColor: "#1d3681",
                 data: level1
             },
             {
               label: "levelzero",
               borderWidth:1,
               backgroundColor: "#deefef",
               borderColor: "#deefef",
               data: levelzero
           }]

          },
          options: {
              title: {
                  display: true,
                  text: 'レベル', //グラフの見出し
                  fontSize: 30,
                  padding:3
              },
              scales: {
                  xAxes: [{
                        stacked: true, //積み上げ棒グラフにする設定
                        categoryPercentage:0.4 //棒グラフの太さ
                  }],
                  yAxes: [{
                        stacked: true //積み上げ棒グラフにする設定
                  }]
              },
              legend: {
                  labels: {
                        boxWidth:30,
                        padding:20 //凡例の各要素間の距離
                  },
                  display: true
              },
              tooltips:{
                mode:'label' //マウスオーバー時に表示されるtooltip
              }
          }
      });


    var ctx2 = document.getElementById("myChart2");
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: gotcategory1_2,
            datasets: [{
                label: "正解3回以上で正解率81%以上",
                borderWidth:1,
                backgroundColor: "#4beded",
                borderColor: "#4beded",
                data: gotover50_2
            },
             {
                label: "正解3回未満か正解率80%以下",
                borderWidth:1,
                backgroundColor: "#1d3681",
                borderColor: "#1d3681",
                data: gotUnder50_2
            },{
                label: "未回答",
                borderWidth:1,
                backgroundColor: "#deefef",
                borderColor: "#deefef",
                data: got0_2
            }]

        },
        options: {
            title: {
                display: true,
                text: '比率', //グラフの見出し
                fontSize: 30,
                padding:3
            },
            scales: {
                xAxes: [{
                      stacked: true, //積み上げ棒グラフにする設定
                      categoryPercentage:0.4 //棒グラフの太さ
                }],
                yAxes: [{
                      stacked: true //積み上げ棒グラフにする設定
                }]
            },
            legend: {
                labels: {
                      boxWidth:30,
                      padding:20 //凡例の各要素間の距離
                },
                display: true
            },
            tooltips:{
              mode:'label' //マウスオーバー時に表示されるtooltip
            }
        }
    });

    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: gotcategory1_2,
            datasets: [{
                label: "正解3回以上で正解率81%以上",
                borderWidth:1,
                backgroundColor: "#4beded",
                borderColor: "#4beded",
                data: gotover50
            },
             {
                label: "正解3回未満か正解率80%以下",
                borderWidth:1,
                backgroundColor: "#1d3681",
                borderColor: "#1d3681",
                data: gotUnder50
            },{
                label: "未回答",
                borderWidth:1,
                backgroundColor: "#deefef",
                borderColor: "#deefef",
                data: got0
            }]

        },
        options: {
            title: {
                display: true,
                text: '集計', //グラフの見出し
                fontSize: 30,
                padding:3
            },
            scales: {
                xAxes: [{
                      stacked: true, //積み上げ棒グラフにする設定
                      categoryPercentage:0.4 //棒グラフの太さ
                }],
                yAxes: [{
                      stacked: true //積み上げ棒グラフにする設定
                }]
            },
            legend: {
                labels: {
                      boxWidth:30,
                      padding:20 //凡例の各要素間の距離
                },
                display: true
            },
            tooltips:{
              mode:'label' //マウスオーバー時に表示されるtooltip
            }
        }
    });









    function createXmlHttpRequest()
    {
        var xmlhttp=null;

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
    var now = new Date();
    var yesterdays = new Array();
    for (let i = 0; i < 31; i++) {
      yesterdays[i] = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 30 + i);
      yesterdays[i] = formatDate(yesterdays[i], 'YYYYMMDD');
    }
    // console.log('yesterdays is ' + yesterdays);

    var yesterdays2 = yesterdays.join('^');

    var gotcorrectdays = new Array();
    var moji= DatabaseName　+ "^" + yesterdays2;
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../getChartDataCorrectDays.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        // console.log('testJSCharts data is '+data);
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        console.log('getChartDataCorrectDays is '+res);
        gotcorrectdays = res.split('^');
    }

    var gotincorrectdays = new Array();
    var moji= DatabaseName　+ "^" + yesterdays2;
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../getChartDataIncorrectDays.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        // console.log('testJSCharts data is '+data);
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        // console.log('testJSCharts res403 is '+res);
        gotincorrectdays = res.split('^');
      //     console.log(`gotcategory1 is `);
      //     console.log(gotcategory1);
    }

    var ctx4 = document.getElementById("myChart4");
      var myChart4 = new Chart(ctx4, {
          type: 'line',
          data: {
              labels: yesterdays,
              datasets: [{
                  label: "正解数",
                  fontSize: 25 ,
                  borderWidth:1,
          //背景色
		          backgroundColor: "rgba(75,192,192,0.4)",
		          //枠線の色
		          borderColor: "rgba(75,192,192,1)",
                  data: gotcorrectdays
              },
               {
                  label: "不正解数",
                  fontSize: 25 ,
                  borderWidth:1,
          //背景色
		          backgroundColor: "rgba(75,192,90,0.4)",
		          //枠線の色
		          borderColor: "rgba(75,192,90,1)",
                  data: gotincorrectdays
              }]

          },
          options: {
              title: {
                  display: true,
                  text: '過去60日間', //グラフの見出し
                  fontSize: 30,
                  padding:3
              },
              scales: {
                  xAxes: [{
                        stacked: true, //積み上げ棒グラフにする設定
                        categoryPercentage:0.4 //棒グラフの太さ
                  }],
                  yAxes: [{
                        stacked: true //積み上げ棒グラフにする設定
                  }]
              },
              legend: {
                  labels: {
                        boxWidth:30,
                        padding:20 //凡例の各要素間の距離
                  },
                  display: true
              },
              tooltips:{
                mode:'label' //マウスオーバー時に表示されるtooltip
              }
          }
      });

      var ctx5 = document.getElementById("myChart5");
        var myChart5 = new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: gotcategory1_2,
                datasets: [{
                    label: "☆☆☆☆",
                    borderWidth:1,
                    backgroundColor: "#21ffff",
                    borderColor: "#21ffff",
                    data: good4
                },
                 {
                    label: "☆☆☆",
                    borderWidth:1,
                    backgroundColor: "#20d2ff",
                    borderColor: "#20d2ff",
                    data: good3
                },
                 {
                   label: "☆☆",
                   borderWidth:1,
                   backgroundColor: "#20a2ff",
                   borderColor: "#20a2ff",
                   data: good2
                },
                 {
                    label: "☆",
                    borderWidth:1,
                    backgroundColor: "#627fd6",
                    borderColor: "#627fd6",
                    data: good1
                },
                 {
                   label: "×",
                   borderWidth:1,
                   backgroundColor: "#4569d6",
                   borderColor: "#4569d6",
                   data: poor1
               },
               {
                 label: "××",
                 borderWidth:1,
                 backgroundColor: "#2d50ba",
                 borderColor: "#2d50ba",
                 data: poor2
               },
               {
                 label: "×××",
                 borderWidth:1,
                 backgroundColor: "#1d3b96",
                 borderColor: "#1d3b96",
                 data: poor3
               },
               {
                 label: "××××",
                 borderWidth:1,
                 backgroundColor: "#0e2261",
                 borderColor: "#0e2261",
                 data: poor4
               },
               {
                 label: "なし",
                 borderWidth:1,
                 backgroundColor: "#deefef",
                 borderColor: "#deefef",
                 data: noPoorGood
             }]

            },
            options: {
                title: {
                    display: true,
                    text: '達成度', //グラフの見出し
                    fontSize: 30,
                    padding:3
                },
                scales: {
                    xAxes: [{
                          stacked: true, //積み上げ棒グラフにする設定
                          categoryPercentage:0.4 //棒グラフの太さ
                    }],
                    yAxes: [{
                          stacked: true //積み上げ棒グラフにする設定
                    }]
                },
                legend: {
                    labels: {
                          boxWidth:30,
                          padding:20 //凡例の各要素間の距離
                    },
                    display: true
                },
                tooltips:{
                  mode:'label' //マウスオーバー時に表示されるtooltip
                }
            }
        });

  </script>
</body>
</html>
