DiveCatalina.net
===
the '**dev**' folder will be used to develop the HTML, CSS, JavaScript layouts using static pages

the '**docs**' folder will be used to develop the WebMaster Documentation template and also the pages themselves.

'**wp-content**' will replace the one in your local WordPress installation. This  is where we will be developing the WP theme, admin customizations, plugin integration.

'**wp-content/themes/dc-theme**' is where our custom theme will be stored.  This will be constructed from the static pages in '**dev**'.

'**wp-content/plugins/dc-admin**' is where our custom admin theming will be stored.  The style will be derived from the WebMaster Documentation.

the content of the pages themselves can be entered using the WordPress admin interface by creating Pages of the appropriate types. hopefully we can find a better way to do this.  We can potentially just paste the body of a page into a SQL update statement for the wp_posts table.
