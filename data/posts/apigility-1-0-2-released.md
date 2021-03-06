---
layout: post
title: Apigility 1.0.2 Released!
date: 2014-06-04T20:00:00Z
update: 2014-06-04T20:00:00Z
author: Matthew Weier O'Phinney
url_author: https://mwop.net/
permalink: /blog/apigility-1-0-2-released.html
categories:
- blog
- apigility
- released

---

We are pleased to announce the immediate availability of Apigility 1.0.2!

- <https://apigility.org/download>

This is our second maintenance release of Apigility, fixing a number of issues, and providing significant improvements for file upload capabilities.

Upload Support
--------------

Uploads were possible before this release, but were difficult to properly enable. Additionally, PATCH and PUT requests required manually handling the file uploads, as PHP does not natively support file uploads for those request methods; the Zend Framework 2 InputFilter component, because it utilizes PHP's native support for validating that an upload completed and for moving an upload file to a new location, also could not deal with these methods.

This release makes the following changes in order to facilitate file uploads via your Apigility API:

- Content validation was altered to merge file upload data, when present, with the submitted API fields.
- The Admin UI now allows you to mark a field as representing a file upload; this ensures that content validation will work properly, as content validation differs for file uploads.
- The content negotiation module now provides emulation for PHP's file upload support when receiving PATCH and PUT requests, ensuring that the files are uploaded in the same manner, cleaned up post-request, and passed to validation properly. You should notice no difference between POST, PUT, or PATCH requests when performing file uploads, whether a single or multiple files are provided.

File uploads are only done using the `multipart/form-data` media type. You will need to add that media type to the content negotiation whitelist if you plan to perform file uploads.

If you have further questions, you can [consult the documentation](https://apigility.org/documentation/recipes/upload-files-to-api).

Changelog
---------

While upload support is the major feature of this release, we fixed many other issues.

### General

- All repositories have updated `composer.json` files that properly define the two branch aliases for the `master` and `develop` branches.
- All repositories have updated `README.md` files that provide a "Requirements" section linking to the `composer.json` file.

### zf-apigility-admin

- [Fixes for the "Encrypt" and "Compress" filter adapters](https://github.com/zfcampus/zf-apigility-admin/pull/181), ensuring that these filters can be properly created and configured.
- [Ability to specify file upload fields](https://github.com/zfcampus/zf-apigility-admin/pull/182). A field can now be marked as representing a file upload, ensuring it can then be validated correctly.
- [Fix for unclosed link in authentication screen](https://github.com/zfcampus/zf-apigility-admin/pull/171), which was preventing edits and saves of authentication details.
- [Remove charset option for Postgres adapters](https://github.com/zfcampus/zf-apigility-admin/pull/184), as that adapter does not support setting the character set.
- [Added DSN to DB adapter input filter](https://github.com/zfcampus/zf-apigility-admin/pull/185), so that edits to an existing DB adapter will save when the DSN is provided.
- [Fixes to the DB-Connected service model](https://github.com/zfcampus/zf-apigility-admin/pull/178), to ensure that update data is saved properly.

### zf-apigility-documentation

- [Fixes HTTP status code for POST operations](https://github.com/zfcampus/zf-apigility-documentation/pull/9), to now display `201` as a potential status.

### zf-apigility-skeleton

- [Adds composer.phar to the skeleton](https://github.com/zfcampus/zf-apigility-skeleton/pull/63), since it should have always been there!

### zf-content-negotiation

- [Implements file uploads](https://github.com/zfcampus/zf-content-negotiation/pull/18) [via request body streaming](https://github.com/zfcampus/zf-content-negotiation/pull/20) for PUT and PATCH requests.

### zf-content-validation

- [Ensures file upload data is passed to validation](https://github.com/zfcampus/zf-content-validation/pull/14), which allows validating file uploads.

### zf-deploy

- [Ensures --gitignore flag is passed when copying source tree](https://github.com/zfcampus/zf-deploy/pull/15).

### zf-hal

- [Always store the original entity within ZF\\Hal\\Entity](https://github.com/zfcampus/zf-hal/pull/35), fixing an issue where REST controllers cast entities to arrays prior to creating the `ZF\Hal\Entity` instance, and thus causing listeners on `renderEntity` et. al. to receive data that could never be matched.

### zf-oauth2

- [Pass all OAuth2 adapter options to oauth2-server-php](https://github.com/zfcampus/zf-oauth2/pull/43), enabling the ability to turn on refresh token re-issue, among other things.

Roadmap
-------

Many thanks for all the great issue reports and discussions on the [mailing list](http://bit.ly/apigility-users) and the various issue trackers!

We will do additional maintenance releases on an as-needed basis. The next feature release, 1.1, is in development, and includes:

- Doctrine-Connected REST services
- Database Autodiscovery for REST services (think of this as DB-Connected that finds all your tables and proposes field configuration for you!)
- Mongo-Connected REST services
- HTTP Caching

We would appreciate any feedback you can provide, either in the mailing lists, in issues, or via comments on associated pull requests.

Stay tuned!
