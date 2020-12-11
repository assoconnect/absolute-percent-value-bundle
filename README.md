# AbsolutePercentValueBundle

[![Build Status](https://travis-ci.org/assoconnect/absolute-percent-value-bundle.svg?branch=master)](https://travis-ci.org/assoconnect/absolute-percent-value-bundle)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=assoconnect-absolute-percent-value-bundle&metric=alert_status)](https://sonarcloud.io/dashboard?id=assoconnectabsolute-percent-value-bundle)

## Installation

```
composer require assoconnect/absolute-percent-value-bundle
```

## To know
An [AbsolutePercentValue](./src/Object/Value.php) can be used to represent either an absolute value or a percent.

It has two attributes:
* a type which can be either 'PERCENT' or 'ABSOLUTE'
* a value, which is a string numeric positive

If the type of the AbsolutePercentValue is 'Percent', then its value must be less than 10000 (100%).

## How-to

* DONE: Update the current README replacing `your-repo` with the real name of your repo
* DONE: Update the [sonar-project.properties](./sonar-project.properties) file replacing `your-repo` with the real name of your repo
* DONE: Update the [composer.json](./composer.json) file replacing `your-repo` with the real name of your repo, and the PSR setting. Add also a description and some keywords

* Create a project at [SonarCloud](https://sonarcloud.io/projects/create) with `assoconnect_your-repo` as key and `your-repo` as display name
* Get a [SonarCloud token](https://sonarcloud.io/account/security/) then add it as the `SONAR_TOKEN` environnement variable on Travis CI at https://travis-ci.com/github/assoconnect/your-repo/settings
* Code must be placed in `src`
* Tests must be placed in `tests`
* Publish it at [Packagist](https://packagist.org/packages/submit)
* Write a relevant README
* Remove this how-to section of the README
