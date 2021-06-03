# AbsolutePercentValueBundle

[![Build Status](https://github.com/assoconnect/absolute-percent-value-bundle/actions/workflows/build.yml/badge.svg)](https://github.com/assoconnect/absolute-percent-value-bundle/actions/workflows/build.yml)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=assoconnect_absolute-percent-value-bundle&metric=alert_status)](https://sonarcloud.io/dashboard?id=assoconnect_absolute-percent-value-bundle)

## Installation

```
composer require assoconnect/absolute-percent-value-bundle
```

## To know
An [AbsolutePercentValue](src/Object/AbsolutePercentValue.php) can be used to represent either an absolute value or a percent.

It has two attributes:
* A type which can be either 'PERCENT' or 'ABSOLUTE'
* A value which is a string numeric positive

If the type of the AbsolutePercentValue is 'Percent', then its value must be less than 10000 (100%).
