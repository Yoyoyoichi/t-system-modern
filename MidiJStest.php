<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- shims -->
    <script src="./Basic_files/Base64.js" type="text/javascript"></script>
    <script src="./Basic_files/Base64binary.js" type="text/javascript"></script>
    <script src="./Basic_files/WebAudioAPI.js" type="text/javascript"></script>
    <!-- midi.js -->
    <script src="./Basic_files/audioDetect.js" type="text/javascript"></script>
    <script src="./Basic_files/gm.js" type="text/javascript"></script>
    <script src="./Basic_files/loader.js" type="text/javascript"></script>
    <script src="./Basic_files/plugin.audiotag.js" type="text/javascript"></script>
    <script src="./Basic_files/plugin.webaudio.js" type="text/javascript"></script>
    <script src="./Basic_files/plugin.webmidi.js" type="text/javascript"></script>
    <!-- utils -->
    <script src="./Basic_files/dom_request_xhr.js" type="text/javascript"></script>
    <script src="./Basic_files/dom_request_script.js" type="text/javascript"></script>
</head>
<body>
<script>

var base = 60;

var key =  ["C","C#","D","D#","E","F","F#","G","G#","A","A#","B"];

var chordname={"maj":"100010010000",
"min":"100100010000",
"dim":"100100100000",
"aug":"100010001000",
"maj7":"100010010001",
"min7":"100100010010",
"7":"100010010010",
"dim7":"100100100100",
"hdim7":"100100100010",
"minmaj7":"100100010001",
"6":"100010010100",
"min6":"100100010100",
"9":"101010010010",
"maj9":"101010010001",
"min9":"101100010010",
"sus2":"101000010000",
"sus4":"100001010000",
"7(b9)":"110010010010",
"7(#9)":"100110010010",
"7(#11)":"100010110010",
"7(b13)":"100010011010",
"7sus4":"100001010010",
"aug7":"100010001010",
"maj7(#11)":"100010110001",
"7(#5)":"100010001010",
"min(#5)":"100100001000",
"7(b5)":"100010100010"};

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
    c=chord.split(":");
    _key=c[0];
    _chordname="maj";
    if(c.length==2){
        _chordname=c[1];
    }

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

<textarea id = "chordarea">F:maj7 G:7 E:min7 A:min</textarea><button onclick='playChords(document.getElementById("chordarea").value)' value="play">play</button>
</body></html>
