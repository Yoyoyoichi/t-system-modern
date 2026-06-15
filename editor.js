var _MODE = (typeof window.ontouchstart == "undefined")? 'click' : 'touchstart';
var _MODE_HOVER = (typeof window.ontouchstart == "undefined")? 'mouseover' : 'touchstart';

// WYSIWYG繧ｯ繝ｩ繧ｹ
class C_Editor
{
    constructor(id)
    {
        this.editor = this.Init(id);
        this.IconSet(id)
    }

    // Quill襍ｷ蜍・
    Init(id)
    {
        // 陦ｨ縺ｮ螟ｧ縺阪＆謖・ｮ夂畑・域怙螟ｧ・暦ｽ假ｼ励・繧ｹ・・
        var tableopt = []
        for (let r = 1; r <= 7; r++)
        {
            for (let c = 1; c <= 7; c++)
            {
                tableopt.push('newtable_' + r + '_' + c);
            }
        }

        // 繝・・繝ｫ繝舌・縺ｫ陦ｨ遉ｺ縺吶ｋ讖溯・
        var tb_opt = [
            // 隕句・縺・
            {'header': [1, 2, 3, false]},
            // 螟ｪ蟄励∵万菴薙∽ｸ狗ｷ壹∵遠豸育ｷ・
            'bold', 'italic', 'underline', 'strike',
            // 荳奇ｼ丈ｸ倶ｻ倥″譁・ｭ・
            {'script': 'super'}, {'script': 'sub'},
            // 譁・ｭ苓牡縲∵枚蟄苓レ譎ｯ濶ｲ
            {'color': []}, {'background': []},
            // 繝ｪ繧ｹ繝・
            {'list': 'ordered'}, {'list': 'bullet'},
            // 譁・ｭ怜ｯ・○
            {'align': []},
            // 繧､繝ｳ繝・Φ繝・
            {'indent': '-1'}, {'indent': '+1'},
            // 繧ｳ繝ｼ繝峨ヶ繝ｭ繝・け(繧､繝ｳ繝ｩ繧､繝ｳ繧ｳ繝ｼ繝峨・繧｢繧､繧ｳ繝ｳ縺ｨ蛹ｺ蛻･縺後▽縺九↑縺・・縺ｧ繧ｳ繝ｼ繝峨ヶ繝ｭ繝・け縺ｮ縺ｿ)
            'code-block',
            // 謨ｰ蠑・
            'formula',
            // 陦ｨ
            {'Table-Input': tableopt},
            //逕ｻ蜒上・蜍慕判謖ｿ蜈･縲ゞRL繝ｪ繝ｳ繧ｯ
            'image', 'video', 'link',
            // 陬・｣ｾ縺ｮ蜑企勁
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
                                        // 陦ｨ
                                        table: false,
                                        'better-table': {operationMenu: {}}
                                    }
                                }
                    );
        return quill;
    }

    // 陦ｨ遽・峇縺ｮ驕ｸ謚曚SS
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

    // 陦ｨ縺ｮ謖ｿ蜈･
    TableDraw()
    {
        var row = Number(this.dataset.value.substring(9).split('_')[0]);
        var col = Number(this.dataset.value.substring(9).split('_')[1]);

        // 陦ｨ縺ｮ謖ｿ蜈･
        var qbt = this.ed.getModule('better-table');
            qbt.insertTable(row, col);
    }

    // 陦ｨ縺ｮ繧ｵ繧､繧ｺ險ｭ螳・
    TableInit(dom)
    {
        var ed = this.editor;

        var tabledoms = dom.childNodes[1].children;
            for (var tabledom of tabledoms)
            {
                // 繧ｯ繝ｪ繝・け譎ゅ・謖吝虚
                tabledom.addEventListener(_MODE, {ed:this.editor, dataset:tabledom.dataset, handleEvent:this.TableDraw});

                //縲繝槭え繧ｹ繧ｪ繝ｼ繝舌・譎ゅ・謖吝虚
                tabledom.addEventListener(_MODE_HOVER, {dom:tabledom, handleEvent:this.TableSizeCSS});
            }
    }

    // quillBetterTable繧｢繧､繧ｳ繝ｳ陦ｨ遉ｺ・・虚菴懆ｨｭ螳・
    IconSet(id)
    {
        var dom = document.getElementById(id).parentNode.getElementsByClassName('ql-Table-Input')[0];
        dom.children[0].innerHTML = "<svg style=\"right: 4px;\" viewbox=\"0 0 18 18\"> <rect class=ql-stroke height=12 width=12 x=3 y=3></rect> <rect class=ql-fill height=2 width=3 x=5 y=5></rect> <rect class=ql-fill height=2 width=4 x=9 y=5></rect> <g class=\"ql-fill ql-transparent\"> <rect height=2 width=3 x=5 y=8></rect> <rect height=2 width=4 x=9 y=8></rect> <rect height=2 width=3 x=5 y=11></rect> <rect height=2 width=4 x=9 y=11></rect> </g> </svg>";

        this.TableInit(dom);
    }
}

window.addEventListener('load', function()
{
    // Quill縺ｫquill-better-table繧堤匳骭ｲ
    Quill.register({
        'modules/better-table': window.quillBetterTable
    }, true);
    var ed = new C_Editor("myeditor");
});
