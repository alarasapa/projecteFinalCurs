**[PFC: Club de Tennis Blanes]{.ul}**

Nom: Agustín Ezequiel Lara Sicilia

Data: 15/05/2021

Email: a.lara\@sapalomera.cat

Github:
[[https://github.com/alarasapa/projecteFinalCurs]{.ul}](https://github.com/alarasapa/projecteFinalCurs)

**[Pasos a seguir per a veure el projecte]{.ul}**

1.- Després de clonar el repositori de GitHub, importem l'arxiu anomenat
'pfctennis.sql' que es troba en l'arrel del projecte.

2.- Obrim la terminal i executem la comanda: '*composer install* \', ara
bé:

● Per a executar la comanda hem d'instal·lar *composer* en el nuestro

> ordinador. Per tant anirem al següent enllaç:
> [[https://getcomposer.org/download/]{.ul}](https://getcomposer.org/download/).
> La versió de PHP que s'ha utilitzat per a fer aquest projecte ha sigut
> la *7.4.10.*

3.- Una vegada instal·lat composer, executem la comanda \'*npm install*
\'

● Per a executar la comanda haurem d'instal·lar *Node.js*

[[https://nodejs.org/es/download/]{.ul}](https://nodejs.org/es/download/).

4.- Creem un arxiu anomenat .env dins de la carpeta de
ProyectoLaravel/pfctennis/ que contingui la següent informació:

5.- Anem a .env.example i copiem tot el contingut i ho enganxem en el
nostre arxiu .env que hem creat amb anterioritat però canviant el
següent:

MAIL_MAILER=smtp

MAIL_HOST=smtp.gmail.com

MAIL_PORT=587

MAIL_USERNAME= EL VOSTRE CORREU ELECTRÓNIC

MAIL_PASSWORD=LA VOSTRA CONTRASENYA DEL CORREU

MAIL_ENCRYPTION=tls

MAIL_FROM_ADDRESS=EL VOSTRE CORREU ELECTRÓNIC

MAIL_FROM_NAME=\"TennisPadel\"

Recorda d'habilitar el correu per a que es pugui executar desde
aplicacions no segures.

6.- Executem la comanda \'*php artisan cache:clear* \'

7.- Executem la comanda '*php artisan config:cache*'\'

8.- Executem la comanda *php aritsan serve* per a inicialitzar el
servidor i entrem a la pàgina:
[[http://127.0.0.1:8000/]{.ul}](http://127.0.0.1:8000/)

Per a entrar com administrador és:

Correu: [[agustinlse8\@gmail.com]{.ul}](mailto:agustinlse8@gmail.com)

Contrasenya: agustinlara1

Si vols crear un altre usuari sempre pots registrarte o crear-ne un
desde el panell d'administració.
