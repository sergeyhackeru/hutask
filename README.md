- Name: Sergeii Shcherbatiuk
- Email: sergeyedit@gmail.com


# Project Overview

This project is fullstack aplication contaning:
Backend Api service logic - writen using object oriented PHP
Front end (Client) - writen using Angular8 and Bootstrap framework 

# Instruction

1.Please note that the project is uncompiled - 
2.in order to run the API please puth the project folder in php run envoiroment s.a XAMPP/htdocs
3.to run teh client use ng serve command inside client folder

# Api file herarcy points of interest and folder structure

1.Aplication entry point: public/index.php 
2.Core/Router.php  - routing logic and routes for api
3.App/Controllers/Lectors.php  - business logic and work with models
4.App/Models/Lector.php - Model
5.Core/FakeDb.php  - Class emulating DB Class Logic corresponding with fake database (json file)
6.Core/fakedb.json - json file emulating data base data structure 


# Api routes map:

http://localhost/hutask/ -          [get] all unmodified data
http://localhost/hutask/lectors -   [get] lectors with modified languages
http://localhost/hutask/languages - [get] languages

# Client Application

1.Client root folder: lector-ng-client/
2.src/app/lectors-listt/
3.lectors-list.component.ts
4.lectors-list.component.html

# Client Application Filter

Filter implemented as a pipe on a client side,
taking in concideration size of used data base
i found it more reasonable to fetch all data at #once on init
and filter it as much and as how as want on the client side
instead of rapidly shooting my back-end with requests 