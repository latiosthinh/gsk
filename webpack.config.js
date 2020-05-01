const path = require('path');

module.exports = {
    mode: 'production',
    entry: [
        // path.resolve(__dirname, 'assets/js/elementor/blogposts.js'),
        path.resolve(__dirname, 'assets/js/elementor/bodytype.js'),
        path.resolve(__dirname, 'assets/js/elementor/countdown.js'),
        path.resolve(__dirname, 'assets/js/elementor/customfilter.js'),
        path.resolve(__dirname, 'assets/js/elementor/dealerstory.js'),
        path.resolve(__dirname, 'assets/js/elementor/listings.js'),
        path.resolve(__dirname, 'assets/js/elementor/makeslider.js'),
        path.resolve(__dirname, 'assets/js/elementor/slider.js'),
        path.resolve(__dirname, 'assets/js/elementor/team.js'),
        path.resolve(__dirname, 'assets/js/elementor/testimonial.js'),
        path.resolve(__dirname, 'assets/js/elementor/contact-form.js'),

        path.resolve(__dirname, 'assets/js/auto-listings.js'),
        path.resolve(__dirname, 'assets/js/compare.js'),
        path.resolve(__dirname, 'assets/js/lightbox.js'),

        path.resolve(__dirname, 'assets/js/filter.js'),
    ],
    output: {
        filename: 'auto-listings.min.js',
        path: path.resolve(__dirname, 'assets/js'),
    },
};
