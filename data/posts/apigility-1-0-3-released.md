---
layout: post
title: Apigility 1.0.3 Released!
date: 2014-06-05T18:30:00Z
update: 2014-06-05T18:30:00Z
author: Matthew Weier O'Phinney
url_author: https://mwop.net/
permalink: /blog/apigility-1-0-3-released.html
categories:
- blog
- apigility
- released

---

We are pleased to announce the immediate availability of Apigility 1.0.3!

- <https://apigility.org/download>

This is our third maintenance release of Apigility, and the first containing security fixes; read on for more information.

Security Fixes
--------------

We were notified by [Stefano Torresi](https://github.com/stefanotorresi) of a potential security vector in `ZF\Apigility\DbConnectedResource`. While the `create()` method of that class pulls data from the composed input filter, if present, the `patch()` and `update()` methods were not, making it possible for an attacker to send unwanted data to the API service.

We have updated the class to pull from the composed input filter, if present, for each of the `create()`, `patch()`, and `update()` methods.

If you use DB-Connected REST resources in Apigility, we **strongly** recommend updating immediately. You can do so by running `composer update` inside your application.

[Read the security advisory for more details.](/security/advisory/AG2014-01)

Deployment Fixes
----------------

We were notified that the logic for finding a Composer executable in [zf-deploy](https://github.com/zfcampus/zf-deploy) would fail in some situations. A fix was contributed that better resolves the path to the executable, particularly in situations where a `composer.phar` must first be downloaded.

Additionally, in reviewing this fix, [Enrico Zimuel](https://twitter.com/ezimuel) noted that we needed test coverage for most of the ZFDeploy functionality; we now have a comprehensive set of tests, all passing!

Documentation Fixes
-------------------

[Kaloyan Raev](https://github.com/kaloyan-raev) noted that the HTML documentation does not render properly under Internet Explorer, due to the order in which media type selectors are matched. A swap in the order fixes the situation, and continues to work as expected under other browsers.

Thank You!
----------

Many thanks to Stefano Torresi for working with us on the DB-Connected security issue, to Kaloyan Raev for his assistance with zf-deploy and the documentation, and to Enrico Zimuel, for the huge amount of testing he added to zf-deploy!
