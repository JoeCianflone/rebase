# Rebase

This is a meta-framework that I use when I'm working on new applications. I codify all the stuff I do in my apps into one place so I don't have to keep re-inventing the wheel.

## Names

I don't like to think about naming conventions when I'm working on a project. I want names of things to be easy to figure out. This is a simple 1-1 mapping of names for controllers and JS files. This follows a RESTful naming style with some extras that I just know I need.

### `upload`
Upload is used when I have some image processing I need to do before I send it off to its final location. Sometimes the processing is simple, sometimes I need to upload and verify the upload so they need to live in a temp place first.

### `process`
Some routes don't fit the restful names. Some examples include: Login, Payment Processing, Logout. Let's look at a `login` route...sure there's a `IndexLogin` that will show the page, but when you're attempting to log in what are you doing? You're not `Store`-ing the password. What you're doing is trying to process the query that comes in. So for me, `process` routes are those that can't fit into restful routes without sounding stupid.

It should also be noted that this could be a code smell. If you find yourself thinking, "everything here is a `process`" you're probably wrong. 80% of the time everything fits into one of these other routes, so if you're seeing something *not* fit please first ask why. It could be you're trying to do too much.

| Type  | Vue Name      | Controller                    |
|-------|---------------|-------------------------------|
| GET   | Index<name>   | Index<name>Controller         |
| GET   | Index<name>   | Create<name>Controller        |
| POST  |               | Store<name>Controller         |
| GET   | Show<name>    | Show<name>Controller          |
| GET   | Edit<name>    | EditNameController            |
| PATCH |               | Update<name>Controller        |
| DELETE|               | Delete<name>Controller        |
| POST  |               | Upload<name>Controller        |
| POST  |               | Process<name>Controller       |

```bash
php artisan rebase:controller IndexUserController --view
php artisan rebase:view IndexUser --controller
```

## Expressive BEM++

I've experimented with different ways of doing BEM styles and this is what I've come up with that I personally like and use:

First up your standard block/element
`<block>:<element>`

Now a modifier:
`<block>:<element> --<modifier>`
Note the space. Yes, this works but there are some caveats.

I've incorporated media queries because that just makes sense to me:
`<media-query>::<block>:<element>`

### What about individual properties?
There are lots of cases where I just want to override a single property. Text alignment block show/hide and a myriad of other place. How do we do that?

`<prop>|<key>`

This isn't *every* property. You have to decide what you want to create.

### Tee Shirt Sizes?
Some elements have different sizes for different tasks. Like you may want something to have a smaller font size based on something criteria. We could do this through media queries and that might make sense, but when that doesn't there's the `@` sizes we can use:

`font@small`

Tee sizes include:

```
xs, sm, reg, med, lg, xl, xxl
```

These don't make sense for every element, but, there are some cases where this works. Font size is the most obvious.

These can also be combined with media queries:

```html
<div class="xs::font-size@sm sm::font-size@xxl">
```
### Examples

```html
<div class="container --locked">
    <div class="row justify|center">
        <div class="xs::col-12 sm::col-8 wd::col-4-centered xs::text-align|center sm::text-align|left">
            <h3 class="lg::heading@xs xs::heading@lg">Woot</h3>
        </div>
    </div>
</div>
```

## Defining these things

We've got some sass mixins that do all the heavy lifting:

#### Input
```sass
.foo {
    @include e {
        &bar {
            color: red;
        }
    }
}
```
#### Output
```
.foo\:bar {
    color: red;
}
```
#### Usage
```
<div class="foo:bar">...
```

#### Input
```sass
.foo {
    @include m {
        &bar {
            color: red;
        }
    }
}
```
#### Output
```
[class^=foo].\--bar, [class*="::foo"].\--bar {
  color: red;
}
```
#### Usage
```
<div class="foo --bar">...
```
