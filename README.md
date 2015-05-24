# WordPress Composer Installer
**Note:** This is extremely work in progress. Do not attempt to run any of this in production environment, unless you are the adventurous type. :)

## Install and usage
1. Install dependencies of this plugin first, by running `composer install`.
2. Activate the plugin in your WordPress install.
3. Copy the `sample-plugins-composer.json` file and rename it to `plugins-composer.json`. Add paths to the `composer.json` files you want to install the dependencies of. (This step will be automated in [#3](https://github.com/coenjacobs/wordpress-composer-installer/issues/3)).
4. Click on the `Composer install` plugin action link in the Plugins screen. This will install the dependencies required for merging the `composer.json` files.
5. Delete the now generated `plugins-composer.lock` file (This step will be automated in [#2](https://github.com/coenjacobs/wordpress-composer-installer/issues/2)).
6. Click on the `Composer install` plugin action link again, in the Plugins screen. This will install the dependencies of the plugins specified in the `plugins-composer.json` file.
7. The dependencies will now be installed in the `wp-content/vendor/` directory. You can include the autoloader at `wp-content/vendor/autoload.php`.

## Important bits during development
- Process is really expensive and takes a long time. Probably need to put some kind of wizard, progress bar or whatever and make sure it doesn't time out.
- Of course the plugin needs to be structured properly, this is only a proof of concept for now.
- It needs to hook in on plugin activate/deactivate and do its magic there. Manual option to override.
- Ryan McCue has provided a ton of great UI/UX things to look after in code like this: "[How I Would Solve Plugin Dependencies](http://journal.rmccue.io/322/plugin-dependencies/)"
