const fs = require('fs');

function processFile(filePath) {
    let text = fs.readFileSync(filePath, 'utf8');
    
    // Fix the broken layout tag
    text = text.replace(
        /<x-layouts\.app title="\{\{ \$post->\r?\n\s*<div class="liquid-glass-pane[^"]*">title \}\} - MiniMart">/,
        '<x-layouts.app title="{{ $post->title }} - MiniMart">\n    <div class="liquid-glass-pane max-w-7xl mx-auto px-4 sm:px-6 py-10 my-8">'
    );
    text = text.replace(
        /<x-layouts\.app title="Về MiniMart - MiniMart">\r?\n\s*<div class="liquid-glass-pane[^"]*">/,
        '<x-layouts.app title="Về MiniMart - MiniMart">\n    <div class="liquid-glass-pane max-w-7xl mx-auto px-4 sm:px-6 py-10 my-8">'
    );
    
    // For blog/index.blade.php
    text = text.replace(
        /<x-layouts\.app title="Blog & Tin tức - MiniMart">\r?\n\s*<div class="liquid-glass-pane[^"]*">/,
        '<x-layouts.app title="Blog & Tin tức - MiniMart">\n    <div class="liquid-glass-pane max-w-7xl mx-auto px-4 sm:px-6 py-10 my-8">'
    );
    
    // For products/show.blade.php
    text = text.replace(
        /<x-layouts\.app title="\{\{ \$product->\r?\n\s*<div class="liquid-glass-pane[^"]*">name \}\} - MiniMart">/,
        '<x-layouts.app title="{{ $product->name }} - MiniMart">\n    <div class="liquid-glass-pane max-w-7xl mx-auto px-4 sm:px-6 py-10 my-8">'
    );

    fs.writeFileSync(filePath, text);
}

processFile('resources/views/products/show.blade.php');
processFile('resources/views/blog/index.blade.php');
processFile('resources/views/blog/show.blade.php');
processFile('resources/views/about.blade.php');

