const mix = require('laravel-mix');

mix.webpackConfig({
	stats: {
		children: true
	}
});

// JS
// ToDo: Remove comment for compile JS
mix.js('js/modules/*.js', 'js/wcl-functions.js');

// SCSS
mix.options({
	// Don't perform any css url rewriting by default
	processCssUrls: false,
	postCss: [
		// Adding vendor prefixes to CSS
		require('autoprefixer'),
		// Grouping styles by media queries
		require('postcss-sort-media-queries'),
	],
})

mix.sass('scss/wcl-style.scss', 'css')
	.sourceMaps();

mix.sass('scss/wcl-admin-style.scss', 'css')
	.sourceMaps();

// ACF Blocks
// ToDo: Remove comment for compile ACF blocks SCSS

mix.sass('template-parts/acf-blocks/acf-block-1/acf-block-1.scss', 'template-parts/acf-blocks/acf-block-1')
	.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-2/acf-block-2.scss', 'template-parts/acf-blocks/acf-block-2')
	.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-3/acf-block-3.scss', 'template-parts/acf-blocks/acf-block-3')
	.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-4/acf-block-4.scss', 'template-parts/acf-blocks/acf-block-4')
	.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-5/acf-block-5.scss', 'template-parts/acf-blocks/acf-block-5')
	.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-6/acf-block-6.scss', 'template-parts/acf-blocks/acf-block-6')
	.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-7/acf-block-7.scss', 'template-parts/acf-blocks/acf-block-7')
	.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-8/acf-block-8.scss', 'template-parts/acf-blocks/acf-block-8')
	.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-9/acf-block-9.scss', 'template-parts/acf-blocks/acf-block-9')
	.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-10/acf-block-10.scss', 'template-parts/acf-blocks/acf-block-10')
	.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-11/acf-block-11.scss', 'template-parts/acf-blocks/acf-block-11')
.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-12/acf-block-12.scss', 'template-parts/acf-blocks/acf-block-12')
.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-13/acf-block-13.scss', 'template-parts/acf-blocks/acf-block-13')
.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-14/acf-block-14.scss', 'template-parts/acf-blocks/acf-block-14')
.sourceMaps();

mix.sass('template-parts/acf-blocks/acf-block-15/acf-block-15.scss', 'template-parts/acf-blocks/acf-block-15')
.sourceMaps();




