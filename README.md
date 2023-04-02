1. Lakukan install dependencies Laravel dengan menggunakan perintah <strong>composer install</strong>. <br>
2. Salin file .env.example menjadi .env dengan menggunakan perintah <strong>cp .env.example .env</strong> <br>
3. Generate Laravel key dengan menggunakan perintah <strong>php artisan key:generate</strong> <br>
4. Atur konfigurasi database pada file .env dengan mengubah nilai DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, dan DB_PASSWORD sesuai dengan konfigurasi database yang akan digunakan. <br>
5. Jalankan <strong>php artisan migrate --seed</strong>
6. Jalankan server Laravel dengan menggunakan perintah <strong>php artisan serve</strong> <br>