# pf-leconte

[![CircleCI](https://circleci.com/gh/Orange142/pf-leconte.svg?style=shield)](https://circleci.com/gh/Orange142/pf-leconte)
[![Dashboard pf-leconte](https://img.shields.io/badge/dashboard-pf_leconte-yellow.svg)](https://dashboard.pantheon.io/sites/b6c1226d-5d5e-4509-b693-8b7a34b275d6#dev/code)
[![Dev Site pf-leconte](https://img.shields.io/badge/site-pf_leconte-blue.svg)](https://dev-pf-leconte.pantheonsite.io/)

## Workflow
Development workflow follows the below path:

1. **Lando:** Start development by coding and testing on the local Lando environment.
3. **GitHub branch with pull request:** Once the code is ready for review, then commit code to a branch and create a pull request to the master branch.
   - When a pull request is made, CircleCI will run tests and create a pantheon multi-dev site using the branch.  
5. **Github (Master branch):** After code is reviewed and ready for release, then pull request will be merged into master branch.
6. **CircleCI:** When code is added to the master branch then CircleCI will build code using composer and deploy to [Pantheon dev site](https://dev-pf-leconte.pantheonsite.io/).
7. **Pantheon:** The Pantheon dev site will reviewed and then Pantheon deploy controls will be used to push to test and live sites. 


## Lando - Local Development
This site uses lando to replicate the site for local development. View [local development procedures](https://docs.google.com/document/d/10vDtmE5QtqwGQg3yMuAZF4Xxa6pVG3s3A_xnO2v6OsM/edit?usp=sharing) for installation and usage tips.

First time lando run requires a couple of steps.
1. Run `lando start` to start Lando.
2. Run `lando composer install --no-ansi --no-interaction --optimize-autoloader --no-progress` to download dependencies
   - You may receive an error when running this command that is centered around the commands located at `/scripts/composer/cleanup-composer` . To get the lando site working, you will need to manually complete the steps in those commands.
      1. Copy contents of `web/wp/wp-content/mu-plugins/` to `web/wp-content/mu-plugins/`
      2. Delete file `web/wp/wp-config.php`
      3. Delete folder `web/wp/wp-content`
3. Run `lando pull --code=none` to download the media files and database from Pantheon.
4. Visit the [local site URL](https://usopm-2021.lndo.site/)

## Themes and Plugins
Contributed themes and plugins should be added to the composer.json using the following commands
* for plugins `lando composer require wpackagist-plugin/[plugin-slug]`
* for themes `lando composer require wpackagist-theme/[theme-slug]`

Paid plugins or themes will need to be added to https://dev-o142-satispress.pantheonsite.io/ and then added to composer using
* for plugins `lando composer require satispress/[plugin-slug]`
* for themes `lando composer require satispress/[theme-slug]`

To remove a plugin or theme use
`lando composer remove [namespace]/[slug]`

Custom themes and plugins should be added to the file structure and then the folder excluded from the gitignore.
* gitignore example: `!web/wp-content/themes/lecontecenter`
