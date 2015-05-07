# WordPress Composer Installer

## Important bits during development
- Dependencies of the WordPress plugin need to be installed first. Probably need to bundle these with the plugin out of the box.
- The second install, the one that the WordPress plugin runs, will install the dependencies merged from the `plugins-composer.json` file.
- The `plugins-composer.json` file must be generated based on a loop through all of the (active?) plugins in the website, with paths to each plugins `composer.json` file. Probably making this a separate library for easy maintenance.
- `composer.lock` file must **not** exist, probably delete it before we do our process?
- Process is really expensive and takes a long time. Probably need to put some kind of wizard, progress bar or whatever and make sure it doesn't time out.
- Of course the plugin needs to be structured properly, this is only a proof of concept for now.
- It needs to hook in on plugin activate/deactivate and do its magic there. Manual option to override.