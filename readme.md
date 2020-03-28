# Rebase

Rebase is not a framework. It's a meta-framework and set of conventions for building large apps in Laravel. I try to codify how I name things and conventions I use below. I should also note that while this is open for anyone to use, it's really _my_ way of doing things, so I am probably not open to changes, but I'd be happy to talk about them with anyone who has a question. If you don't like this that's totally fine too, you don't need to use this.

## This is a WIP

If you're looking at this, cool, but there's a lot I've left out and I know it's not there at the moment. I've got a running list, please don't ask/tell me stuff, I know. :)

## Directory Changes

There are no directory changes from a base Laravel standpoint. All folders are additive but more about organization, I did not and will not be changing the `app` folder. I get why some people think that's a good idea, but I'm personally against it. Why? Because it's just _one more thing_ I need to teach another developer. I've build some rather large Laravel projects the base structure is fine! When you move things, you now gotta remember where you put it and why, that's overhead you don't need.

### New Folders

All that being said, I did **add** folders, because adding folders makes perfect sense! Folders keep your code organized. So here are some new folders:

-   app

    -   Actions -- Actions are single action specific classes that do one thing See `GetView`
    -   Domain -- I think this makes sense, but I consider my domain to be my `models` and `repositories` that act on those models
        -   Models -- Eloquent models
        -   Repositories
            -   Facades -- Yes, I use facades for my `repositores` suck it, I love them.
    -   Enums
    -   Helpers -- A group of functions that help you in some way. See `DBWorkspace` for more understanding

-   database

    -   migrations
        -   shared -- these migrations run on the `shared` DB
        -   workspace -- these migrations run on the individual workspaces

-   stubs -- These are where I keep my stubs/overrides

## What this should and should not do

This isn't a full or complete application. This should do just the basics

## Controller/View Names

While this does follow some basic RESTful conventions. This is not a RESTful API. These are URL's so we don't need to feel compelled to stick to a REST convention if/when it doesn't make sense, but generally these are the conventions that Laravel uses for Resource Controllers so these are the default names we start with:

| Method    | URI                  | Name/Key       | Controller Name | View Name    |
| --------- | -------------------- | -------------- | --------------- | ------------ |
| GET       | /photos              | photos-index   | PhotosIndex     | PhotosIndex  |
| GET       | /photos/create       | photos-create  | PhotosCreate    | PhotosCreate |
| POST      | /photos/store        | photos-store   | PhotosStore     | -            |
| GET       | /photos/{photo}      | photos-show    | PhotosShow      | PhotosShow   |
| GET       | /photos/{photo}/edit | photos-edit    | PhotosEdit      | PhotosEdit   |
| PATCH/PUT | /photos/{photo}      | photos-update  | PhotosUpdate    | -            |
| DELETE    | /photos/{photo}      | photos-destroy | PhotosDestroy   | -            |

### But these _are_ using restful conventions...so...wat?

Look the basics of RESTful naming make sense, I'm not saying they don't. So using the names is a great idea, _when they make sense to use._ Depending on the app you're building conventions you'll need to think through your own conventions, so don't become a REST-crazed nutter. Here are some names I use all the time that don't fit but work!

| Method | URI     | Name/Key       | Controller Name | View Name  |
| ------ | ------- | -------------- | --------------- | ---------- |
| GET    | /login  | login          | LoginIndex      | LoginIndex |
| POST   | /login  | process-login  | ProcessLogin    | -          |
| POST   | /logout | process-logout | ProcessLogout   | -          |

### `process` Controllers

There are some controllers that will never `store` or `update` the database in any way. They process data in some way, but that's about all they do. I think a great example of this is Login/Logout. You're not storing anything, you're just checking the data you're given. I guess you could name it something like `PostLogin` or `PostLogout` and `post.login` but why are we tying it to a method name? Just call-it-like-it-is: processing.

In case you're thinking, "login and logout are the only examples where this would make sense," I could make an argument for payments. Some people could make the argument that you're "updating the account" and that may very well be the case. But sometimes a payment is one-off, maybe the account doesn't get updated, or maybe your app does something where you need to FIRST process a payment THEN hand off control to something else before you update. Bottom line, you could have 1000 different things going on before an account update should ever happen. In that case, maybe `process` is the right name. All I'm saying is, this document doesn't prescribe anything in particular

## New Commands

Some of these commands are overrides of standard Laravel commands and some of these are new.

| Command                 | Description                                                                                 |
| ----------------------- | ------------------------------------------------------------------------------------------- |
| `make:model`            | Generates a model                                                                           |
| `make:controller`       | Generates a controller                                                                      |
| `make:view`             | Generates an Inertia view file                                                              |
| `make:inertia-resource` | Generates a resource file                                                                   |
| `make:repository`       | Will generate a new repository and give you the code you need to add to the ServiceProvider |
| `db:migration`          | Runs all the migrations either on shared, workspace or both                                 |
| `db:explode`            | _WILL ONLY RUN LOCALLY_ drops all Workspace DB's and refreshes the Shared DB                |
| `db:rollback`           | Rolls back the last migration either on shared, a single workspace, or all workspaces       |
| `assets:compile`        | Packages and compiles all the code                                                          |
| `assets:watch`          | Runs a watcher over JS and Sass                                                             |
| `account:new`           | A CLI way of creating a new workspace, good for spinning up tests and such                  |
