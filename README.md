

# 🥇About the project
**The Car For Rent Symfony project**  is a project to study and practice about symfony framework
# 🎉 Symfony
<p align="center"><a href="https://symfony.com" target="_blank">
    <img src="https://symfony.com/logos/symfony_black_02.svg">
</a></p>

[Symfony][1] is a **PHP framework** for web and console applications and a set
of reusable **PHP components**. Symfony is used by thousands of web
applications and most of the [popular PHP projects][2].
# Getting started
## Setup Environment
- Follow this article to install and learn about symfony 6.1: [Click here](https://symfony.com/doc/current/index.html)
## Technical Requirements
- Install **PHP 8.1** or higher and these PHP extensions (which are installed and enabled by default in most PHP 8 installations): Ctype, iconv, PCRE, Session, SimpleXML, and Tokenizer;
- Install **Composer**, which is used to install **PHP packages***.
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
## Installing Packages
- A common practice when developing Symfony applications is to install packages (Symfony calls them bundles) that provide ready-to-use features.
```bash
$ cd my-project/
$ composer require logger
```

[1]: https://symfony.com
[2]: https://symfony.com/projects
