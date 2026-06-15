<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- shims -->
    <script src="./Basic.files/Base64.js" type="text/javascript"></script>
    <script src="./Basic.files/Base64binary.js" type="text/javascript"></script>
    <script src="./Basic.files/WebAudioAPI.js" type="text/javascript"></script>
    <!-- midi.js -->
    <script src="./Basic.files/audioDetect.js" type="text/javascript"></script>
    <script src="./Basic.files/gm.js" type="text/javascript"></script>
    <script src="./Basic.files/loader.js" type="text/javascript"></script>
    <script src="./Basic.files/plugin.audiotag.js" type="text/javascript"></script>
    <script src="./Basic.files/plugin.webaudio.js" type="text/javascript"></script>
    <script src="./Basic.files/plugin.webmidi.js" type="text/javascript"></script>
    <!-- utils -->
    <script src="./Basic.files/dom_request_xhr.js" type="text/javascript"></script>
    <script src="./Basic.files/dom_request_script.js" type="text/javascript"></script>
</head>
<body>
<script>

var base = 60;

var key =  ["C","Cs","D","Eb","E","F","Fs","G","Ab","A","Bb","B"];

var chordname={"maj":"100010010000",
"m":"100100010000",
"dim":"100100100000",
"aug":"100010001000",
"maj7":"100010010001",
"m7":"100100010010",
"7":"100010010010",
"dim":"100100100100",
"m7b5":"100100100010",
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
    } else if (chord.substr(1,1) === "b"){
      _key=chord.substr(0,2);
      _chordname=chord.substr(2);
    } else {
      _key=chord.substr(0,1);
      _chordname=chord.substr(1);
    }
    if (_chordname===""){_chordname="maj"}
    // c=chord.split(":");
    // _key=c[0];
    // _chordname="maj";
    // if(c.length==2){
    //     _chordname=c[1];
    // }

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

</script>

<textarea id = "chordarea">Fmaj7 G7 Em7 Am</textarea><button onclick='playChords(document.getElementById("chordarea").value)' value="play">play</button>
</body></html>
