<p align="center"><a href="https://pttem.com" target="_blank"><img src="https://pttem.com/images/logo.png" width="400"></a></p>

## Ne Yapar?
- JSON üzerinden aldığı ürünler listesini farklı alıcılar için farklı formatlarda sunum yapar, header'da gönderilen Accept değişkenine göre çıktı üretir

## Kurulum

Gereklilikler:

[PHP 8.0+](https://www.google.com/search?client=opera&q=php+8+install&sourceid=opera&ie=UTF-8&oe=UTF-8) ve [composer](https://getcomposer.org).

```sh
git clone https://github.com/mindwars/product-feeder-system.git
cd product-feeder-system
docker-compose build
docker-compose up
```

## Servis Linkleri

```sh
//Tanımlı alıcılar google, hepsiburada, cimri
http://127.0.0.1:8080/api/feed/{ALICI}
```

## Diğer
Postman Collection'ı görüntülemek için <a href="https://github.com/mindwars/product-feeder-system/blob/master/postman_collection.json" target="_blank">tıklayınız</a>.