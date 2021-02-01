**Argokusuma**

Panduan Update

NOTE: Mohon backup terlebih dahulu untuk source code dan website Argokusuma sebelum melakukan update ini

# Update database
Ada beberapa update database baik altering table, adding table maupun adding record, silahkan import file db/update.sql dump ke existing database Argokusuma

# Update source code
Silahkan replace/tambahkan beberapa directory/file berikut ini untuk melakukan update

- assets/js
- assets/css
- assets/libs
- assets/static/id.jpg (file)
- assets/static/en.png (file)
- app/controllers
- app/config/routes.php (file)
- app/config/autoload.php (file)
- app/core
- app/helpers
- app/models
- app/views

# Pastikan configurasi sesuai
Pastikan beberapa config berikut telah sesuai

- Chmod untuk directory medias/* sudah writable
- app/config/{env}/database.php sudah sesuai settingan database Anda, dimana {env} ini di adalah environment system (development/production/staging)
- Environment system telah sesuai dapat diatur di root index.php


