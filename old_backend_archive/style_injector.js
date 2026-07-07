const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

const minimalButtonCSS = `
/* Apple/Vercel Minimalist Button Styles */
.button, input[type="button"], input[type="submit"] {
    background-color: transparent;
    color: #111 !important;
    border: 1px solid #111;
    border-radius: 6px;
    padding: 8px 16px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
    cursor: pointer;
    box-shadow: none;
    text-shadow: none;
    outline: none;
}

.button:hover, input[type="button"]:hover, input[type="submit"]:hover {
    background-color: #111;
    color: #fff !important;
    border-color: #111;
}

.button:active, input[type="button"]:active, input[type="submit"]:active {
    transform: scale(0.98);
}

/* Good/Correct buttons (botan03) - Subtle Green */
input[name="botan03"] {
    color: #0d8a4e !important;
    border-color: #0d8a4e;
}
input[name="botan03"]:hover {
    background-color: #0d8a4e;
    color: #fff !important;
}

/* Poor/Incorrect buttons (botan04) - Subtle Red */
input[name="botan04"] {
    color: #e53935 !important;
    border-color: #e53935;
}
input[name="botan04"]:hover {
    background-color: #e53935;
    color: #fff !important;
}

/* Text inputs (search, criteria, etc) */
input[type="text"].button {
    background-color: #fff;
    color: #111 !important;
    border: 1px solid #ddd;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
    cursor: text;
}
input[type="text"].button:focus {
    border-color: #111;
    box-shadow: 0 0 0 1px #111;
}
input[type="text"].button:hover {
    background-color: #fff;
    color: #111 !important;
}
`;

// Only inject if not already injected
if (!content.includes('Apple/Vercel Minimalist Button Styles')) {
    content = content.replace('</style>', minimalButtonCSS + '\n</style>');
    fs.writeFileSync(file, content);
    console.log("Minimalist button CSS injected.");
}
