# DoctorSender API PHP
====================
This repository is a PHP wrapper for the DoctorSender API.

This library is a set of functions to deal with the API of DoctorSender.
We found the proper API of DoctorSender to be poorly documentated compared to other email service providers so we decided to make our own library.

We also wanted to have a better PSR format.

Installation instruction
------------------------
1. Add the repository to your composer.json
```json
 "repositories": [
   {
     "type": "git",
     "url": "git@github.com:encreinformatique/doctorsender-api-php.git"
   }
 ],
```

2. Add the package to your dependencies by running
`composer require encreinformatique/doctorsender-api-php`

Summary
-------
* [Installation](installation.md)
* [Endpoints](endpoints.md)
* [Example](example.md)

Requisites
----------
You will obviously need a DoctorSender account, a user and an API token.
We are not affiliate in any way to DoctorSender. Please refer to DoctorSender for more information.

More information about the [DoctorSender API](http://soapwebservice.doctorsender.com/doxy/html/).

About
-----

This bundle is developped by [TLH](https://www.encreinformatique.com/)
