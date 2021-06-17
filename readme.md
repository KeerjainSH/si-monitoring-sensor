# SI Monitoring Sensor
__Web__ __Application__ untuk _monitoring_ data yang masuk dari sensor

## Tampilan
### Log In/Regsiter

![si-monitoring-sensor-01](https://user-images.githubusercontent.com/64743796/122437418-a6991a00-cfd4-11eb-9074-5c69516b12c3.png)

### Dashboard
![si-monitoring-sensor-02](https://user-images.githubusercontent.com/64743796/122437468-b44e9f80-cfd4-11eb-945f-19c0509d0876.png)

### Import&Export Data
![si-monitoring-sensor-04](https://user-images.githubusercontent.com/64743796/122437713-ec55e280-cfd4-11eb-91d7-121e8fa90a93.png)

### Grafik
![si-monitoring-sensor-03](https://user-images.githubusercontent.com/64743796/122437596-cf211400-cfd4-11eb-98b8-662fe1314e94.png)



## Cara Clone Project Laravel ini dari Github
### Tahap Persiapan
Pastikan sudah menginstall composer dalam pc anda

1. Clone repositori dengan menggunakan command line atau bisa juga dengan mendownload zip nya
2. Jika menggunakan zip, ekstrak folder project ke direktori xampp/htdocs
3. Buka command prompt (Jika menggunakan windows), lalu pindahkan working directory ke folder project
4. Masukkan perintah ```composer install``` pada command prompt, lalu command prompt akan menginstall library yang digunakan dalam project
5. Copy file ```.env.example``` dan beri nama ```.env``` dengan cara memasukkan perintah ```copy .env.example .env``` kedalam comand prompt
6. Buat kode enkripsi aplikasi laravel dengan memasukkan perintah ```php artisan key:generate```

### Tahap Penyelarasan Aplikasi dengan Database
1. Membuka phpmyadmin melalui browser
2. Buat database baru dengan "nama" yang sesuai dengan keinginan anda
3. Buka file .env yang dibuat pada tahap persiapan
4. Pada bagian ini
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
ganti ```DB_DATABASE=laravel```, menjadi ```DB_DATABASE="nama" database yang telah dibuat```

5. Masukkan perintah ```php artisan migrate``` pada command prompt

6. Sistem akan menggenerate akun admin dengan email ```admin@admin.com``` dan password ```admin``` dengan role "admin" secara otomatis (silahkan gunakan untuk login pertama kali)

### Tahap Akhir
Gunakan perintah ```php artisan serve``` untuk memulai local development server
