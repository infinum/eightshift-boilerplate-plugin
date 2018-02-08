## Decoupled Json Content 
* Contributors: dingo_bastard, mustra
Donate link: https://infinum.co/
* Tags: json, decoupled, json, content, content, json content, react, angular, speed, fast json
* Tested up to: 4.9.2
* Stable tag: 1.0.0
* Requires at least: 4.4
* Requires PHP: 5.6
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

Very fast "RestApi" for creating your headless WordPress

## Description 

TODO

## Installation 

1. Place `decoupled-json-content` folder in the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Recreate all enpoints in transient cache in Api Settings > Rebuild Cache

# How to use

TODO

## Possible issues 

TODO

## Hooks 
Three hooks are available:
* `djc_set_menu_positions` - set all menu position avaiable on you page and endpoint will be set. Must return array.
* `djc_set_posts_slug` - change page slug for your blog posts. Default is 'blog'
* `djc_set_post_format` - override post format to post json
* `djc_set_page_template` - override page template to page json
* `djc_set_custom_fields` - override custom fields to json
* `djc_set_post_append` - append new data to json. Must be array with key and value.
* `djc_set_allowed_post_types` - set post types you want to use. Default is 'post', 'page'. Must return array.
* `djc_append_endpoints_list` - append data to default endpoints list to show on API's List setting page. Must be multidimensional array with tile and url key.

## More details
Check this blog post:

## Changelog 

= 1.0 =
* Initial release

## Credits 

JSON post parser  is maintained and sponsored by
[Infinum](https://www.infinum.co).

<img src="https://infinum.co/infinum.png" width="264">

## License 

Decoupled Json Content is Copyright © 2017 Infinum. It is free software, and may be redistributed under the terms specified in the LICENSE file.

## Upgrade Notice 
Fixes rare fatal error when using debug log

## Donate
We don't need your donations. Give it to charity instead. And check out our work at [Infinum](https://www.infinum.co).

## Screenshots
1. Settings: List of all avaiable endpoints
2. Settings: Action to rebuild all endpoints to transient
3. Endpoint: Page json endpoint
4. Endpoint: Menu json endpoint
5. Listing: Column added to see if endpoint is cached and avaiable
