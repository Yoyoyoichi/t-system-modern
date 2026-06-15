<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
</head>
<style type="text/css">
</style>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="board.js"></script>
<script type="text/javascript">
   var chords = new Array (
    [ [ '' ], [ 0 ] ],
    [ [ 'M' ], [ 0, 4, 7 ] ],
    [ [ 'm' ], [ 0, 3, 7 ] ],
    [ [ 'M7' ], [ 0, 4, 7, 11 ] ],
    [ [ 'M9' ], [ 0, 4, 7, 11, 14 ] ],
    [ [ '7' ], [ 0, 4, 7, 10 ] ],
    [ [ 'm7' ], [ 0, 3, 7, 10 ] ],
    [ [ 'M(37)' ], [ 0, 4, 11 ] ],
    [ [ 'm(37)' ], [ 0, 3, 10 ] ],
    [ [ '7(37)' ], [ 0, 4, 10 ] ],
    [ [ 'dim(37)' ], [ 0, 3, 9 ] ],
    [ [ 'm9' ], [ 0, 3, 7, 10, 14 ] ],
    [ [ '9' ], [ 0, 4, 7, 10, 14 ] ],
    [ [ 'b9' ], [ 0, 4, 7, 10, 13 ] ],
    [ [ '6' ], [ 0, 4, 7, 9 ] ],
    [ [ 'm6' ], [ 0, 3, 7, 9 ] ],
    [ [ '69' ], [ 0, 4, 7, 9, 14 ] ],
    [ [ '11' ], [ 0, 4, 7, 10, 14, 17 ] ],
    [ [ 'm11' ], [ 0, 3, 7, 10, 14, 17 ] ],
    [ [ 'sus4' ], [ 0, 5, 7 ] ],
    [ [ '7sus4' ], [ 0, 5, 7, 10 ] ],
    [ [ 'm69' ], [ 0, 3, 7, 9, 14 ] ],
    [ [ 'm7b5' ], [ 0, 3, 6, 10 ] ],
    [ [ '7b9' ], [ 0, 4, 7, 10, 13 ] ],
    [ [ '7#9' ], [ 0, 4, 7, 10, 15 ] ],
    [ [ 'dim' ], [ 0, 3, 6 ] ],
    [ [ 'dim7' ], [ 0, 3, 6, 9 ] ]
 )
 test();
function test(){
  for (let i = 1; i < chords.length; i++) {
    var arr = new Array();
    arr[0] = 0;
    for (let j = 1; j < chords[j][1].length; j++) {
        // console.log(chords[j][1].length);
        arr[j] = Number(chords[i][1][j+1])-Number(chords[i][1][j]);
    }
    chords[i].push(arr)
  }
}

//chords[0].push([1,2,3])
// console.log(chords);
console.log(chords[1]);
console.log(chords[1][0]);
console.log(chords[1][1]);
console.log(chords[1][1][1]);

for (let j = 1; j < chords.length; j++) {
  console.log(chords[j][0]);
}

</script>
<?php
?>
</body>
</html>