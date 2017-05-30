# DoctorSender API PHP
[![Build Status](https://travis-ci.org/encreinformatique/doctorsender-api-php.svg?branch=master)](https://travis-ci.org/encreinformatique/doctorsender-api-php)
[![Downloads](https://img.shields.io/packagist/dt/encreinformatique/doctorsender-api-php.svg)](https://packagist.org/packages/encreinformatique/doctorsender-api-php)
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
