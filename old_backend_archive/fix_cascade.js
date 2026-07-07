const fs = require('fs');

let content = fs.readFileSync('sample020.php', 'utf8');

const regex = /async function listChange\(categorySelect\) \{[\s\S]*?(?=function listChanged\(\))/;

const newLogic = `async function listChange(categorySelect) {
    console.log("Triggered by:", categorySelect.id);
    firstRemoveFlag = false;
    num = 0;
    flag1 = false;
    
    let db_name = document.mainform.DB_name.value || 'terashima01';
    db_name = db_name.toLowerCase();

    const getSelected = (id) => {
        const elem = document.getElementById(id);
        if(!elem) return [];
        const opts = elem.options;
        const selected = [];
        for (let i = 0; i < opts.length; i++) {
            if (opts[i].selected && opts[i].value !== "") {
                selected.push(opts[i].value);
            }
        }
        return selected;
    };

    const updateDropdown = async (targetId, searchCategoryName, filterCriteria) => {
        const targetElement = document.getElementById(targetId);
        if(!targetElement) return;
        
        const currentSelections = getSelected(targetId);

        // Show loading state
        while (targetElement.lastChild) {
            targetElement.removeChild(targetElement.lastChild);
        }
        const loadingOption = document.createElement("option");
        loadingOption.value = "";
        loadingOption.innerText = "読込中...";
        targetElement.appendChild(loadingOption);
        try { $(\`#\${targetId}\`).trigger("chosen:updated"); } catch(e) {}

        let query = supabaseClient.from(db_name).select(searchCategoryName).neq('question', 'settings');
        
        if (filterCriteria.ctg1 && filterCriteria.ctg1.length > 0) query = query.in('category1', filterCriteria.ctg1);
        if (filterCriteria.ctg2 && filterCriteria.ctg2.length > 0) query = query.in('category2', filterCriteria.ctg2);
        if (filterCriteria.ctg3 && filterCriteria.ctg3.length > 0) query = query.in('category3', filterCriteria.ctg3);
        if (filterCriteria.ctg4 && filterCriteria.ctg4.length > 0) query = query.in('category4', filterCriteria.ctg4);

        const { data, error } = await query;
        if (error) {
            console.error(\`Error fetching \${searchCategoryName}:\`, error);
            return;
        }

        let uniqueVals = [...new Set(data.map(item => item[searchCategoryName]))]
            .filter(val => val !== null && val !== undefined && String(val).trim() !== "")
            .map(val => String(val));
        
        // Remove loading state
        while (targetElement.lastChild) {
            targetElement.removeChild(targetElement.lastChild);
        }

        const emptyOption = document.createElement("option");
        emptyOption.value = "";
        emptyOption.innerText = "";
        targetElement.appendChild(emptyOption);

        uniqueVals.forEach(val => {
            const option = document.createElement("option");
            option.value = val;
            option.innerText = val;
            if (currentSelections.includes(val)) {
                option.selected = true;
            }
            targetElement.appendChild(option);
        });

        try { $(\`#\${targetId}\`).trigger("chosen:updated"); } catch(e) {}
    };

    const triggerId = categorySelect.id;
    let filters = { ctg1: getSelected('ctg1') };

    if (triggerId === 'ctg1') {
        await updateDropdown('ctg2', 'category2', filters);
    }
    
    filters.ctg2 = getSelected('ctg2');
    if (triggerId === 'ctg1' || triggerId === 'ctg2') {
        await updateDropdown('ctg3', 'category3', filters);
    }
    
    filters.ctg3 = getSelected('ctg3');
    if (triggerId === 'ctg1' || triggerId === 'ctg2' || triggerId === 'ctg3') {
        await updateDropdown('ctg4', 'category4', filters);
    }
    
    filters.ctg4 = getSelected('ctg4');
    if (triggerId === 'ctg1' || triggerId === 'ctg2' || triggerId === 'ctg3' || triggerId === 'ctg4') {
        await updateDropdown('ctg5', 'category5', filters);
    }
}
\n\n`;

if (content.match(regex)) {
    content = content.replace(regex, newLogic);
    fs.writeFileSync('sample020.php', content);
    console.log("Successfully updated listChange function with loading states and crash fixes.");
} else {
    console.log("Regex did not match.");
}
