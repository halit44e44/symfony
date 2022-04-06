<h2 align="center">
  PATH Repository
</h2>
<br>

## 🚀 Teknolojiler

- [PHP 8.1.3](https://php.net)
- [Symfony 5.4.7](https://php.net)
- [Nginx](https://nginx.com/)
- [MySQL](https://mysql.com)
- [Docker](https://docker.com)
- [Redis](https://redis.io/)

## ⚙️ Setup & Run
- Repoyu klonlayın.
- komutunu terminalden çalıştırın.
```
# cd symfony
# docker-compose up -d
# php bin/console lexik:jwt:generate-keypair
```

- Tarayıcı URL http://localhost:8000
- phpMyAdmin http://localhost:9090
- Sunucu: db
- user: root
- password: root

<h2 align="center">
  ÖNEMLİ LÜTFEN OKUYUN
</h2>

## 💻 KULANICI EKLEME VE POSTMAN JSON
- APİ DOCS URL -> https://documenter.getpostman.com/view/15519033/UVyvvEZ7
- POSTMAN JSON DOSYASI ANA DİZİNDE 'PATH.dostman_collection.json' olarak kayıtlı. Postmana IMPORT ederseniz kayıt oluşacaktır.

*** PASSWORD = 1234
```
# INSERT INTO `user`(`email`, `roles`, `password`) VALUES ('admin@admin.com','["USER_ADMIN"]','$2y$13$fuAjNNcZXnbq5Vq8ToMoE.U9o.daAbn6hy8JBtEA.SXtikvoUlJFO')
```


