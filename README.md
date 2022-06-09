# 🥇About the project
**The Car For Rent Symfony project**  is a project to study and practice about symfony framework
# 🎉 Symfony
**Symfony** is a **PHP framework** for web and console applications and a set of reusable **PHP components**. Symfony is used by thousands of web applications and most of the popular PHP projects.
# Getting started
## Setup Environment
- Follow this article to install and learn about symfony 6.1: [Click here](https://symfony.com/doc/current/index.html)
## Technical Requirements
- Install PHP 8.1 or higher and these PHP extensions (which are installed and enabled by default in most PHP 8 installations): Ctype, iconv, PCRE, Session, SimpleXML, and Tokenizer;
- Install Composer, which is used to install PHP packages.
```bash
$ symfony check:requirements
```
## Creating Symfony Applications
- Open your console terminal and run any of these commands to create a new Symfony application:
```bash
# run this if you are building a traditional web application
$ symfony new my_project_directory --version=6.0.* --webapp
# run this if you are building a microservice, console application or API
$ symfony new my_project_directory --version=6.0.*
```
- If you're not using the Symfony binary, run these commands to create the new Symfony application using Composer:
```bash
$ composer create-project symfony/skeleton:"6.1.*" my_project_directory
```
## Running Symfony Applications
- the most convenient way of running Symfony is by using the local web server provided by the symfony binary. This local server provides among other things support for HTTP/2, concurrent requests, TLS/SSL and automatic generation of security certificates.
```bash
$ cd my-project/
$ symfony server:start
```
