const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// Replace button colors with monochrome matching top panel
c = c.replace(/\.msc-btn-good \{[\s\S]*?\}/, `.msc-btn-good {
    background: #ffffff;
    color: #111111;
    border-color: #dddddd;
}`);

c = c.replace(/\.msc-btn-good:hover \{[\s\S]*?\}/, `.msc-btn-good:hover {
    background: #111111;
    color: #ffffff;
    border-color: #111111;
}`);

c = c.replace(/\.msc-btn-poor \{[\s\S]*?\}/, `.msc-btn-poor {
    background: #ffffff;
    color: #111111;
    border-color: #dddddd;
}`);

c = c.replace(/\.msc-btn-poor:hover \{[\s\S]*?\}/, `.msc-btn-poor:hover {
    background: #111111;
    color: #ffffff;
    border-color: #111111;
}`);

c = c.replace(/\.msc-btn-nav, \.msc-btn-undo \{[\s\S]*?\}/, `.msc-btn-nav, .msc-btn-undo {
    background: #ffffff;
    color: #111111;
    border-color: #dddddd;
}`);

c = c.replace(/\.msc-btn-nav:hover, \.msc-btn-undo:hover \{[\s\S]*?\}/, `.msc-btn-nav:hover, .msc-btn-undo:hover {
    background: #111111;
    color: #ffffff;
    border-color: #111111;
}`);

// Action buttons (Next / Answer)
c = c.replace(/\.msc-btn-huge \{[\s\S]*?\}/, `.msc-btn-huge {
    padding: 16px 32px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 8px;
    border: 1px solid #dddddd;
    background: #ffffff;
    color: #111111;
    cursor: pointer;
    transition: all 0.2s;
}`);

c = c.replace(/\.msc-btn-primary \{[\s\S]*?\}/, `.msc-btn-primary {
    background: #111111;
    color: #ffffff;
    border-color: #111111;
}`);

c = c.replace(/\.msc-btn-primary:hover \{[\s\S]*?\}/, `.msc-btn-primary:hover {
    background: #333333;
    color: #ffffff;
    border-color: #333333;
}`);

c = c.replace(/\.msc-btn-secondary \{[\s\S]*?\}/, `.msc-btn-secondary {
    background: #ffffff;
    color: #111111;
    border-color: #dddddd;
}`);

c = c.replace(/\.msc-btn-secondary:hover \{[\s\S]*?\}/, `.msc-btn-secondary:hover {
    background: #f4f4f5;
}`);

// Textareas
c = c.replace(/\.msc-textarea \{[\s\S]*?\}/, `.msc-textarea {
    width: 100%;
    min-height: 120px;
    background: #ffffff;
    border: 1px solid #eaeaea;
    border-radius: 8px;
    padding: 16px;
    color: #111111;
    font-size: 1rem;
    line-height: 1.6;
    resize: vertical;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
    box-sizing: border-box;
}`);
c = c.replace(/\.msc-textarea:focus \{[\s\S]*?\}/, `.msc-textarea:focus {
    outline: none;
    border-color: #111111;
}`);

// Also fix any hardcoded colors like #34d399 or #f87171 that might have survived
c = c.replace(/color: #34d399;/g, 'color: #111111;');
c = c.replace(/color: #f87171;/g, 'color: #111111;');
c = c.replace(/color: #94a3b8;/g, 'color: #111111;');
c = c.replace(/background: rgba\(16, 185, 129, 0\.1\);/g, 'background: #ffffff;');
c = c.replace(/background: rgba\(239, 68, 68, 0\.1\);/g, 'background: #ffffff;');
c = c.replace(/background: rgba\(148, 163, 184, 0\.1\);/g, 'background: #ffffff;');
c = c.replace(/border-color: rgba\(16, 185, 129, 0\.3\);/g, 'border-color: #dddddd;');
c = c.replace(/border-color: rgba\(239, 68, 68, 0\.3\);/g, 'border-color: #dddddd;');
c = c.replace(/border-color: rgba\(148, 163, 184, 0\.3\);/g, 'border-color: #dddddd;');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
