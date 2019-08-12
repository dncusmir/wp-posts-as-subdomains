# WP posts as subdomains

WP plugin to setup WordPress posts as subdomain.

This is an 'as easy as it gets' plugin: you activate it and permalink is now `http://post_name.site_url` instead of `http://www.site_url/post_name/`.

## Important

Choose `'Post name'` in `'wp admin' > 'settings' > 'permalinks'`.

You must have **wildcard dns** enabled on your server.

Finally in your nginx config add a new server clause:
```
server {
    server_name ~^(www\.)?(?<subdomain>.+)\.site\.url$
}
```
Copy all the stuff from your normal clause, except modify your location  clause like this:
```
location / {
        rewrite ^(.*)/$ /index.php?$args&name=$subdomain last;
}
```
