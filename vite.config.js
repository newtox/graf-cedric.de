import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/tabler.scss',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~': path.resolve(__dirname, './node_modules'),
            '@tabler': path.resolve(__dirname, './node_modules/@tabler'),
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                includePaths: [path.resolve(__dirname, 'node_modules')],
            },
        },
    },
    server: {
        hmr: {
            host: 'localhost',
            protocol: 'ws',
            port: 3000
        }
    },
    build: {
        commonjsOptions: {
            transformMixedEsModules: true
        }
    }
});