<html>
<head>
<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="/abcjs-basic-min.js"></script>
<link rel="stylesheet" href="/abcjs-audio.css" media="all" type="text/css" />
<body>
<div id="abcjs-paper-1"></div>
<div id="abcjs-midi-1"></div>



<script>
// var note = [
// ',C',',D',',E',',F',',G',',A',',B',',^C',',^D',',^E',',^F',',^G',',^A',',^B',
// 'C','D','E','F','G','A','B','c','d','e','f','g','a','b','z',
// '^C','^D','^E','^F','^G','^A','^B','^c','^d','^e','^f','^g','^a','^b',
// ];
var note = [
'C','D','E','F','G','A','B',
'c','d','e','f','g','a','b'
]
var noteCc = [
// ',C',',^C',',D',',^D',',E',',F',',^F',',G',',^G',',A',',^A',',B',
'C','^C','D','^D','E','F','^F','G','^G','A','^A','B',
'c','^c','d','^d','e','f','^f','g','^g','a','^a','b'
];
var noteFc = [
',C',',Db',',D',',Eb',',E',',F',',Gb',',G',',Ab',',A',',B',',=B',
'C','Db','D','Eb','E','F','Gb','G','Ab','A','B','=B',
'c','db','d','eb','e','f','gb','g','ab','a','b','=b'
];
var total = 16;
var notes ="";
var note = note;

// for (let i = 0; i < total; i++) {
  var random = Math.floor(Math.random() * (note.length - 0 )) + 0;
  notes = notes + note[random];
//   if ((i + 1) % 4 ==0) {
//   	notes = notes + " |";
// 	}
// }
console.log(notes);
var noteNow = random;
for (let i = 2; i < total+1; i++) {
  var random = Math.floor(Math.random() * (100 - 1 )) + 1;
  console.log("random is " + random);
  if (random < 51){
	  if((random < 26)){
	  	if (noteNow < note.length){
	  		noteNow = noteNow + 1
	  	}else {
	  		noteNow = noteNow - 1
	   	}
	  }else{
	  	if (noteNow > 0){
	  		noteNow = noteNow - 1
	  	}else {
	  		noteNow = noteNow + 1
	   	}
	  }
   } else {
	  if((random < 76)){
	  	if (noteNow+2 < note.length){
	  		noteNow = noteNow + 2
	  	}else {
	  		noteNow = noteNow - 2
	   	}
	  }else{
	  	if (noteNow-2 > 0){
	  		noteNow = noteNow - 2
	  	}else {
	  		noteNow = noteNow + 2
	   	}
	  }   	
   }
  notes = notes + note[noteNow];
  console.log(notes);
  if (i  % 4 == 0) {
  	notes = notes + " |";
	}
}



(function(){
var params={responsive:"resize"};

var abc=`
X:1
T:
M:4/4
L:1/4
Q:1/4=100
K:C`;
abc=abc +"\n" + notes + " |";
// CDEF | EDCz| EFGA | GFEz |
// CzCz | CzCz | C/2C/2D/2D/2 E/2E/2F/2F/2 | EDCz |]



var visualObjs=ABCJS.renderAbc('abcjs-paper-1',abc,params);
var synthControl=new ABCJS.synth.SynthController();
var el=document.getElementById('abcjs-midi-1',null);
synthControl.load(el,null,{displayRestart:true,displayPlay:true,displayProgress:true});
synthControl.setTune(visualObjs[0],false);


}());
</script>
</body>
</html>