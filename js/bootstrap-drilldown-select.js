/*!
 *
 * jQuery Multilevel Dropdown
 *
 * Version: 0.3
 * Author: David Riedl
 * Website: http://daves-weblab.com
 *
 */

(function ($) {
    // configuration
    var config = {
        // different class names
        classNames: {
            root: 'multilevel-dropdown',
            children: 'has-children',
            reset: 'multilevel-dropdown-reset',
            levelReset: 'multilevel-dropdown-level-reset',
            open: 'open',
            active: 'active',
            container: 'multilevel-dropdown-container',
            level: 'multilevel-dropdown-level',
            item: 'multilevel-dropdown-item',
            displayValue: 'multilevel-dropdown-value'
        },

        // data attributes for the dropdown
        data: {
            data: 'dropdown-data',
            name: 'dropdown-name',
            value: 'dropdown-value'
        }
    };

    // various templates
    var templates = {
        container: '<div class="'+ config.classNames.container +'"></div>',
        display: '<div class="multilevel-dropdown-display"><span class="multilevel-dropdown-value"></span> <i class="multilevel-dropdown-arrow fa fa-angle-down"></i></div>',
        level: '<ul class="' + config.classNames.level + '"><li class="' + config.classNames.levelReset + '">##label##</li></ul>',
        item: '<li class="' + config.classNames.item + '"></li>',
        select: '<select class="multilevel-dropdown-select"></select>'
    };

    /**
     * MultilevelDropdown, stored in the jQuery element, object oriented prototyping
     *
     * @param obj
     *  the jQuery element
     *
     * @param options
     *  the object for construction
     *
     * @constructor
     */
    var MultilevelDropdown = function (element, options) {
        if(!element.is('ul')) {
            // element is no <ul> treat it as a container
            this.$container = element.addClass(config.classNames.container);

            this.$ = this.$container.children('ul');

            if(this.$.length == 0) {
                this.$ = $('<ul>');
                this.$container.append(this.$);
            }
        } else {
            // element is a <ul>, create a container for it
            this.$ = element;

            // create container element
            this.$container = $(templates.container);
            //prepend it in the DOM
            this.$.before(this.$container);

            // move the dropdown inside the container
            this.$.appendTo(this.$container);
        }

        this.$trigger = element;

        // default options
        this.options = {
            name: element.data(config.data.name),
            value: element.data(config.data.value),
            labels: {
                reset: '<i class="fa fa-trash"></i>',
                close: '<i class="fa fa-angle-left"></i>',
                placeholder: element.data('dropdown-placeholder') || 'select a value'
            }
        };

        // override options
        $.extend(true, this.options, options);

        this.$display = $(templates.display);
        this.$displayLabel = this.$display.find('.' + config.classNames.displayValue).html(this.options.labels.placeholder);
        this.$container.prepend(this.$display);

        this.bindDisplayEvent();

        // store jQuery element internal
        this.$.addClass(config.classNames.root);

        this.$select = this.$container.find('select');

        // check if select exists in the container
        if(this.$select.length == 0) {
            // create select and prepend it in the container
            this.$.before(this.$select);
        }

        if(!this.$select.attr('name')) {
            this.$select = $(templates.select).attr('name', this.options.name);
        }

        // override the level template's close items
        templates.level = templates.level.replace('##label##', this.options.labels.close);

        // read data if none has been given for construction
        if (!this.options.data) {
            this.options.data = [];

            this.readData(this.$.children(), this.options.data);
        }

        // prepend a reset button
        this.options.data.unshift({
            label: this.options.labels.reset,
            value: ''
        });

        // build the dropdowns HTML
        this.buildDropdown();

        // set a selected value if one has been given
        if (this.options.value) {
            this.setValue(this.options.value, false);
        }
    };

    MultilevelDropdown.prototype.bindDisplayEvent = function() {
        var scope = this;

        this.$display.on('click', function() {
            scope.$.toggleClass(config.classNames.open);
        });
    };

    /**
     * read data from the dropdown's original DOM
     *
     * @param $items
     *  current level
     *
     * @param data
     *  array to append read data to
     */
    MultilevelDropdown.prototype.readData = function ($items, data) {
        var scope = this;

        $items.each(function () {
            var $item = $(this);

            if ($item.is('li')) {
                // <li> defines a simple element
                // push it on the data array
                data.push({
                    label: $item.html(),
                    value: $item.data('value')
                });
            } else if ($item.is('ul')) {
                // <ul> defines another level
                var item = {
                    label: $item.data('label'),
                    children: []
                };

                // push level on the data array
                data.push(item);

                // read its children recursively
                scope.readData($item.children(), item.children);
            }
        });
    };

    /**
     * builds the dropdowns HTML
     */
    MultilevelDropdown.prototype.buildDropdown = function () {
        // empty current dropdown
        this.$.empty();

        // build the levels
        this.buildLevel(this.$, this.options.data);
        // reset items (maybe some were added)
        this.$items = this.$.find('ul, li');

        // bind events
        this.bindEvents();
    };

    /**
     * build on HTML level of the dropdown
     *
     * @param $level
     *  current level in the dropdown
     *
     * @param data
     *  items on this level
     */
    MultilevelDropdown.prototype.buildLevel = function ($level, data) {
        var item, $item, $ul;

        for (var i = 0; i < data.length; i++) {
            item = data[i];

            if (item.children) {
                // the item is a new level
                // create a new level and append it
                $ul = $(templates.level);

                $item = $(templates.item)
                    .addClass(config.classNames.children)
                    .html(item.label)
                    .append($ul);

                // build its child levels recursively
                this.buildLevel($ul, item.children);
            } else {
                // the item is a simple item
                $item = $(templates.item)
                    .data('value', item.value)
                    .html(item.label);

                // if it's value is false, it is defined as a reset button
                if (item.value === '') {
                    $item.addClass(config.classNames.reset);
                }

                // check if select already has the value
                if(this.$select.find('option[value="'+ item.value +'"]').length == 0) {
                    // add the new option to the internal select, so the value is able to be selected
                    this.$select.append('<option value="' + item.value + '">' + item.label + '</option>');
                }
            }

            // append level to the dropdown
            $level.append($item);
        }
    };

    /**
     * bind click events to the dropdown
     */
    MultilevelDropdown.prototype.bindEvents = function () {
        var scope = this;

        this.$items.on('click', function (event) {
            event.stopPropagation();

            var $item = $(this);

            if ($item.hasClass(config.classNames.children)) {
                // item is a level
                if ($item.hasClass(config.classNames.open)) {
                    // level was open, close it
                    $item.removeClass(config.classNames.open);
                } else {
                    // level was closed

                    // close all levels
                    scope.$items.removeClass(config.classNames.open);

                    // open this levels parents
                    $item.parents('.' + config.classNames.children).addClass(config.classNames.open);

                    // open this level
                    $item.addClass(config.classNames.open);

                    // TODO responsive logic
                    // TODO rearrange depending on screen size and position
                    $item.children('.' + config.classNames.level).css('left', $item.outerWidth());
                }
            } else if($item.hasClass(config.classNames.levelReset)) {
                // item is a level reset
                // just close this level
                $item.closest('.' + config.classNames.children).removeClass(config.classNames.open);
            } else {
                // item was a simple item
                // set the new value
                scope.setValue($item.data('value'), true);
                scope.close();
            }
        });
    };

    MultilevelDropdown.prototype.addDataset = function (dataset) {
        // TODO
    };

    MultilevelDropdown.prototype.open = function() {
        this.$.addClass(config.classNames.open);
    };

    MultilevelDropdown.prototype.close = function() {
        this.$.removeClass(config.classNames.open);
    };

    MultilevelDropdown.prototype.toggle = function() {
        this.$.toggle();
    };

    /**
     * get the value from the internal select
     *
     * @returns {*}
     */
    MultilevelDropdown.prototype.getValue = function () {
        return this.$select.val();
    };

    /**
     * set the value of the dropdown, also sets the value
     * in the internal select
     *
     * @param value
     *  the value to set
     */
    MultilevelDropdown.prototype.setValue = function (value, trigger) {
        var scope = this,
            found = false;

        this.$items.each(function() {
            var $item = $(this);

            if ($item.data('value') === value) {
                found = true;
                $item.addClass(config.classNames.active);
                $item.parents('.' + config.classNames.children).addClass(config.classNames.active);
                scope.$select.val(value);
                scope.setDisplayLabel($item.html());
            } else {
                $item.removeClass(config.classNames.active);
            }
        });

        if(!value || !found) {
            this.setDisplayLabel(this.options.labels.placeholder);
            this.$select.val('');
        }

        if(trigger) {
            this.$trigger.trigger('change');
        }
    };

    MultilevelDropdown.prototype.setDisplayLabel = function(label) {
        this.$displayLabel.html(label);
    };

    /**
     * get the MultilevelDropdown object of this jQuery element
     *
     * @returns {MultilevelDropdown}
     */
    MultilevelDropdown.prototype.getDropdown = function() {
        return this
    };

    // old val hook for ul elements
    var ulHook = $.valHooks.ul;

    /**
     * override the ul hook
     *
     * @type {{get: Function, set: Function}}
     */
    $.valHooks.ul = {
        get: function (el) {
            var $el = $(el);

            if ($el.hasClass(config.classNames.root)) {
                return $el.multilevelDropdown('getValue');
            } else if(ulHook) {
                // call old ul hook
                return ulHook.get(el);
            }
        },

        set: function (el, val) {
            var $el = $(el);

            if ($el.hasClass(config.classNames.root)) {
                $el.multilevelDropdown('setValue', val);
            } else if(ulHook) {
                // call old ul hook
                ulHook.set(el, val);
            }

            return el;
        }
    };

    // old val hook for div elements
    var divHook = $.valHooks.div;

    /**
     * override the div hook, if a container was used to initialize the plugin
     *
     * @type {{get: Function, set: Function}}
     */
    $.valHooks.div = {
        get: function (el) {
            var $el = $(el);

            if ($el.hasClass(config.classNames.container)) {
                return $el.multilevelDropdown('getValue');
            } else if(divHook) {
                // call old ul hook
                return divHook.get(el);
            }
        },

        set: function (el, val) {
            var $el = $(el);

            if ($el.hasClass(config.classNames.container)) {
                $el.multilevelDropdown('setValue', val);
            } else if(divHook) {
                // call old ul hook
                divHook.set(el, val);
            }

            return el;
        }
    };

    $.fn.multilevelDropdown = function (parameter) {
        if(this.length == 0) return;

        var returnValue = null;

        this.each(function() {
            if(returnValue === null) {
                var $this = $(this);
                var dropdown = $this.data('multilevel-dropdown');

                if (dropdown && dropdown[parameter]) {
                    // dropdown was constructed, and a valid method was given
                    returnValue = dropdown[parameter].apply(dropdown, Array.prototype.slice.call(arguments, 1));
                } else if (!dropdown) {
                    // dropdown was not constructed yet
                    $this.data('multilevel-dropdown', new MultilevelDropdown($this, parameter));
                }
            }
        });

        if(returnValue !== null) return returnValue;

        return this;
    }

    $(function() {
        $('[data-multilevel-dropdown]').multilevelDropdown();
    });
})(jQuery);