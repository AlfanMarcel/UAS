<h1 align="center">Selamat datang di website Apotek Laravel Kami! 👋</h1>

## Apa itu Website Apotek?

Web Apotek yang dibuat oleh <a href="https://github.com/judhacdc"> Judha Maygustya </a> dan <a href="https://github.com/setyawan1234"> Gilang Setyawan </a>. **Adalah aplikasi manajemen Apotek melalui website dengan mudah.** yang mana aplikasi ini kami buat demi memenuhi nilai Ujian Akhir Semester matakuliah Pemrograman Website Lanjut yang di bimbing oleh Pak Moch. Zawaruddin Abdullah, S.ST., M.Kom  👋👋

## Fitur apa saja yang tersedia di Laundry?

-   Autentikasi Admin
-   Category & CRUD
-   Member & CRUD
-   User & CRUD
-   Product & CRUD
-   Apotek
-   Dan lain-lain

## Release Date

**Release date : 27 Juni 2022**


---

## Default Account for testing

**Admin Default Account**

-   Username: admin@mail.com
-   Password: admin

**Pegawai Default Account**

-   Username: pegawai@mail.com
-   Password: pegawai

---

## Install

1. **Clone Repository**

```bash
git clone https://github.com/judhacdc/PWL_PROJECT.git
cd PWL_PROJECT
composer install
npm install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_PORT=3306
DB_DATABASE=apotek
DB_USERNAME=root
DB_PASSWORD=
```

3. **Instalasi website**

```bash
php artisan key:generate
php artisan migrate --seed
php artisan jwt:secret
php artisan config:cache
```

4. **Jalankan website**

```bash
php artisan serve
```

## License

-   Copyright © 2022 Judha Maygustya & Gilang Setyawan aka TIM BUBADIBAKO.
