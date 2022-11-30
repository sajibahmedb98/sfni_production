// webpack.mix.js

import mix from 'laravel-mix';

mix.browserSync({

    proxy: 'http//127.0.0.1:8000'
});

