const fs = require('fs');

function processFile(filePath, wrappers, replacements) {
    if (!fs.existsSync(filePath)) {
        console.log("File not found: " + filePath);
        return;
    }
    let text = fs.readFileSync(filePath, 'utf8');
    
    // Wrap
    if (!text.includes('liquid-glass-pane max-w-7xl')) {
        text = text.replace(/<x-layouts\.app[^>]*>\s*/, (match) => {
            return match + '<div class="liquid-glass-pane max-w-7xl mx-auto px-4 sm:px-6 py-10 my-8">\n';
        });
        text = text.replace(/<\/x-layouts\.app>/, '</div>\n</x-layouts.app>');
    }
    
    // Replacements
    for (const [search, replace] of replacements) {
        text = text.split(search).join(replace);
    }
    
    fs.writeFileSync(filePath, text);
    console.log("Processed " + filePath);
}

// 1. products/show.blade.php
processFile(
    'resources/views/products/show.blade.php', 
    true, 
    [
        ['class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"', 'class="max-w-7xl mx-auto"'],
        ['bg-white/70 backdrop-blur-3xl border border-white/80 shadow-2xl rounded-[3rem] p-8 md:p-12 mb-16', 'bg-transparent rounded-[3rem] p-4 md:p-8 mb-8'],
        ['bg-white/40 backdrop-blur-3xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.08)] ring-1 ring-white/50', 'bg-white/30 backdrop-blur-md border border-white/40 shadow-sm']
    ]
);

// 2. blog/index.blade.php
processFile(
    'resources/views/blog/index.blade.php', 
    true, 
    [
        ['class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"', 'class="max-w-7xl mx-auto"'],
        ['bg-white/40 backdrop-blur-xl border border-white/50 shadow-sm rounded-3xl p-8 mb-8 text-center', 'bg-white/30 backdrop-blur-md border border-white/40 shadow-sm rounded-3xl p-8 mb-8 text-center'],
        ['bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100 fade-item', 'bg-white/30 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-white/40 fade-item']
    ]
);

// 3. blog/show.blade.php
processFile(
    'resources/views/blog/show.blade.php', 
    true, 
    [
        ['class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12"', 'class="max-w-4xl mx-auto"'],
        ['bg-white/80 backdrop-blur-xl shadow-sm border border-gray-100 rounded-3xl p-8 md:p-12', 'bg-transparent p-4 md:p-8']
    ]
);

// 4. about.blade.php
processFile(
    'resources/views/about.blade.php', 
    true, 
    [
        ['class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16"', 'class="max-w-7xl mx-auto"'],
        ['bg-white/40 backdrop-blur-xl border border-white/50 shadow-sm rounded-3xl p-8 mb-8 text-center fade-item', 'bg-white/30 backdrop-blur-md border border-white/40 shadow-sm rounded-3xl p-8 mb-8 text-center fade-item']
    ]
);
