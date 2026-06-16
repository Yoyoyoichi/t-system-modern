?var _MODE = (typeof window.ontouchstart == "undefined")? 'click' : 'touchstart';
var _MODE_HOVER = (typeof window.ontouchstart == "undefined")? 'mouseover' : 'touchstart';

// WYSIWYGクラス
class C_Editor
{
    constructor(id)
    {
        this.editor = this.Init(id);
        this.IconSet(id)
    }

    // Quill起動
    Init(id)
    {
        // 表の大きさ指定用（最大７ｘ７マス）
        var tableopt = []
        for (let r = 1; r <= 7; r++)
        {
            for (let c = 1; c <= 7; c++)
            {
                tableopt.push('newtable_' + r + '_' + c);
            }
        }

        // ツールバーに表示する機能
        var tb_opt = [
            // 見出し
            {'header': [1, 2, 3, false]},
            // 太字、斜体、下線、打消線
            'bold', 'italic', 'underline', 'strike',
            // 上／下付き文字
            {'script': 'super'}, {'script': 'sub'},
            // 文字色、文字背景色
            {'color': []}, {'background': []},
            // リスト
            {'list': 'ordered'}, {'list': 'bullet'},
            // 文字寄せ
            {'align': []},
            // インデント
            {'indent': '-1'}, {'indent': '+1'},
            // コードブロック(インラインコードのアイコンと区別がつかないのでコードブロックのみ)
            'code-block',
            // 数式
            'formula',
            // 表
            {'Table-Input': tableopt},
            //画像・動画挿入、URLリンク
            'image', 'video', 'link',
            // 装飾の削除
            'clean',
        ];

        var quill = new Quill(
                                document.getElementById(id),
                                {
                                    theme: 'snow',
                                    modules:
                                    {
                                        toolbar:
                                        {
                                            container: tb_opt,
                                            handlers: {'Table-Input': () => {}}
                                        },
                                        // 表
                                        table: false,
                                        'better-table': {operationMenu: {}}
                                    }
                                }
                    );
        return quill;
    }

    // 表範囲の選択CSS
    TableSizeCSS()
    {
        var row = Number(this.dom.dataset.value.substring(9).split('_')[0]);
        var col = Number(this.dom.dataset.value.substring(9).split('_')[1]);
        for(var elm of this.dom.parentNode.children)
        {
            var rowindex1 = Number(elm.dataset.value.substring(9).split('_')[0]);
            var colindex1 = Number(elm.dataset.value.substring(9).split('_')[1]);
            if (rowindex1 <= row && colindex1 <= col)
            {
                elm.classList.add("ql-picker-item-highlight");
            }
            else
            {
                elm.classList.remove("ql-picker-item-highlight");
            }
        };
    }

    // 表の挿入
    TableDraw()
    {
        var row = Number(this.dataset.value.substring(9).split('_')[0]);
        var col = Number(this.dataset.value.substring(9).split('_')[1]);

        // 表の挿入
        var qbt = this.ed.getModule('better-table');
            qbt.insertTable(row, col);
    }

    // 表のサイズ設定
    TableInit(dom)
    {
        var ed = this.editor;

        var tabledoms = dom.childNodes[1].children;
            for (var tabledom of tabledoms)
            {
                // クリック時の挙動
                tabledom.addEventListener(_MODE, {ed:this.editor, dataset:tabledom.dataset, handleEvent:this.TableDraw});

                //　マウスオーバー時の挙動
                tabledom.addEventListener(_MODE_HOVER, {dom:tabledom, handleEvent:this.TableSizeCSS});
            }
    }

    // quillBetterTableアイコン表示＆動作設定
    IconSet(id)
    {
        var dom = document.getElementById(id).parentNode.getElementsByClassName('ql-Table-Input')[0];
        dom.children[0].innerHTML = "<svg style=\"right: 4px;\" viewbox=\"0 0 18 18\"> <rect class=ql-stroke height=12 width=12 x=3 y=3></rect> <rect class=ql-fill height=2 width=3 x=5 y=5></rect> <rect class=ql-fill height=2 width=4 x=9 y=5></rect> <g class=\"ql-fill ql-transparent\"> <rect height=2 width=3 x=5 y=8></rect> <rect height=2 width=4 x=9 y=8></rect> <rect height=2 width=3 x=5 y=11></rect> <rect height=2 width=4 x=9 y=11></rect> </g> </svg>";

        this.TableInit(dom);
    }
}

window.addEventListener('load', function()
{
    // Quillにquill-better-tableを登録
    Quill.register({
        'modules/better-table': window.quillBetterTable
    }, true);
    var ed = new C_Editor("myeditor");
});
