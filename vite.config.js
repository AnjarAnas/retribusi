import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js',
                    'resources/css/apexcharts.css','resources/js/apexcharts.custom.js',
                    'resources/css/app-dark.css','resources/js/apexcharts.min.js',
                    'resources/css/app-light.css','resources/js/bootstrap.min.js',
                    'resources/css/dataTables.bootstrap4.css','resources/js/dataTables.bootstrap4.min.js',
                    'resources/css/select2-bootstrap4.css','resources/js/jquery.dataTables.min.js',
                    'resources/css/select2.css','resources/js/jquery.min.js',
                    'resources/css/uppy.min.css','resources/js/popper.min.js',
                    'resources/js/select2.min.js','resources/css/feather.css',
                    'resources/js/apps.js',
                    'resources/js/tinycolor-min.js','resources/css/jquery.steps.css',
                    'resources/css/simplebar.css'
                ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
