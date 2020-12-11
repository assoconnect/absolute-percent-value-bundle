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
