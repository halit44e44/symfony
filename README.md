# symfony
symfony

1- Hash şifre oluşturma
php bin/console security:hash-password 1234

2- SQL Kullanıcı Ekleme
INSERT INTO `user`(`email`, `roles`, `password`) VALUES ('admin@admin.com','["USER_ADMIN"]','$2y$13$fuAjNNcZXnbq5Vq8ToMoE.U9o.daAbn6hy8JBtEA.SXtikvoUlJFO')