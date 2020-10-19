# Rebase

Rebase is not a framework. It's a meta-framework and set of conventions for building large apps in Laravel. I try to codify how I name things and conventions I use below. I should also note that while this is open for anyone to use, it's really _my_ way of doing things, so while I might be open to changes, I may also not be so don't be super-surprised.

# Intended Usage and Project Goals

## Project Goals

1. Codify all my own "unwritten rules" -- too many projects are built on the idea of "that's how I do things" and that doesn't scale.
2. Use Laravel -- I don't want to have a whole new `src` folder that is really just a drop in replacement for the `app` folder, I want to use what Laravel is giving me.
3. Make it simple for multi-app downstream/upstream communication to occur -- Composer allows me to update my backend dependencies, Yarn allows me to update my front end stuff, but there's this middle that doesn't have an easy way of updating and I'm trying to fix that for myself.
4. Make it simple to override and customize your app -- updates are important, but so is making sure this is flexible enough to be able to pick-and-choose the parts you want and override the parts you don't.

### The Middle = Your App

You might be thinking, "well, the so-called middle here is really just your application...why do you need this?" and you're right...if you only plan on building one app, or you're working with microservices...but what happens if you have to maintain 3 or 4 different applications that are not tied together and cannot share a common set of microservices? That's the problem I'm trying to fix for myself. So, in this particular case, the middle is really the set of code/components that are common to all your app designs.

## Intended Usage

This project will help you build large multi-tenant/multi-database Laravel applications that use the following things:

-  Laravel 8
-  Horizon
-  Cashier
-  InertiaJS
-  VueJS
-  Sass

Could you use Jetstream with this? Maybe? I have no idea because it's not somethig I've tried and I do not have any plans on trying it. I'm not a Jetstream hater, I think it's awesome, I just don't plan on using it.

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

The main thrust of this whole design is to make it dead simple to upgrade and share code between mulitple large multi-tenant applications and to make sure it's simple to override/exclude things from upstream too. In order to do this, we need to segment everyting into its own folder/namespace. An example of what I mean is the `Console` folder. Take a look below (or in the code itself)

```
- App
  - Console
    - Commands
      - Rebase
        - ...
```

All the code lives inside the `Rebase` directory when you fork this repo, these commands will just work and you don't need to do anything, if you need to modify or add your own commands, you can! Just create a new folder named after YOUR APP and put them in there:

```
- App
  - Console
    - Commands
      - Rebase
        - ...
      - FoobarApp
        - ...
```

## Routes

Routes are also segmented, but because a folder feels like overkill we have just pre-pended `rebase_` to the file names.

```
  - rebase_web
  - rebase_workspace
  - <your-app>_web
  - <your-app>_workspace
```
