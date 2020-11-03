Clone Project ini setelah selesai pada terminal masuk kedalam directory project

Ketikkan:

1. Composer Install
2. cp .env.example .env
3. php artisan key:generate
4. database yang namanya tivent harus kosong (apus tablenya kalo ada)
5. php artisan migrate (Jangan lupa set up database) //nama dbnya tivent
6. php artisan db:seed --class=AdminSeeder
7. php artisan storage:link
8. php artisan serve

