# Pustaka Booking

Pustaka Booking adalah sebuah aplikasi yang digunakan untuk mempermudah dalam melakukan pemesanan buku di perpustakaan. Dibangun dengan bahasa PHP dan Framework CodeIgniter [CodeIgniter 3](https://codeigniter.com/userguide3/general/welcome.html).

## Setup Project

1. Clone repository

```bash
git clone https://github.com/ridwanpr/pustaka-booking/
```

2. Pindah ke direktori pustaka-booking

```bash
cd pustaka-booking
```

3. Ubah path base_url pada `application/config/config.php`

```bash
# diisi dengan path dimana anda mengclone project pustaka-booking
$config['base_url'] = 'http://localhost/pustaka-booking/';
```

4. Set kredensial database pada `application/config/database.php`

```bash
$db['default'] = array(
	'hostname' => 'localhost', # diisi dengan host database anda
	'username' => 'root', # diisi dengan username database anda
	'password' => '', # diisi dengan password database anda
	'database' => 'ci_pustaka_booking', # diisi dengan nama database anda
);
```

## Run Project

Cukup jalankan webserver dan buka `base_url` di browser.

## License

Project ini dibuat oleh [ridwanpr](https://github.com/ridwanpr) dan berlisensi [MIT License](https://opensource.org/licenses/MIT).
