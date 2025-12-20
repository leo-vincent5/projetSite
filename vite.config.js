import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import fs from 'fs'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  server: {
    https: {
      key: fs.readFileSync('C:/laragon/etc/ssl/laragon.key'),
      cert: fs.readFileSync('C:/laragon/etc/ssl/laragon.crt'),
    },
    host: 'equicode.test',
    hmr: {
      host: 'equicode.test',
      protocol: 'wss',
    },
  },
})