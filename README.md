# mod_ntprequestghsvs

Just an example repo. A Joomla administrator module that sends a request to a NTP server and outputs the result.

Background:
- A composer package (example https://github.com/krzysztofmazur/ntp-client) is needed but it doesn't match the PHP requiremnets to load it via Composer.
  - The packge requires `PHP 7.0|7.1` but I have `PHP8` running => Composer blocks.
- How to include a local fork of it in this repo here and load my adapted local fork via Composer instead?
- See changed `_composer/packages/krzysztofmazur/ntp-client/composer.json`

```json
{
	"name": "krzysztofmazur/ntp-client",
	"description": "NTP client (cloned by ghsvs.de). Original packege does not support PHP > 7.1",
	"type": "library",
	"homepage": "https://github.com/krzysztofmazur",
	"license": "MIT",
	"authors": [
		{"name": "Krzysztof Mazur", "email": "krz@ychu.pl"}
	],
	"require": {
			"php": ">=7.4"
	},
	"autoload": {
		"psr-4": {
			"KrzysztofMazur\\NTPClient\\": "src/"
		}
	},
	"minimum-stability": "dev",
	"prefer-stable": false
}

```
- See `_composer/composer.json`.

```json
{
	"repositories": [
    {
			"type": "path",
			"url": "./packages/krzysztofmazur/ntp-client",
			"options": {
				"symlink": false
			}
    }
	],

	"require": {
    "krzysztofmazur/ntp-client": "@dev"
	}
}

```

- `_composer/packages/krzysztofmazur/ntp-client/` contains an extracted ZIP of original repo with changed composer.json.

-----------------------------------------------------

# My personal build procedure (WSL 1, Debian, Win 10)

**Build procedure uses local repo fork of https://github.com/GHSVS-de/buildKramGhsvs**

- Prepare/adapt `./package.json`.
- `cd /mnt/z/git-kram/mod_ntprequestghsvs`

## node/npm updates/installation
- `npm run updateCheck` or (faster) `npm outdated`
- `npm run update` (if needed) or (faster) `npm update --save-dev`
- `npm install` (if needed)

## Composer updates/installation
- Check/adapt versions in `./_composer/composer.json`. Something to bump in `vendor/`?

```
cd _composer/

composer outdated

OR

composer show -l
```
- both commands accept the parameter `--direct` to show only direct dependencies in the listing

### Automatically "download" PHP packages into `./_composer/vendor/`

```
cd _composer/
composer install
```

OR
(whenever libraries in vendor/ shall be updated)

```
cd _composer/
composer update
```

## Build installable ZIP package
- `node build.js`
- New, installable ZIP is in `./dist` afterwards.
- All packed files for this ZIP can be seen in `./package`. **But only if you disable deletion of this folder at the end of `build.js`**.

### For Joomla update and changelog server
- Create new release with new tag.
  - See release description in `dist/release.txt`.
- Extracts(!) of the update and changelog XML for update and changelog servers are in `./dist` as well. Copy/paste and necessary additions.
