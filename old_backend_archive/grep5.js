const str = '<input class ="button" type="checkbox" id = "autoread" onchange = "settingSave()" style="font-size: 20px;margin:2vh 0px 0px 2vh">';
const id = 'autoread';
const inpRegex = new RegExp('<input[^>]*id\\s*=\\s*[\'"]?' + id + '[\'"]?[^>]*>', 'i');
console.log(str.match(inpRegex));
