<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>HTML5</title>
    </head>
    <style type="text/css">
    	textarea{font-size:50px; padding:5px;}
        .box {
            text-align: center;
            color: #FFF;
            width:100px;
            height:100px;
            margin-left:10px;
            line-height:100px;
            float:left;
            background-color:#999999;
            font-size: 50px;    /* 文字サイズ指定 */
            color: #000000;     /* 文字色指定 */
        }
        .padlabel{
        	font-size: 50px; 
        }
        #boxwrap08{
            position: relative;
            top:0px;
        }
        #boxwrap07{
            position: relative;
            top:10px;
        }
        #boxwrap06{
            position: relative;
            top:20px;
        }
        #boxwrap05{
            position: relative;
            top:30px;
        }
        #boxwrap04{
            position: relative;
            top:40px;
        }
        #boxwrap03{
            position: relative;
            top:50px;
        }
        #boxwrap02{
            position: relative;
            top:60px;
        }
        #boxwrap01{
            position: relative;
            top:70px;
        }
        .box_wrap {
            width:900px;
            height:auto;
            border:0px solid #000;
        }
        .clearfix:after {
          display: block;
          clear: both;
          content: "";
        }
        #b0{
            /* background-color:#ff6347; */
        }
    </style>
    <body>
        <br>
        <TEXTAREA id="textareas" style="width:600px;height:260px;" wrap="soft" style=" font-size:50px;"></TEXTAREA>
        <input type="button" name="botan01" id="button01" onClick="showScales();"value="Scales"
  		style="font-size: 25px">
        <div id = "scalepads">
        	<div id ="padlabel1" class = "padlabel"></div>
	        <div id="pad1" class ="pad">
				<div class="clearfix box_wrap" id ="boxwrap08">
					<div class="box b1"></div>
					<div class="box b2"></div>
					<div class="box b3"></div>
					<div class="box b4"></div>
					<div class="box b5"></div>
					<div class="box b6"></div>
					<div class="box b7"></div>
					<div class="box b8"></div>
				</div>

				<div class="clearfix box_wrap" id ="boxwrap07">
					<div class="box b8"></div>
					<div class="box b9"></div>
					<div class="box b10"></div>
					<div class="box b11"></div>
					<div class="box b0"></div>
					<div class="box b1"></div>
					<div class="box b2"></div>
					<div class="box b3"></div>
				</div>

				<div class="clearfix box_wrap" id ="boxwrap06">
					<div class="box b3"></div>
					<div class="box b4"></div>
					<div class="box b5"></div>
					<div class="box b6"></div>
					<div class="box b7"></div>
					<div class="box b8"></div>
					<div class="box b9"></div>
					<div class="box b10"></div>
				</div>

				<div class="clearfix box_wrap" id ="boxwrap05">
					<div class="box b11"></div>
					<div class="box b0"></div>
					<div class="box b1"></div>
					<div class="box b2"></div>
					<div class="box b3"></div>
					<div class="box b4"></div>
					<div class="box b5"></div>
					<div class="box b6"></div>
				</div>

				<div class="clearfix box_wrap" id ="boxwrap04">
					<div class="box b6"></div>
					<div class="box b7"></div>
					<div class="box b8"></div>
					<div class="box b9"></div>
					<div class="box b10"></div>
					<div class="box b11"></div>
					<div class="box b0"></div>
					<div class="box b1"></div>
				</div>

				<div class="clearfix box_wrap" id ="boxwrap03">
					<div class="box b1"></div>
					<div class="box b2"></div>
					<div class="box b3"></div>
					<div class="box b4"></div>
					<div class="box b5"></div>
					<div class="box b6"></div>
					<div class="box b7"></div>
					<div class="box b8"></div>
				</div>
				<div class="clearfix box_wrap" id ="boxwrap02">
					<div class="box b8"></div>
					<div class="box b9"></div>
					<div class="box b10"></div>
					<div class="box b11"></div>
					<div class="box b0"></div>
					<div class="box b1"></div>
					<div class="box b2"></div>
					<div class="box b3"></div>
				</div>
				<div class="clearfix box_wrap" id ="boxwrap01">
					<div class="box b3"></div>
					<div class="box b4"></div>
					<div class="box b5"></div>
					<div class="box b6"></div>
					<div class="box b7"></div>
					<div class="box b8"></div>
					<div class="box b9"></div>
					<div class="box b10"></div>
				</div>
				<br>
		        <br>
				<br>
				<br>
				<br>
		        <br>
				<br>
				<br>
			</div>

		</div>



    <?php

    ?>




    <script type="text/javascript">

	    function showScales(){
	    	
	    	deletetags ()

			var root = [];
			var scaleOrChord = [];
			var rootnumber =[];
			var scaleChordNumber =[];
			var padNumber ="";

			var chordProgaression = document.getElementById('textareas').value.replace(/\r?\n/g, '');
			chordProgaression = chordProgaression.split(',')



			//idが「boxes」の要素を取得
			// クローン生成


			for (let i = 0; i < chordProgaression.length-1; i++) {
				tpl   = document.getElementById('padlabel1');
			    clone = tpl.cloneNode(true);
			    // idとdisplayの設定
			    clone.id            = "padlabel"+(Number(i)+2);

			    clone.style.display = "inline";
			    // 表示
			    base = document.getElementById('scalepads')
			    base.appendChild(clone);  

				tpl2   = document.getElementById('pad1');
			    clone = tpl2.cloneNode(true);
			    // idとdisplayの設定
			    clone.id            = "pad"+(Number(i)+2);

			    clone.style.display = "inline";
			    // 表示
			    base = document.getElementById('scalepads')
			    base.appendChild(clone);  
			    // tpl2   = document.getElementById('pad'+i);
			} 

						// document.getElementById("padNumber") != null
			var elements = document.getElementsByClassName('box');
			for(i=0;i<elements.length;i++){
				elements[i].style.backgroundColor = "#EEEEEE";
			}
			// var box = "b" + 0
			// var elements = document.getElementsByClassName(box);
			// for(i=0;i<elements.length;i++){
			// 	elements[i].style.backgroundColor = "#FF22FF";
			// }
			// var elements = document.querySelectorAll('.b2,.b4,.b5,.b7,.b9,.b11');
			// console.log('elements.length is ' + elements.length);
			// for(i=0;i<elements.length;i++){
			// 	elements[i].style.backgroundColor = "#5D99FF";
			// }



			console.log('chordProgaression[0] is '+chordProgaression[0]);

			for (let i = 0; i < chordProgaression.length; i++) {
				var label = "padlabel"+(i+1).toString()
				var label2 = document.getElementById(label);
				console.log('chordProgaression[i] is '+chordProgaression[i]);
				label2.innerHTML= chordProgaression[i];

				console.log('chordProgaression[i] is '+chordProgaression[i]);
				console.log('chordProgaression[i].charAt(1） is '+chordProgaression[i].charAt(1));

				if (chordProgaression[i].charAt(1)== "b"){
					root[i] = chordProgaression[i].substring(0, 2);
					scaleOrChord[i] = chordProgaression[i].slice(2);
				} else if (chordProgaression[i].charAt(1)== "s"){
					root[i] = chordProgaression[i].substring(0, 2);
					scaleOrChord[i] = chordProgaression[i].slice(2);				
				} else {
					root[i] = chordProgaression[i].charAt(0);
					scaleOrChord[i] = chordProgaression[i].slice(1);
					// console.log(`!`);
				}

				switch (root[i]) {
					case 'C':
					  rootnumber[i] = 0;
					  break;
					case 'C#':
					case 'Cs':
					  rootnumber[i] = 1;
					  break;
					case 'D':
					  rootnumber[i] = 2;
					  break;
					case 'D#':
					case 'E♭':
					case 'Ds':
					case 'Eb':
					  rootnumber[i] = 3;
					  break;
					case 'E':
					  rootnumber[i] = 4;
					  break;
					case 'F':
					  rootnumber[i] = 5;
					  break;
					case 'Fs':
					case 'F#':
					  rootnumber[i] = 6;
					  break;
					case 'G':
					  rootnumber[i] = 7;
					  break;
					case 'Ab':
					case 'A♭':
					case 'Gs':
					case 'G#':
					  rootnumber[i] = 8;
					  break;
					case 'A':
					  rootnumber[i] = 9;
					  break;
					case 'A#':
					case 'Bb':
					case 'B♭':
					  rootnumber[i] = 10;
					  break;
					case 'B':
					  rootnumber[i] = 11;
					  break;
					default:
					  ;
					  break;
				}

				console.log('rootnumber is '+rootnumber);
				console.log('scaleOrChord[i] is '+scaleOrChord[i]);
				switch (scaleOrChord[i]) {
					case 'maj7s11':
					  scaleChordNumber[i] = [0,4,7,11,2,6];
					  break;
					case 'maj7':
					  scaleChordNumber[i] = [0,4,7,11];
					  break;					
					case '':
					  scaleChordNumber[i] = [0,4,7];
					  break;
					case 'm':
					  scaleChordNumber[i] = [0,3,7];
					  break;
					case 'm6':
					  scaleChordNumber[i] = [0,3,7,9];
					  break;
					case 'm7':
					  scaleChordNumber[i] = [0,3,7,10];
					  break;
					case 'm9':
					  scaleChordNumber[i] = [0,3,7,10,2];
					  break;
					case '7':
					  scaleChordNumber[i] = [0,4,7,10];
					  break;
					case '7b9':
					  scaleChordNumber[i] = [0,4,7,10,1];
					  break;
					case '7s9':
					  scaleChordNumber[i] = [0,4,7,10,3];
					  break;
					case '79':
					  scaleChordNumber[i] = [0,4,7,10,2];
					  break;
					case 'lyd7':
					  scaleChordNumber[i] = [0,2,4,6,7,9,10];
					  break;
					case 'm7b5':
					  scaleChordNumber[i] = [0,3,6,10];
					  break;
					case 'dim':
					  scaleChordNumber[i] = [0,3,6,9];
					  break;
					case 'majsc':
					  scaleChordNumber[i] = [0,2,4,5,7,9,11];
					  break;
					case 'msc':
					  scaleChordNumber[i] = [0,2,3,5,7,8,10];
					  break;
					case 'majp':
					  scaleChordNumber[i] = [0,2,4,7,9];
					  break;
					case 'mp':
					  scaleChordNumber[i] = [0,3,5,7,10];
					  break;
					case '9':
					  scaleChordNumber[i] = [0,4,7,11,2];
					  break;
					case '69':
					  scaleChordNumber[i] = [0,4,7,11,2,9];
					  break; 
					case 'alt':
					  scaleChordNumber[i] = [0,1,3,4,6,8,10];
					  break;
					default:
					  ;
					  break;
				}

				console.log('root is '+root);
				console.log('scaleOrChord is '+ scaleOrChord);

				console.log('scaleChordNumber[0] is '+scaleChordNumber[0]);
		      	console.log('scaleChordNumber[0][0] is '+scaleChordNumber[0][0]);
		      	var scaleChordNumber2 = [];
				for (let j = 0; j < scaleChordNumber[i].length; j++) {
					scaleChordNumber2[j] = parseInt(scaleChordNumber[i][j]) + parseInt(rootnumber[i]);
					if (scaleChordNumber2[j]>11) {
						scaleChordNumber2[j] = scaleChordNumber2[j] - 12;
					}
					console.log('caleChordNumber2[j] is '+scaleChordNumber2[j]);
				}

				console.log('scaleChordNumber2 is '+scaleChordNumber2);

				var whichPad = "pad"+(i+1);
				console.log('scaleChordNumber2.length is '+scaleChordNumber2.length);
				for (let j = 0; j < scaleChordNumber2.length; j++) {

					console.log('caleChordNumber2[j] is '+scaleChordNumber2[j]);
					var box = "b" + scaleChordNumber2[j]
					var elements = document.getElementById(whichPad);
					var elements = elements.getElementsByClassName(box);
					console.log('elements.length is ' + elements.length);
					for(k=0;k<elements.length;k++){
						console.log('scaleChordNumber[i][j] is '+scaleChordNumber[i][j]);
						// elements[k].innerHTML =　scaleChordNumber[i][j];
						var note = scaleChordNumber[i][j];

						switch (note) { 
						    case 0: 
						        elements[k].innerHTML ="➊"; 
						        break; 
						    case 1: 
						        elements[k].innerHTML ="⑨"; 
						        break; 
						    case 2: 
						        elements[k].innerHTML ="⑨"; 
						        break; 
						    case 3: 
						        if (scaleOrChord[i]=='m7b5') {
									elements[k].innerHTML ="❸";
								} else if (scaleOrChord[i]=='dim'){
									elements[k].innerHTML ="❸";
								} else if (scaleOrChord[i]=='m7'){
									elements[k].innerHTML ="❸";
								} else if (scaleOrChord[i]=='m79'){
									elements[k].innerHTML ="❸";
								} else if (scaleOrChord[i]=='m'){
									elements[k].innerHTML ="❸";
								} else if (scaleOrChord[i]=='m9'){
									elements[k].innerHTML ="❸";
								} else if (scaleOrChord[i]=='m6'){
									elements[k].innerHTML ="❸";
								} else if (scaleOrChord[i]=='msc'){
									elements[k].innerHTML ="❸";
								} else {
									elements[k].innerHTML ="⑨"; 
								}	
						        break; 
						    case 4: 
						        elements[k].innerHTML ="❸"; 
						        break; 
						    case 5: 
						        elements[k].innerHTML ="④"; 
						        break; 
						    case 6: 
						    	if (scaleOrChord[i]=='m7b5') {
									elements[k].innerHTML ="❺";
								} else if (scaleOrChord[i]=='dim'){
									elements[k].innerHTML ="❺";
								} else if (scaleOrChord[i]=='maj7s11'){
									elements[k].innerHTML ="⑪";
								} else {
									elements[k].innerHTML ="⑤"; 
								}						        
						        break; 
						    case 7: 
						        elements[k].innerHTML ="❺";
						        break; 
						    case 8: 
						        elements[k].innerHTML ="⑤"; 
						        break; 
						    case 9: 
						        if (scaleOrChord[i]=='dim'){
									elements[k].innerHTML ="❻";
								} else {
									elements[k].innerHTML ="⑥"; 
								}	
						        break; 
						    case 10: 
						        elements[k].innerHTML ="❼"; 
						        break; 
						    case 11: 
						        elements[k].innerHTML ="❼";
						    default: 
						        ; 
						    break; 
						}
						// switch (note) { 
						//     case 0: 
						//         elements[k].innerHTML ="○"; 
						//         break; 
						//     default: 
						//         elements[k].innerHTML ="●"; ; 
						//     	break; 
						// }

						// if (j==0) {
						// 	elements[k].innerHTML = "①";
						// } else if (j==1){
						// 	elements[k].innerHTML = "③";
						// } else if (j==2){
						// 	elements[k].innerHTML = "⑤";
						// } else if (j==3){
						// 	elements[k].innerHTML = "⑦";
						// }
						
					}
				}




			}
			console.log('root is '+root);
			console.log('scaleOrChord is '+ scaleOrChord);

			console.log('scaleChordNumber is '+scaleChordNumber);


		}

		function deletetags (){

			var elements = document.getElementsByClassName('pad');
			var length = elements.length
			for(i=1;i<length;i++){
				elements[1].parentNode.removeChild(elements[1]);
			}
			var elements2 = document.getElementsByClassName('box');
			var length2 = elements2.length
			for(i=0;i<length2;i++){
				elements2[i].innerHTML = "";
			}
			
			var elements3 = document.getElementsByClassName('padlabel');
			var length3 = elements3.length
			for(i=1;i<length3;i++){
				elements3[1].parentNode.removeChild(elements3[1]);
			}
		}
    </script>

    </body>
</html>
