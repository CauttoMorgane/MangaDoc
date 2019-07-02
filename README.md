<p align="center">

<h1 align="center">MangaDoc</h1>
<h4 align="center">A website that allows you to sell or trade your mangas</h4>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
[![Build Status](https://travis-ci.org/CauttoMorgane/MangaDoc.svg?branch=master)](https://travis-ci.org/CauttoMorgane/MangaDoc)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/3b4748e8cdda4996a9c5f0d2cbc1e382)](https://app.codacy.com/project/CauttoMorgane/MangaDoc/dashboard)
[![Discord](https://img.shields.io/discord/530659599301345291.svg?logo=discord)](https://discord.gg/2446zBm)

</p>

## Pre-requirements
You will need Docker to build the application, find more informations on [the docker installation documentation](https://docs.docker.com/install/)

## Contributing
To contribute :
```bash
# Clone the application
git clone https://github.com/CauttoMorgane/MangaDoc.git


# Build and initialize the project
make install
```
If you don't have make (or don't want to download it)
```bash
# Execute in order these commands
composer install
npm install
yarn install
yarn encore dev --watch

php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
```
Let's go !

## License
This project is under [MIT License](https://choosealicense.com/licenses/mit/)

## Collaborators
<a href="https://github.com/CauttoMorgane"><b>CauttoMorgane</b></a> | <a href="https://github.com/VibitaS"><b>VibitaS</b></a>
