(function(api, wp, $) {
    'use strict';






    api.RepeaterControl = api.RepeaterControl || {};

    api.RepeaterControl = api.Control.extend({
        ready: function ready() {

            wp.customize.control.each(function(control) {
                // console.log(control);
            });



            var control = this;

            _.bindAll(this, 'addRepeaterRow', 'deleteRepeaterRow', 'createRowSetting', 'normalizeSaveRequestQuery');

            this.STATE = [],
                this.fieldQueryPattern = new RegExp('^' + control.id + '_(\\d+)_(\\S+)$');
            this.rowPrototype = this.container.find('.customize-control-repeater-field-popup.prototype').remove().clone().removeClass('prototype')
            this.btnNew = this.container.find('.customize-add-repeater-field-popup');

            this.setupRepeaterRows();

            // Remove repeater fields from save request (@todo: Is there a better way?)
            api.bind('save-request-params', this.normalizeSaveRequestQuery);

            this.btnNew.on('click', this.addRepeaterRow);
            this.container.on('click', '.customize-control-repeater-field-popup .menu-item-handle-popup', this.toggleFieldSettings);
            this.container.on('click', '.customize-control-repeater-field-popup .item-delete-popup', this.deleteRepeaterRow);

            // on sortable change

            $('.customize-control-content').sortable({
                axis: 'y',
                update: function() {

                    control.saveData();

                }
            });


        },

        saveData: function() {

            // wp.customize.previewer.refresh();
            // person_name
            var control = this,
                rows;

            try {
                rows = JSON.parse(control.setting.get());
                console.log(rows);
            } catch (e) {
                return false;
            }

            $.each(rows, function(index, value) {
                control.addRepeaterRow(rows);

            });
            console.log('data saved');

        },
        setupRepeaterRows: function() {
            var control = this,
                rows;

            try {
                rows = JSON.parse(control.setting.get());
                console.log(rows);
            } catch (e) {
                return false;
            }

            $.each(rows, function(index, value) {
                control.addRepeaterRow(rows);

            });
        },

        addRepeaterRow: function(event) {
            var control = this,
                Constructor, Control, options, size, index, row, setting, stateField, initialState, fieldLabel;

            if (!(event instanceof Event)) {
                initialState = event;
            }

            size = control.STATE.push({});
            index = size - 1;
            stateField = control.STATE[index];

            row = control.rowPrototype.clone().insertBefore(control.btnNew);
            row.data('index', index);

            fieldLabel = row.find('.menu-item-title-popup');

            // console.log('Fields');
            // console.log(control.params.fields);



            $.each(control.params.fields, function(key, field) {

                console.log(field);

                var id, defaultValue = '',
                    label;

                if (initialState && initialState[index] && initialState[index].hasOwnProperty(key)) {
                    defaultValue = initialState[index][key];
                }

                // Set id
                id = control.id + '_' + index + '_' + key;

                // Create new setting
                setting = control.createRowSetting(id, defaultValue);

                stateField[key] = setting.get();

                // Watch setting
                setting.bind(_.bind(control.watchFieldValue, { control: control, index: index, key: key }));

                // Reset field arguments (@todo: media controls have args['attachment'] that gets filled by its value and stored in _wpCustomizeSettings[Controls], but we can't pass them from server to client without loading every control individual)
                field.args = _.extend(field.args, {
                    content: null,
                    priority: 10 + index,
                    settings: {
                        'default': id
                    }
                });

                // Set attachment for media controls
                if (field.attachments && 'image' === field.args.type) {
                    field.args.attachment = field.attachments[index] || null
                }

                Constructor = api[field.control] || api.Control;
                options = _.extend({ params: field.args }, field.args);
                Control = new Constructor(id, options);

                //api.control.add( Control ); //@todo: disabled so far, because it manipulates our previous dom settings
                setting.preview();

                // Add template data
                label = stateField[key] || field.args.label
                if (control.params.labelField && key === control.params.labelField && label) {
                    fieldLabel.html(label)
                }


                // console.log(Control.container);

                // Add field to row
                row.find('.customize-control-repeater-field-settings-popup').append(Control.container);



            });
        },

        createRowSetting: function(id, defaultValue) {
            var control = this,
                setting;

            setting = api.create(id, id, {}, {
                type: 'repeater',
                transport: control.settings.default.transport,
                previewer: api.previewer
            });
            setting.set(defaultValue);

            return setting;
        },

        deleteRepeaterRow: function(event) {
            var row = $(event.target).closest('.customize-control-repeater-field-popup');
            var index = row.data('index');

            this.STATE.splice(index, 1);
            this.setting.set(JSON.stringify(this.STATE));

            row.remove();
        },

        watchFieldValue: function(value) {
            this.control.STATE[this.index][this.key] = value;
            this.control.setting.set(JSON.stringify(this.control.STATE));
        },

        normalizeSaveRequestQuery: function(query) {
            var control = this,
                changes = query.customized || query.customize_changeset_data;

            try {
                changes = JSON.parse(changes);
                // console.log(changes);
            } catch (e) {
                return;
            }

            $.each(changes, function(key, value) {
                if (control.fieldQueryPattern.exec(key)) {
                    delete changes[key];
                }
            });

            if (query.hasOwnProperty('customized')) {
                query.customized = JSON.stringify(changes);
            } else if (query.hasOwnProperty('customize_changeset_data')) {
                query.customize_changeset_data = JSON.stringify(changes);
            }

        },

        toggleFieldSettings: function() {
            $(this).closest('.menu-item').toggleClass('menu-item-edit-inactive').toggleClass('menu-item-edit-active')
        }
    });

    $.extend(api.controlConstructor, {
        repeater: api.RepeaterControl
    });






})(wp.customize, wp, jQuery);


(function($) {
    var api = wp.customize;

    api.SliderControl = api.Control.extend({
        ready: function() {

            console.log('slider');
        }
    });

    jQuery.extend(api.controlConstructor, {
        'test-control': api.SliderControl
    });

    // api.controlConstructor['test-control'] = api.SliderControl;

})(jQuery);