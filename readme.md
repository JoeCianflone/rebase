# Rebase

## BEM++

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


### Examples

```html
<div class="container --locked">
    <div class="row justify|center">
        <div class="xs::col-12 sm::col-8 wd::col-4-centered xs::text-align|center sm::text-align|left">
            <h3>Woot</h3>
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
