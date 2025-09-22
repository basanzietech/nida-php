## NIDA PHP Library (Unofficial)

[![GitHub Release](https://img.shields.io/github/v/release/basanzietech/nida-php?color=blue)](https://github.com/basanzietech/nida-php/releases)
[![Packagist Version](https://img.shields.io/packagist/v/benja/nida-php)](https://packagist.org/packages/benja/nida-php)
[![Packagist Downloads](https://img.shields.io/packagist/dt/benja/nida-php)](https://packagist.org/packages/benja/nida-php)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

**Unofficial package for fetching users information based on National ID Number**  
Created by [Benjamini](https://basanzietech.github.io/benja)

> ⚠️ **Disclaimer:** This is an unofficial package.  
> The NIDA API may change without notice, and the author is not responsible for misuse or incorrect data.  
> Photo and Signature data may not be available due to NIDA privacy restrictions.

---

## 🚀 Requirements / Tools

- **PHP >= 7.4**  
- [Composer](https://getcomposer.org/)  
- [Guzzle HTTP client](https://github.com/guzzle/guzzle) (installed automatically via Composer)  
- Optional: IDE/editor for PHP development (VSCode, PhpStorm, Sublime, etc.)  

---

### 📦 Installation

```bash
composer require benja/nida-php
```
## Copy and Testing
```bash
cp -r ../nida-php/examples ./examples
```
```bash
php examples/test.php
```

Local / Development Install

```bash
git clone https://github.com/basanzietech/nida-php.git
cd nida-php
```

For local testing in another project:

```bash
{
  "repositories": [
    {
      "type": "path",
      "url": "../nida-php"
    }
  ],
  "require": {
    "benja/nida-php": "*"
  }
}
```

🔑 Usage

```bash
<?php
require 'vendor/autoload.php';

use Nida\Nida;

$nida = new Nida();
$user = $nida->loadUser("1999999999999999"); // Replace with valid Tanzanian ID
print_r($user);

Raw JSON Data

$userRaw = $nida->loadUser("1999999999999999", true);
print_r($userRaw);
```

🖼 Photo & Signature

Library tries to decode Photo and Signature into PNG images.

⚠️ Due to NIDA privacy policies, actual ID photos are not provided.

For testing, you can use placeholder images:

```bash
$user['Photo'] = base64_encode(file_get_contents('test-photo.png'));
$user['Signature'] = base64_encode(file_get_contents('test-signature.png'));
```

🔧 Features

Fetch user info from NIDA Tanzania using National ID

Preprocess user data (capitalize keys, decode images if available)

Easy integration with any PHP project via Composer

Return both processed objects and raw JSON


### 🌟 Give it a Star

If this package is useful, give it a ⭐ on GitHub to help others discover it.


### 📝 Contributions

Fork the repo, make improvements, and submit a pull request.

## ⚠️ Disclaimer

This is unofficial. The author is not responsible for incorrect data, API changes, or misuse. Use at your own discretion.

## 📌 Credits

Created by Benjamini

Inspired by Kalebu / Python NIDA library