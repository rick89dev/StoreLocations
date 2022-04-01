define([
    'jquery',
    'ko',
    'uiComponent',
    'mage/validation',
    'Magento_Ui/js/model/messageList'
    ], function ($, ko, Component, messageList) {
        'use strict';
        return Component.extend({

            defaults: {
                storeCode: ''
            },

            /** @inheritdoc */
            initObservable: function () {
                this._super()
                    .observe('storeCode');

                return this;
            },

            /**
             * Check balance.
             */
            checkStore: function () {
                var lat;
                var lon;

                if (this.storeCode) {
                    $('.action-clean').show();
                    $('.action-check').hide();
                    console.log(navigator.geolocation);
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(position => {
                            lat = position.coords.latitude;
                            lon = position.coords.longitude;
                            console.log(lon);
                            this.storeCode('Latitude: '+ lat + ' / ' + 'longitude: ' + lon);
                        }, error => {
                            $('.error-message').show().html(error.message).delay(5000).fadeOut();
                            $('.action-check').show();
                            $('.action-clean').hide();
                        })
                    }
                }
            },

            cleanStore: function () {
                this.storeCode('');
                $('.action-check').show();
                $('.action-clean').hide();
            }

        });
    }
);
