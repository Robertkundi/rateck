(function ($, elementor) {
    "use strict";
	var helper = {
		throttle: function( func, delay ) {
			let past = 0;
			return function( ...args ) {
				let current = new Date().getTime();

				if ( current - past < delay ) {
					return false;
				}

				window.intervalID = setTimeout( function() {
					func( ...args );
				}, delay );

				past = current;
			};
		},

		// read : https://www.geeksforgeeks.org/lodash-_-debounce-method/
		debounce: function( fn, delay ) {
			let timeID;
			return function( ...args ) {
				timeID ? clearTimeout( timeID ) : null; //eslint-disable-line
				timeID = setTimeout( function() {
					fn( ...args );
				}, delay );
			};
		},

		isInViewport: function( el ) {
			const rect = el.getBoundingClientRect();
			return (
				rect.top >= 0 &&
				rect.left >= 0 &&
				rect.bottom <= ( window.innerHeight || document.documentElement.clientHeight ) &&
				rect.right <= ( window.innerWidth || document.documentElement.clientWidth )

			);
		},

		setDefaultFilterData({ name, classPrefix, setArray, addClass }) {

			const urlSearchParams = new URLSearchParams(window.location.search);

			if( urlSearchParams.has( name )  ) {
				const urlValues = urlSearchParams.get(name);
				const value = urlValues.split(',');

				value.map( item => {

					setArray.add(item)
					const selector = $(`${classPrefix}${item}`);

					if( addClass && addClass.length ) {
						selector.addClass(addClass);
					}
					selector.prop('checked', true);

				} )
			}
		},

	};

    var BASCART = {
        init: function () {
            var widgets = {
                "elementskit-popup-modal.default": BASCART.PopupModal,
                "elementskit-woo-mini-cart.default":BASCART.Mini_Cart,
                'ekit-vertical-menu.default': BASCART.Vertical_Menu,
            };

            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });
        },

        ShowModal: function( $modal, $content, hasCookie ) {
            if ( hasCookie ) {
                return;
            }

            let openModals = $.find( '.ekit-popup-modal.show' );
            openModals.forEach( m => $( m ).removeClass( 'show' ) );

            let animation = $content.data( 'animation' );

            $modal.addClass( 'show' );
            animation && $content.addClass( animation );
        },

        PopupModal: function( $scope ) {
            var widgetId = $scope.data( 'id' ),
                settings = $scope.data( 'settings' ),
                isCookie = settings && ( 'enable_cookie_consent' in settings ), // Cookie shouldn't work on editor page.
                hasCookie = isCookie && document.cookie.match( 'popup_cookie_' + widgetId );

            var $modal = $scope.find( '.ekit-popup-modal' );
            var $content = $scope.find( '.ekit-popup__content' );

            var toggleType = $modal.data( 'toggletype' );
            var toggleAfter = $modal.data( 'toggleafter' );

            if ( ( toggleType === 'time' ) && ( toggleAfter > 0 ) ) {
                setTimeout( () => {
                    BASCART.ShowModal( $modal, $content, hasCookie );
                }, toggleAfter * 1000 );
            }

            var togglers = $scope.find( '.ekit-popup-modal__toggler-wrapper button, .ekit-popup-modal__toggler-wrapper img' );
            var closses = $scope.find( '.ekit-popup__close, .ekit-popup-modal__close, .ekit-popup-footer__close' );

            togglers.on( 'click', function( e ) {
                e.preventDefault();
                BASCART.ShowModal( $modal, $content );
            } );

            closses.on( 'click', function( e ) {
                e.preventDefault();
                $modal.addClass( 'closing' );

                setTimeout( () => {
                    $modal.removeClass( 'show' );
                    $modal.removeClass( 'closing' );
                }, 450 );

                if ( isCookie ) {
                    document.cookie = 'popup_cookie_' + widgetId + '=1; path=/';
                }
            } );
        },

        Mini_Cart: function( $scope ) {
			$scope.find( '.ekit-dropdown-back' ).on( 'click mouseenter mouseleave', function( e ) {
				var self = $( this ),
					enableClick = self.hasClass( 'ekit-mini-cart-visibility-click' ),
					enableHover = self.hasClass( 'ekit-mini-cart-visibility-hover' ),
					body = self.find( '.ekit-mini-cart-container' );

				if ( e.type === 'click' && enableClick && ! $( e.target ).parents( 'div' ).hasClass( 'ekit-mini-cart-container' ) ) {
					body.fadeToggle();

				} else if ( e.type === 'mouseenter' && enableHover ) {
					body.fadeIn();
				} else if ( e.type === 'mouseleave' && enableHover ) {
					body.fadeOut();
				}
			} );

			$('body').on('click', function(e) {
				var currentTarget = $(e.target);
				if(!currentTarget.parents('.ekit-mini-cart').length) {
					$scope.find( '.ekit-mini-cart-container' ).fadeOut()
				}
			})
		},

        Vertical_Menu: function( $scope ) {
			if ( $scope.find( '.ekit-vertical-main-menu-on-click' ).length > 0 ) {
				let menu_container = $scope.find( '.ekit-vertical-main-menu-on-click' ),
					target = $scope.find( '.ekit-vertical-menu-tigger' );

				let deviceMode = $('body').data('elementor-device-mode');
				if( deviceMode === 'tablet' || deviceMode === 'mobile' ) {
					menu_container.removeClass('vertical-menu-active');
				}

				target.on( 'click', function( e ) {
					e.preventDefault();
					menu_container.toggleClass( 'vertical-menu-active' );
				} );
			}

			if ( $scope.find( '.elementskit-megamenu-has' ).length > 0 ) {
				let target = $scope.find( '.elementskit-megamenu-has' ),
					parents_container = $scope.parents( '.elementor-container' ),
					vertical_menu_wraper = $scope.find( '.ekit-vertical-main-menu-wraper' ),
					final_width = Math.floor( ( parents_container.width() - vertical_menu_wraper.width() ) ) + 'px';

				target.on( 'mouseenter', function() {
					let data_width = $( this ).data( 'vertical-menu' ),
						megamenu_panel = $( this ).children( '.elementskit-megamenu-panel' );

					if ( data_width && data_width !== undefined && ! ( final_width <= data_width ) ) {
						if ( typeof data_width === 'string' ) {
							if ( /^[0-9]/.test( data_width ) ) {
								megamenu_panel.css( {
									width: data_width,
								} );
							} else {
								$( window ).bind( 'resize', function() {
									if ( $( document ).width() > 1024 ) {
										megamenu_panel.css( {
											width: Math.floor( ( parents_container.width() - vertical_menu_wraper.width() ) - 10 ) + 'px',
										} );
									} else {
										megamenu_panel.removeAttr( 'style' );
									}
								} ).trigger( 'resize' );
							}
						} else {
							megamenu_panel.css( {
								width: data_width + 'px',
							} );
						}
					} else {
						$( window ).bind( 'resize', function() {
							if ( $( document ).width() > 1024 ) {
								megamenu_panel.css( {
									width: Math.floor( ( parents_container.width() - vertical_menu_wraper.width() ) - 10 ) + 'px',
								} );
							} else {
								megamenu_panel.removeAttr( 'style' );
							}
						} ).trigger( 'resize' );
					}
				} );
				target.trigger( 'mouseenter' );
			}
		}
    };
    $(window).on('elementor/frontend/init', BASCART.init);

	// Mini Cart Offcanvas
	(function() {
		var cartOffcanvas = $( '.ekit-mini-cart-visibility-off_canvas' );
		
		// offcanvas open
		cartOffcanvas.on( 'click', function ( e ) {
			e.preventDefault();
			$( '.xs-sidebar-group' ).addClass( 'isActive' );
		} );
	
		// offcanvas when add to cart a product
		$( 'body' ).on( 'added_to_cart', function () {
			// $('.xs-sidebar-group').addClass('isActive');
			cartOffcanvas.trigger( 'click' );
		} );
	
		// offcanvas close
		$( 'body' ).on( 'click', '.close-side-widget, .xs-overlay', function ( e ) {
			e.preventDefault();
			$( '.xs-sidebar-group' ).removeClass( 'isActive' );
		} );
	})();
}(jQuery, window.elementorFrontend));