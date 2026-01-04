# Sample Data untuk Google Sheets

## Products Sheet
```
id	name	description	price	category_id	image1	image2	image3	image4	image5	stock
1	Laptop Gaming ASUS ROG	Laptop gaming dengan processor Intel Core i7, RAM 16GB, SSD 512GB, VGA RTX 3060	15000000	1	https://images.unsplash.com/photo-1603302576837-37561b2e2302	https://images.unsplash.com/photo-1593642632823-8f785ba67e45	https://images.unsplash.com/photo-1496181133206-80ce9b88a853			10
2	Mouse Gaming Logitech	Mouse gaming wireless dengan RGB lighting dan sensor 16000 DPI	450000	2	https://images.unsplash.com/photo-1527864550417-7fd91fc51a46	https://images.unsplash.com/photo-1586892478025-2b5472316f22			50
3	Keyboard Mechanical RGB	Keyboard mechanical dengan switch Cherry MX Blue dan RGB per-key lighting	850000	2	https://images.unsplash.com/photo-1587829741301-dc798b83add3	https://images.unsplash.com/photo-1595225476474-87563907a212	https://images.unsplash.com/photo-1511467687858-23d96c32e4ae		30
4	Monitor 27 inch 144Hz	Monitor gaming 27 inch dengan refresh rate 144Hz dan response time 1ms	3500000	1	https://images.unsplash.com/photo-1527443224154-c4a3942d3acf	https://images.unsplash.com/photo-1585792180666-f7347c490ee2			15
5	Headset Gaming HyperX	Headset gaming dengan surround sound 7.1 dan microphone noise-cancelling	750000	2	https://images.unsplash.com/photo-1484704849700-f032a568e944	https://images.unsplash.com/photo-1546435770-a3e426bf472b			25
6	Webcam HD 1080p	Webcam HD 1080p dengan auto focus dan mikrofon stereo	650000	2	https://images.unsplash.com/photo-1585338107529-13afc5f02586				40
7	SSD External 1TB	SSD External 1TB dengan kecepatan transfer hingga 1000MB/s	1500000	1	https://images.unsplash.com/photo-1597872200969-2b65d56bd16b				35
8	RAM DDR4 16GB	RAM DDR4 16GB (2x8GB) 3200MHz untuk gaming dan multitasking	950000	2	https://images.unsplash.com/photo-1562976540-1502c2145186				60
```

## Categories Sheet
```
id	name	description
1	Elektronik	Produk elektronik dan komputer
2	Aksesoris	Aksesoris komputer dan gaming
3	Perangkat Mobile	Smartphone dan tablet
4	Audio	Speaker, headphone, dan perangkat audio
5	Gaming	Produk khusus gaming
```

## Store Sheet
```
key	value
name	Toko Elektronik Sejahtera
address	Jl. Teknologi No. 123, Jakarta Selatan, DKI Jakarta 12345
phone	021-12345678
whatsapp	081234567890
email	info@tokosejahtera.com
hero_title	Selamat Datang di Toko Elektronik Sejahtera
hero_subtitle	Belanja produk elektronik dan gaming berkualitas dengan harga terbaik
about	Toko Elektronik Sejahtera adalah toko online terpercaya yang menyediakan berbagai produk elektronik, komputer, dan gaming berkualitas tinggi. Kami berkomitmen memberikan pelayanan terbaik dan harga yang kompetitif untuk kepuasan pelanggan.
```

## Catatan Penting:

1. **Kolom harus sama persis** - Pastikan nama kolom di baris pertama sesuai dengan yang tertera di atas
2. **ID harus unik** - Setiap produk dan kategori harus memiliki ID yang unik
3. **category_id** - Harus sesuai dengan ID yang ada di Categories sheet
4. **Harga** - Tulis tanpa titik atau koma, contoh: 15000000 untuk 15 juta
5. **Image URL** - Gunakan URL lengkap yang bisa diakses publik
6. **Stock** - Kosongkan jika tidak ingin menampilkan stok, atau isi dengan angka

## Tips Menggunakan Unsplash Images:

URL gambar Unsplash di atas bisa langsung digunakan untuk demo. Untuk produksi, sebaiknya:
1. Download gambar dan upload ke hosting sendiri
2. Atau gunakan Google Drive dengan format: `https://drive.google.com/uc?export=view&id=FILE_ID`

## Cara Copy Data ke Google Sheets:

1. Buat Google Sheet baru
2. Buat 3 tabs: Products, Categories, Store
3. Copy paste data di atas ke masing-masing tab
4. Pastikan header (baris pertama) sudah benar
5. Format kolom price dan stock sebagai Number
6. Atur lebar kolom agar mudah dibaca
