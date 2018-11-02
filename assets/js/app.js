'use strict';

var $ = require('jquery');
require('gwwp');

var svg4everybody = require('svg4everybody');
$(window).on('load', function () {
    svg4everybody();
});

require('./ajax_filter');
require('./piechart.js');