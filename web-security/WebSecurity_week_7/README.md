# Project 7 - WordPress Pentesting

Time spent: **5** hours spent in total

> Objective: Find, analyze, recreate, and document **three vulnerabilities** affecting an old version of WordPress

## Pentesting Report

1. Vulnerability one: Cross site scripting vulnerability in posting a link
  - [x] Summary: By placing a javascript event in a hyperlink this can allow a user to issue a cross site
                 scripting attack on the vulnerable website. Using the onmouseover event attribute.
    - Vulnerability types: XSS
    - Tested in version: 4.2
    - Fixed in version: 4.7
  - [x] GIF Walkthrough: http://imgur.com/HC8B5CF
  - [x] Steps to recreate: embed a link in the post section from the admin page.

2. Vulnerability two: Cross site scripting by embedding an img tag 
  - [x] Summary: Embedded an img tag in the body of a WordPress post in order to trigger an xss attack.
    - Vulnerability types: XSS
    - Tested in version: 4.2
    - Fixed in version: 4.7
  - [x] GIF Walkthrough: http://imgur.com/rVXb2NZ
  - [x] Steps to recreate: Embed img tag in body of a post

3. Vulnerability three: Cross site scripting by embedding link in title of post.
  - [x] Summary: Embedded a link in the title of a post in order to trigger an xss attack.
    - Vulnerability types: XSS
    - Tested in version: 4.2
    - Fixed in version:  4.7
  - [x] GIF Walkthrough: http://imgur.com/ukLUcGI
  - [x] Steps to recreate: Embed link in the title of a post.


## Assets


## Resources

- [WordPress Source Browser](https://core.trac.wordpress.org/browser/)
- [WordPress Developer Reference](https://developer.wordpress.org/reference/)
- https://wpvulndb.com/vulnerabilities/8615
-  https://wordpress.org/news/2016/09/wordpress-4-6-1-security-and-maintenance-release/
- https://github.com/WordPress/WordPress/commit/c9e60dab176635d4bfaaf431c0ea891e4726d6e0
-  https://sumofpwn.nl/advisory/2016/persistent_cross_site_scripting_vulnerability_in_wordpress_due_to_unsafe_processing_of_file_names.html
- http://seclists.org/fulldisclosure/2016/Sep/6
- https://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2016-7168

GIFs created with [LiceCap](http://www.cockos.com/licecap/).

## Notes
First time trying to recreate xss exploits directly from the browser.

## License

    Copyright [yyyy] [name of copyright owner]

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
