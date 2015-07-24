CHANGELOG for 2.x.x
===================

## 2.0.0
* [New] datasources: data sources can load site data from certain locations like filesystem or database.
* [New] site structure. See issue #41 (https://github.com/spress/Spress/issues/41).
* [New] datawriter: can persist a rendered site.
* [New] collections: collections allow you to define a new type of document like page or post.
* [New] These events "spress.before_convert", "spress.after_convert" receive a ContentEvent as an argument.
* [New] events: "spress.before_render_blocks", "spress.after_render_blocks", "spress.before_render_page", "spress.after_render_page".
* [Deleted] methods initialize and getSupportExtension of ConverterInterface.
* [Deleted] TemplateManager of plugin API.
* [Deleted] events: "spress.after_convert_posts", "spress.after_render_pagination", "spress.before_render_pagination".