# Rebase

Rebase is not a framework. It's a meta-framework and set of conventions for building large apps in Laravel. I try to codify how I name things and conventions I use below. I should also note that while this is open for anyone to use, it's really _my_ way of doing things, so while I might be open to changes, I may also not be so don't be super-surprised.

# Intended Usage and Project Goals

## Project Goals

1. Not reinvent the wheel every time I build something -- so many times I start a new project and I'm re-doing all this stuff. I don't want to do that any more I want to have a consistent structure, setup, and language between all projects.
2. Make it simple for downstream/upstream communication to occur -- Composer allows me to update my backend dependencies, Yarn allows me to update my front end stuff, but there's this strange middle that doesn't have an easy way of updating and I'm trying to fix that for myself.

The "strange middle" is what occurs if you have large projects built on top of frameworks and you want to use that project. For example, if you want to build your code _on top of_ another project there's no good way to update that code because chances are if you did a `git pull origin` you'd get a ton of conflicts. This means that sharing code between projects becomes more difficult, you'd either have to make everything a composer package...which may not be possible, or you're going to have to copy-and-paste...which sucks.

## Intended Usage

This project will help you build large multi-tenant/multi-database Laravel applications that use the following things:

-  Laravel 8
-  Horizon
-  Cashier
-  InertiaJS
-  VueJS
-  Sass

Could you use Jetstream with this? Maybe? I have no idea because it's not somethig I've tried.

# Installation

Please note: I use Laravel Homestead. All these instructions work for homestead so if you use Docker or Valet or something else I can't help you, but in theory these instructions should be pretty agnostic.

## Step 1: Fork this repository

When starting a new project, the first thing is to fork this repository. This repo needs to become your `upstream primary` so that way you can pull in any changes we make in here.

## Step 2: ENV file Updates

Please look at the `.env.example` file, there's a lot of stuff in there you're going to need in order for this project to work. If I were you, before you do anything I'd copy that over as your `.env` the file itself is commented so you'll have a good understanding of all the fields are and why they're needed.

## Step 3: Install all the things

```
$ composer install && yarn
```

## Step 4: Database

SSH into your homestead and run the following:

```
$ php artisan migrate
```

This is for your `shared` database and won't work unless you've filled out your `.env` file.

## Step 5: Seed

```
$ php artisan db:seed
```

This command is going to take a little bit to run because it generates `workspace` databases so that takes a second or two to run. Like step 4, this won't work if you didn't fill out your `.env` file

# Architecture

```
App
  - http
    - Controller
      - Rebase
        - Legal
        - Registration
        - Foo
        - Workspace
          - Auth
          - Customer
      - AppName
        - Workspace

routes
  - rebase
  - rebase_workspace
  - <your-app>
  - <your-app>_workspace

```

Controller/Rebase/Web/Legal/Privacy.php Controller/AppName/Web/Legal/Privacy

js/Rebase/Web/Legal/Privacy

js/Pages/Rebase/Web/Legal/Privacy.vue js/Components
