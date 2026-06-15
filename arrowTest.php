<!DOCTYPE html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/leader-line@1.0.1/leader-line.min.js"></script>
    <style type="text/css">
        html{
            margin: auto;
        }
        .main_comment{
            display: inline-block;
        }
        .comments{
            display: inline-block;
        }
        .main_comment{
            width: auto;
            margin: 5rem;
            border: 5px solid tomato;
        }
        .comment{
            width: auto;
            margin: 1rem;
            border: 5px solid turquoise
        }
        </style>
</head>
<body>
    <div class="map">
        <div class="main_comment" id="mc1">メインコメント</div>
        <div class="comments">
            <div class="comment" id="c1">コメント１</div>
            <div class="comment" id="c2">コメント２</div>
        </div>
        <div class="main_comment" id="mc2">メインコメント</div>
        <div class="comments">
            <div class="comment" id="c3">コメント１</div>
            <div class="comment" id="c4">コメント２</div>
        </div>
        <input class ="button" type="checkbox" id="arrowButton" value="矢印" onclick='showArrows()' style="font-size: 20px;margin:2vh 0px 0px 2vh">
    </div>
    <script>

    function showArrows() {
        new LeaderLine(
            document.getElementById("mc1"),
            document.getElementById("c4")
            );
        new LeaderLine(
            document.getElementById("mc2"),
            document.getElementById("c2")
        )
    }
    </script>
</body>