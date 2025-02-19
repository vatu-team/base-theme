# Base Theme

[![Commit](https://github.com/vatu-team/base-theme/actions/workflows/commit.yml/badge.svg)](https://github.com/vatu-team/base-theme/actions/workflows/commit.yml)

## Introduction

I'm a 'base theme' template to be used to build custom themes from.
I'm a living project, not to be used as a dependency for your plugin.

My core principles are:

- Keep It Simple
- Object Oriented PHP with features built as Services
- Limited build tools based upon WordPress Scripts
- Vanilla CSS
- Vanilla JS

### How we like to build themes

- Prefer styles over user customisation: Allow the Editor to choose a large hero style over asking them to customise the patterns font size, spacing, alignment
- Prefer patterns over building with blocks: Provide a pattern of blocks over asking the Editor to add multiple blocks
- `Theme.json` should be used as a config file. Not for writing CSS. We like to test our CSS for quality purposes.

## [Documentation](https://github.com/vatu-team/base-themes/blob/trunk/docs/readme.md)

### Directory Structure

The aim of the directory structure for this plugin is to keep everything well-organized.

```sh
├── .github
├── assets
│   ├── css
│   ├── fonts
│   │── js
│   └── svg
├── parts
├── patterns
├── resources
│   ├── css
│   ├── fonts
│   │── js
│   └── svg
├── src
│   ├── Application
│   ├── Domain
│   ├── Infrastructure
│   │── Theme.php
│   └── ThemeFactory.php
├── styles
├── templates
├── tests
├── tools
├── vendor
├── composer.json
├── functions.php
├── package.json
├── style.css
├── theme.json
└── webpack.config.js
```

- `/.github/`
- `/assets/` Compiled assets such as CSS, Fonts, JavaScript, and SVG.
- `/build/` Compiled block assets.
- `/src/`
  - `/src/Application/` Exposes the functionality of the domain to other application layers as hooks and filters (an API).
  - `/src/Domain/` Modules of code based upon the business needs
    - `/src/Domain/Service` A layer which aims to organize the services ito a set of logical layers. Services within a layer share a smilar set of activities.
      - `/src/Domain/Service.php`
  - `/src/Infrastructure/`
  - `/src/Theme.php` This file is respobnsible for loading and instantiating one or more `Service` objects.
  - `/src/ThemeFactory.php`
- `/tests/` Project tests and configutation related to testing the projects.
- `/tools/` Development tools not specific to the project.
- `/base-theme.php` Bootstrap file for WordPress to load.
- `/composer.json` Configuration for our PHP dependencies.
- `/package.json` Configuration for our Node/NPM dependencies.

### Service Structure

A service is a grouping of functionality. An example of a `Service` could include the methods for handling a Form submission along side functionality it needs such as requirement checks, validation, and error handling.

Services can run hooks upon Registration by `implements Registrable`.
This requires a `register()` method be used when WordPress actions and fillters can be added.

## Base Theme Template Development

To start improving **this** template  for the first time:

### Install

```sh
npm install && composer install
```

### Development

- `npm run start` – Watch and compiles the styles and scripts
- `npm run build` – Build a production ready instance of the styles and scripts

## Test

Build a test instance of WordPress to test this theme.

- `npm run wp-env start` – Start the development environment
- `npm run wp-env start -- --xdebug` – Start the development environment with xDebug configured
- `npm run wp-env stop` – Stop the development environment
- `npm run wp-env distroy` – Distroy the development environment

## Install in project

```sh
composer create-project vatu/base-theme public/app/themes/{project-name} -s dev --no-install
```
