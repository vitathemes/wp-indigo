# WP-Indigo - [Demo](https://demo.vitathemes.com/indigo/)
WP-Indigo is a WordPress minimal theme.

It's based on the [indigo](https://github.com/sergiokopplin/indigo) that orginally build for Jekyll.

## Features
* Sass for stylesheets
* Compatible with Contact Form 7
* Fast & lightweight (Google Speed: 94/100)

See a working example at [demo.vitathemes.com/indigo](https://demo.vitathemes.com/indigo/).

## Theme installation
Simply go to WordPress Admin Panel->Appearance->Themes->Add New and search "WP-Indigo" then click on the Install buttom.

Or download the latest version from WordPress.org and upload it from admin panel or extract files into the themes folder.

## Theme structure

```shell
themes/wp-indigo/  	      # → Root of your theme
├── assets/               # → Assets files
│   ├── css/      		      # → Compiled CSS file
│   ├── images/           # → Theme images
│   └── sass/      	      # → Theme scss files
├── composer.json         # → Autoloading for `vendor/` files
├── composer.lock         # → Composer lock file
├── languages/            # → Theme Language files
├── template-parts/       # → Theme Part files (Include)
├── node_modules/         # → Node.js packages
├── vendor/    		         # → Third Party Packages (Managed by Composer, Currently we use Kirki Framework for customizer)
├── package.json          # → Node.js dependencies and scripts
├── inc/              		  # → Theme functions
│   ├── classes/      		  # → Custom PHP classes
│   ├── customizer.php    # → All codes related to WordPress Customizer (We use Kirki Framework)
│   ├── template-functions.php    # → Custom template tags & tweaks
│   └── setup.php         # → Theme Setup
└── page-templates/       # → Page Templates
```

## Theme setup

Edit `inc/setup.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, and sidebars.

## Theme development

## Contributing

Contributions are welcome from everyone. We have [contributing guidelines](CONTRIBUTING.md) to help you get started.

## License

WP-Indigo is licensed under [MIT](LICENSE).
