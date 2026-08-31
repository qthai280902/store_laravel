const fs = require('fs');
let filePath = 'resources/views/products/show.blade.php';
let text = fs.readFileSync(filePath, 'utf8');

text = text.replace(
    /<x-layouts\.app :title="\$product->\r?\n\s*<div class="liquid-glass-pane[^"]*">name \. ' - MiniMart'">/,
    '<x-layouts.app :title="$product->name . \' - MiniMart\'">\n    <div class="liquid-glass-pane max-w-7xl mx-auto px-4 sm:px-6 py-10 my-8">'
);

fs.writeFileSync(filePath, text);
