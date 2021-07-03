# Ultra-Light Framework PHP Project

## Table of contents
1. [Why this project ?](#intro)
2. [How to use it](#how)\
    2.1 [Structure](#how-structure)\
    2.2 [Built-in Functions](#how-functions)
3. [What can you achieve and what you cannot](#what)
4. [Contributors](#contributors) 

## 1. Why this project ?<a name="intro"></a>

There is a massive amount of tools, technologies you can use to build a website. Unlike commonly used PHP frameworks such as [Symphony](https://symfony.com/what-is-symfony) or [Laravel](https://laravel.com/docs/8.x), the U-LF targets young developers or ones who aim to build a structured, tiny project like a résumé or a personal website without the need to download dozens of libraries before writing a single line of code. You can view like an intro to the framework's world, or the result of a guy who passionately hates non-structured code.

## 2. How to use it<a name="how"></a>
Like any librarie and frameworks, there are a couple a things to know to use it properly.
### 2.1 Structure <a name="how-structure"></a>

The U-LF uses an [MVC (Model-View-Controller)](https://www.guru99.com/mvc-tutorial.html) architecture. The project is actually provided with the following folder structure:

- /
   - App/ `Contains all the PHP back-end such as Controllers, Models, Modules...etc`
        - Controller/ `Contains every controllers of the application`
        - Modules/ `Contains all extensions for the project (such as database driver, custom routing, authentication libraries...etc)`
   - config/ `Contains all configuration files of the application. Each file MUST return a PHP associative array`
   - public/ `This is your app web root. It contains all your public resources such as index.php, images, css, js files...`
   - resources/ `Contains front-end resources such as views, languages, view layouts, templates...`
       - layouts/ `Contains all your HTML layouts`
       - views/ `Contains all your HTML views`
   - routes/ `Contains all routes of your application. Each file is considered as it's own namespace.`
   - vendor/ `Will be generated when you first run composer install . It contains all your dependencies. It is recommended to not touch it unless you know exactly what you are doing.`
    
### 2.2 Built-in functions <a name="how-functions"></a>
Usecases define the place where those functions are designed to be called from.

#### Usecase: Generic
- `dd($var)` : Dump debug function. Will stop currently running script and print `$var` value.
- `config($key)` : Call a configuration value. Example: `config("core.paths.controllers")`. Default base path is config/
#### Usecase: Controller
- `view($path)` : Call a front-end HTML view.
#### Usecase : View
- `asset($path)` : Call an asset file (default base path is public/assets).
- `layout($path)` : Call an HTML layout from resources layouts (default base path is resources/layouts).
- `sec($var)` : Sanitize `$var` before displaying it in view, avoiding XSS vulnerabilities.
#### Usecase: Core
- `controller($path)` : Call a controller (default base path is App/Controllers)
- `module($path)` : Call a module file (default base path is App/Modules)

## 3. What can you achieve and what you cannot<a name="what"></a>

This framework targets **tiny projects such as resume, personal websites or young developers** who want to learn with a pre-structured project without the need of having a 6 month course before starting to understand how to use it properly.\
It is **NOT** intended to use it in big or critical projects, you'll need to rewrite the wheel for every single thing you want to achieve and you certainly will fail.

## 4. Contributors<a name="contributors"></a>

I'm the only maintainer of this project and will be.