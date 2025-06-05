# SVG Sprites

We prefer to use external SVG sprite where possible over including SVG's inline through base encoding.

## Create a new sprite

1. Add a new SVG Spritemap Plugin to the webpack config:

```js
new SVGSpritemapPlugin(
  ['resources/svg/{sprite-name}/*.svg'],
  {
    input: {},
    output: {
      filename: '/svg/{sprite-name}.svg',
      svg: {},
      svgo: true,
    },
    sprite: {
      prefix: false,
      gutter: false,
      generate: {
        title: false,
      }
    }
  }
),
```

## Adding an SVG to the sprite

1. Place the SVG file inside the sprite directory, `./resources/svg/{sprite-name}/{filename}.svg`.
2. Run the `npm run build` command to compile the SVG sprite.
3. Your SVG will be added to the sprite at `./assets/svg/{sprite-name}.svg`.

## Using an image from the sprite

```php
printf(
  '<svg aria-hidden="%3$s"><use xlink:href="%1$s"><title>%2$s</title></use></svg>',
  esc_url( get_stylesheet_directory_uri() . '/assets/svg/{sprite-name}.svg#{sprite}' ),
  esc_html__( '{Sprite}', 'base-theme' ),
  'true'
);
```
