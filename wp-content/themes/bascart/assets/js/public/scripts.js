/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ 197:
/***/ (() => {

jQuery( function( $ ) {
	if ( $( '.sub-menu-toggle' ).length ) {
		$( '.sub-menu-toggle' ).on( 'click', function() {
			if ( $( window ).width() > 1024 ) {
				return;
			}
			if ( $( this ).attr( 'aria-expanded' ) === 'false' ) {
				$( this ).attr( 'aria-expanded', 'true' );
			} else {
				$( this ).attr( 'aria-expanded', 'false' );
			}
			$( this ).siblings( '.sub-menu' ).slideToggle( 500 );
		} );
	}
	function menu_toggle( current ) {
		let target = current.attr( 'aria-controls' );
		if ( $( '#' + target ).hasClass( 'nav_menu_open' ) ) {
			$( '#' + target ).removeClass( 'nav_menu_open' );
		} else {
			$( '#' + target ).addClass( 'nav_menu_open' );
		}
		if ( ! current.hasClass( 'toggle' ) ) {
			current.addClass( 'toggle' );
		}
	}
	if ( $( '.nav-menu-toggle' ).length ) {
		$( '.nav-menu-toggle, .nav-menu-backdrop' ).on( 'click', function() {
			if ( $( '.nav-menu-toggle' ).hasClass( 'toggle' ) ) {
				$( '.nav-menu-toggle' ).removeClass( 'toggle' );
			}
			menu_toggle( $( this ) );
		} );
	}
	if ( $( '.shop-loop-start' ).length ) {
		$( '#columntwo' ).on( 'click', function() {
			$( this ).addClass( 'active' );
			$( '#columnthree' ).removeClass( 'active' );
			$( '#columnfour' ).removeClass( 'active' );
			$( '#columnlist' ).removeClass( 'active' );
			$( '.shop-loop-start' ).fadeIn( 300, function() {
				$( '.shop-loop-start' ).removeClass( 'shop-lists-loop' );
				$( '.shop-loop-start > div' ).addClass( 'col-md-6' ).removeClass( 'col-md-3 col-md-4' );
			} );
		} );

		$( '#columnthree' ).on( 'click', function() {
			$( this ).addClass( 'active' );
			$( '#columntwo' ).removeClass( 'active' );
			$( '#columnfour' ).removeClass( 'active' );
			$( '#columnlist' ).removeClass( 'active' );
			$( '.shop-loop-start' ).fadeIn( 300, function() {
				$( '.shop-loop-start' ).removeClass( 'shop-lists-loop' );
				$( '.shop-loop-start > div' ).addClass( 'col-md-4' ).removeClass( 'col-md-6 col-md-3' );
			} );
		} );

		$( '#columnfour' ).on( 'click', function() {
			$( this ).addClass( 'active' );
			$( '#columnthree' ).removeClass( 'active' );
			$( '#columntwo' ).removeClass( 'active' );
			$( '#columnlist' ).removeClass( 'active' );
			$( '.shop-loop-start' ).fadeIn( 300, function() {
				$( '.shop-loop-start' ).removeClass( 'shop-lists-loop' );
				$( '.shop-loop-start > div' ).addClass( 'col-md-3' ).removeClass( 'col-md-6 col-md-4' );
			} );
		} );

		$( '#columnlist' ).on( 'click', function() {
			$( this ).addClass( 'active' );
			$( '#columnthree' ).removeClass( 'active' );
			$( '#columntwo' ).removeClass( 'active' );
			$( '#columnfour' ).removeClass( 'active' );
			$( '.shop-loop-start' ).fadeIn( 300, function() {
				$( '.shop-loop-start' ).addClass( 'shop-lists-loop' );
				$( '.shop-loop-start > div' ).addClass( 'col-12' ).removeClass( 'col-md-6 col-md-4 col-md-3' );
			} );
		} );
	}

	//  quantity update

	$( '.woocommerce-grouped-product-list-item' ).find( '.qty' ).val( 0 );
	$( 'form.cart,form.woocommerce-cart-form' ).on( 'click', 'button.plus, button.minus', function() {
		var qty = $( this ).parent( '.quantity' ).find( '.qty' );
		var val = parseFloat( qty.val() );
		var max = parseFloat( qty.attr( 'max' ) );
		var min = parseFloat( qty.attr( 'min' ) );
		var step = parseFloat( qty.attr( 'step' ) );

		if ( $( this ).is( '.plus' ) ) {
			if ( max && ( max <= val ) ) {
				qty.val( max );
			} else {
				qty.val( val + step );
			}
		} else if ( min && ( min >= val ) ) {
			qty.val( min );
		} else if ( val > 1 ) {
			qty.val( val - step );
		}

		qty.trigger( 'change' );
	} );

	// Topbar Section
	var $topbarSection = $( '.topbar_section' ),
		$topbarCloseBtn = $( '.topbar_close_btn' );

	// Check if section is visible
	$topbarSection.each( function() {
		var id = this.getAttribute( 'data-id' );
		if ( ! localStorage.getItem( 'topbar-bf-' + id ) ) {
			$( this ).removeClass( 'elementor-hidden-desktop' );
		}
	} );

	// Toggle The section
	$topbarCloseBtn.on( 'click', function( e ) {
		e.preventDefault();
		var $parent = $( this ).parents( '.topbar_section' );
		localStorage.setItem( 'topbar-bf-' + $parent.attr( 'data-id' ), true );
		$parent.addClass( 'elementor-hidden-desktop' );
	} );

	// For background image setup on active page

	const loadScripts_PreloadTimer = setTimeout( triggerScriptLoader_Preload, 8e3 ),
		userInteractionEvents_Preload = [ 'mouseover', 'keydown', 'touchstart', 'touchmove', 'wheel' ];
	function triggerScriptLoader_Preload() {
		// eslint-disable-next-line
		document.querySelector( 'html' ).classList.add( 'is-active-page' ), clearTimeout( loadScripts_PreloadTimer );
	}
	userInteractionEvents_Preload.forEach( function( e ) {
		window.addEventListener( e, triggerScriptLoader_Preload, {
			passive: ! 0,
		} );
	} );

	//font face script

	//eslint-disable-next-line
	if ( fontList ) {
		//eslint-disable-next-line
		const observeFontList = fontList.map( ( fontName ) => {
			//eslint-disable-next-line
			const observer = new FontFaceObserver( fontName );
			return observer.load();
		} );

		Promise.all( observeFontList ).then( function() {
			document.documentElement.className += ' fonts-loaded';
		} );
	} else {
		//eslint-disable-next-line
		const interObserver = new FontFaceObserver( 'Inter' );
		Promise.all( [
			interObserver.load(),
		] ).then( function() {
			document.documentElement.className += ' fonts-loaded';
		} );
	}

	/*
		Bascart Preloader
	*/

	$( window ).on( 'load', function() {
		setTimeout( () => {
			$( '#preloader' ).addClass( 'loaded' );
		}, 1000 );
	} );

	// preloader close
	$( '.preloader-cancel-btn' ).on( 'click', function( e ) {
		e.preventDefault();
		if ( ! ( $( '#preloader' ).hasClass( 'loaded' ) ) ) {
			$( '#preloader' ).addClass( 'loaded' );
		}
	} );
} );



/***/ }),

/***/ 875:
/***/ (() => {

( function( $, elementor ) {
	'use strict';
	function AjaxWidgetLoad( $scope, callback = function() { } ) {
		$scope.removeClass( 'bascart-widget-loaded' );

		var widget_name = $scope.data( 'widget_type' );

		widget_name = widget_name.slice( 0, widget_name.length - 8 );
		var data_settings = $scope.find( '.bascart-' + widget_name ).attr( 'data-widget_settings' );

		if ( ! data_settings ) {
			return false;
		}

		var data_config = JSON.parse( data_settings );

		if ( data_config.ajax_load !== 'yes' ) {
			callback();
			return false;
		}

		$scope.elementorWaypoint( function() {
			if ( $scope.hasClass( 'bascart-widget-loaded' ) ) {
				return false;
			}
			jQuery.ajax( {
				data: {
					action: 'bascart_ajax_widget_load',
					nonce: bascart_object.nonce,
					widget_name: widget_name,
					settings: data_config,
				},
				type: 'POST',
				url: bascart_object.ajax_url,
				success: function( response ) {
					$scope.addClass( 'bascart-widget-loaded' );
					$scope.find( '.bascart-' + widget_name ).hide().html( response ).fadeIn();
					callback();
				},
			} );
		}, { offset: '100%' } );
	}

	var Bascart = {

		/**
		 * Create a new Swiper instance
		 *
		 * @param swiperElement widget scope
		 * @param swiperConfig swiper config
		 */
		swiper: function( swiperElement, swiperConfig ) {
			var swiperContainer = swiperElement.get( 0 );
			if ( typeof Swiper !== 'function' ) {
				// If Swiper is not defined or not a function, load the Swiper library asynchronously
				const asyncSwiper = elementor.utils.swiper;
				return new asyncSwiper( swiperContainer, swiperConfig ).then( ( newSwiperInstance ) => {
					return newSwiperInstance;
				} );
			}
			// If Swiper is already defined, create a new Swiper instance using the global Swiper object
			const swiperInstance = new Swiper( swiperContainer, swiperConfig );
			return Promise.resolve( swiperInstance );
		},

		init: function() {
			var widgets = {
				'back-to-top.default': Bascart.BackToTop,
				'category-product-list.default': Bascart.CategoryProductList,
				'product-category.default': Bascart.ProductCategory,
				'filterable-product-list.default': Bascart.FilterableProductList,
				'simple-product-slider.default': Bascart.SimpleProductSlider,
				'recently-viewed-products.default': Bascart.RecentlyViewedProducts,
				'advanced-slider.default': Bascart.AdvancedSlider,
				'offer-slider.default': Bascart.OfferSlider,
				'deal-products.default': Bascart.DealProducts,
				'multi-vendor-products.default': Bascart.MultiVendorProducts,
				'product-slider.default': Bascart.ProductSlider,
				'related-products.default': Bascart.RelatedProducts,
				'brands.default': Bascart.Brands,
				'product-list.default': Bascart.ProductList,
				'nav-search.default': Bascart.navSearch,
				'category-slider.default': Bascart.CategorySlider,
				'news-ticker.default': Bascart.NewsTicker,
				'wishlist-counter.default': Bascart.WishlistCounter,
				'product-grid.default': Bascart.ProductGrid,
			};
			$.each( widgets, function( widget, callback ) {
				elementor.hooks.addAction( 'frontend/element_ready/' + widget, function( $scope ) {
					AjaxWidgetLoad( $scope, function() {
						if ( callback ) {
							callback( $scope );
						}
					} );
				} );
			} );
		},

		/* ----------------------------------------------------------- */
		/*  news ticker
		/* ----------------------------------------------------------- */

		NewsTicker: function( $scope ) {
			let $container = $scope.find( '.bascart-news-ticker' );

			if ( $container.length > 0 ) {
				// eslint-disable-next-line
				new Swiper($container, {
					slidesPerView: 1,
					centeredSlides: false,
					loop: true,
					allowTouchMove: true,
					speed: 1500, //slider transition speed
					parallax: true,
					autoplay:  true ? { delay: 4000 } : 0, //delay between two slides
					effect: 'slide',
					mousewheelControl: 1,
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
				} );
			}
		},

		ProductCategory: function( $scope ) {
			var $catWrap = $scope.find( '.category-parent-wrap' );

			$catWrap.imagesLoaded( function() {
				$catWrap.masonry( {
					columnWidth: '.grid-sizer',
					itemSelector: '.cat-list-item',
					percentPosition: 'true',
				} );
			} );
		},

		// Nav Search name
		navSearch: function( $scope ) {
			var search_form = $scope.find( '.xs-navbar-search-wrapper' ),
				widget_settings = JSON.parse( $scope.find( '.bascart-nav-search' ).attr( 'data-widget_settings' ) );

			search_form.on( 'keyup change', 'input[type="search"], .xs-ele-nav-search-select', function() {
				var getKeyword = $( this ).val(),
					my_cat = '';

				if ( $( this ).hasClass( 'xs-ele-nav-search-select' ) ) {
					getKeyword = search_form.find( 'input[type="search"]' ).val();
					my_cat = $( this ).val();
				} else {
					my_cat = search_form.find( '.xs-ele-nav-search-select' ).val();
				}

				$.ajax( {
					url: bascart_object.ajax_url,
					data: {
						action: 'bascart_result_search_product',
						keyword: getKeyword,
						cat_id: my_cat,
						settings: widget_settings,
					},
					method: 'POST',
					success: function( data ) {
						$( '.product-search-result' ).html( data );
					},
				} );
			} );
		},

		FilterableProductList: function( $scope ) {
			var filter_link = $scope.find( '.bc-filter-nav-link' );
			$scope.on( 'click', '.bc-filter-nav-link', function( e ) {
				e.preventDefault();
				var self = $( this ),
					product_list = self.data( 'product-list' ),
					slug_text = self.data( 'filter-slug' ),
					product_style = self.data( 'product-style' ),
					content_wrapper = self.parents( '.bascart-filterable-product-wrap' ).find( '.filter-content' ),
					widget_settings = JSON.parse( $scope.find( '.bascart-filterable-product-list' ).attr( 'data-widget_settings' ) );

				filter_link.removeClass( 'active' );
				self.addClass( 'active' );

				if ( $( '.filtered-product-list.filter-' + slug_text ).length ) {
					content_wrapper.find( '.filtered-product-list' ).removeClass( 'active' );
					content_wrapper.find( '.filtered-product-list.filter-' + slug_text ).addClass( 'active' );
					return false;
				}
				jQuery.ajax( {
					data: {
						action: 'bascart_filter_cat_products',
						products: product_list,
						slug: slug_text,
						style: product_style,
						settings: widget_settings,
					},
					type: 'POST',
					url: bascart_object.ajax_url,
					beforeSend: function() {
						if ( ! $scope.find( '.bascart-loader' ).length ) {
							content_wrapper.append( '<div class="bascart-loader">' + bascart_object.loading_text + '<div class="bascart-loader-circle"></div></div>' );
						} else {
							$scope.find( '.bascart-loader' ).fadeIn();
						}
					},
					success: function( response ) {
						$scope.find( '.bascart-loader' ).hide();
						content_wrapper.hide();
						content_wrapper.fadeIn();
						content_wrapper.find( '.filtered-product-list' ).removeClass( 'active' );
						content_wrapper.append( '<div class="row filtered-product-list active filter-' + slug_text + ' ' + product_style + '">' + response + '</div>' );
					},
				} );
			} );
		},

		CategoryProductList: function( $scope ) {
			var cat_link = $scope.find( '.category-link' );

			cat_link.on( 'click', function( e ) {
				e.preventDefault();
				var self = $( this ),
					get_term_id = self.data( 'term_id' ),
					content_wrapper = self.parents( '.bascart-category-product-list' ).find( '.category-content' );

				cat_link.removeClass( 'active' );
				self.addClass( 'active' );

				if ( content_wrapper.find( '.categories-product-list.term-' + get_term_id ).length ) {
					content_wrapper.find( '.categories-product-list' ).hide();
					content_wrapper.find( '.categories-product-list.term-' + get_term_id ).fadeIn();
					return false;
				}
				jQuery.ajax( {
					data: {
						action: 'bascart_category_filter',
						term_id: get_term_id,
					},
					type: 'POST',
					url: bascart_object.ajax_url,
					success: function( response ) {
						self.parents( '.bascart-category-product-list' ).find( '.categories-product-list' ).hide();
						content_wrapper.hide()
							.fadeIn().append( '<div class="row categories-product-list active term-' + get_term_id + '">' + response + '</div>' );
					},
				} );
			} );
		},

		// Deal Products

		DealProducts: function( $scope ) {
			let $el = $scope.find( '.product-end-sale-timer' );
			let settings = $scope.find( '.bascart-deal-products' ).data( 'widget_settings' );
			let slider_space_between = parseInt( settings.slider_space_between );
			let slides_to_show = settings.slides_to_show;
			let ts_slider_autoplay = ( settings.ts_slider_autoplay === 'yes' ) ? true : false;
			let ts_slider_loop = ( settings.ts_slider_loop === 'yes' ) ? true : false;
			let ts_slider_speed = parseInt( settings.ts_slider_speed );

			if ( settings.enable_carousel && settings.enable_carousel === 'yes' ) {
				var config = {
					slidesPerView: parseInt( slides_to_show ),
					spaceBetween: slider_space_between,
					autoplay: ts_slider_autoplay,
					loop: ts_slider_loop,
					speed: ts_slider_speed,
					navigation: {
						nextEl: `.swiper-next-${settings.widget_id}`,
						prevEl: `.swiper-prev-${settings.widget_id}`,
					},
					breakpoints: {
						0: {
							slidesPerView: parseInt( settings.slides_to_show_mobile ),
						},
						767: {
							slidesPerView: parseInt( settings.slides_to_show_tablet ),
						},
						1024: {
							slidesPerView: parseInt( slides_to_show ),
						},
					},
				};
					// swiper
			let swiperClass = $scope.find( `.${window.elementorFrontend.config.swiperClass}` );
			Bascart.swiper( swiperClass, config ).then( function( swiperInstance ) {

			} );
			}

			// timer
			if ( ! $el.length ) {
				return false;
			}

			$el.each( function() {
				var $current_el = $( this ),
					custom_settings = $current_el.data( 'config' ),
					dateText = $current_el.attr( 'data-date' ),
					timer_prefix = $current_el.data( 'prefix' ),
					countDownDate = new Date( dateText ).getTime();

				if ( ! countDownDate ) {
					countDownDate = 0;
				}

				// Update the count down every 1 second
				var x = setInterval( function() {
					// Get today's date and time
					var now = new Date().getTime();

					// Find the distance between now and the count down date
					var distance = countDownDate - now;

					// Time calculations for days, hours, minutes and seconds
					var days = Math.floor( distance / ( 1000 * 60 * 60 * 24 ) );
					var hours = Math.floor( ( distance % ( 1000 * 60 * 60 * 24 ) ) / ( 1000 * 60 * 60 ) );
					var total_hours = hours + ( days * 24 );
					var minutes = Math.floor( ( distance % ( 1000 * 60 * 60 ) ) / ( 1000 * 60 ) );
					var seconds = Math.floor( ( distance % ( 1000 * 60 ) ) / 1000 );

					var output = "<span classs='counter-prefix'>" + timer_prefix + "</span><ul><li><span class='number'>" + total_hours + "</span><span class='text'>" + custom_settings.hours + "</span></li><li><span class='number'>" + minutes + "</span><span class='text'>" + custom_settings.minutes + "</span></li><li><span class='number'>" + seconds + "</span><span class='text'>" + custom_settings.seconds + '</span></li></ul>';

					if ( $current_el.hasClass( 'counter-position-progressbar' ) ) {
						output = '<span classs="counter-prefix">' + timer_prefix + '</span>' + days + ':' + hours + ':' + minutes + ':' + seconds;
					} else if ( $current_el.hasClass( 'counter-position-footer' ) ) {
						output = "<span classs='counter-prefix'>" + timer_prefix + "</span><ul><li><span class='number'>" + days + "</span><span class='text'>" + custom_settings.days + "</span></li><li><span class='number'>" + total_hours + "</span><span class='text'>" + custom_settings.hours + "</span></li><li><span class='number'>" + minutes + "</span><span class='text'>" + custom_settings.minutes + "</span></li><li><span class='number'>" + seconds + "</span><span class='text'>" + custom_settings.seconds + '</span></li></ul>';
					}
					// Output the result in an element with id="demo"
					$current_el.html( output );
					if ( distance < 0 ) {
						clearInterval( x );
						$current_el.html( '' );
					}
				}, 1000 );
			} );
		},

		// Multi Vendor Products

		MultiVendorProducts: function( $scope ) {
			let settings = $scope.find( '.bascart-multi-vendor-products' ).data( 'widget_settings' );
			let slider_space_between = parseInt( settings.slider_space_between );
			let slides_to_show = settings.slides_to_show;

			if ( settings.enable_carousel && settings.enable_carousel === 'yes' ) {
				new Swiper( $scope.find( '.swiper-container' ), {
					slidesPerView: parseInt( slides_to_show ),
					spaceBetween: slider_space_between,
					navigation: {
						nextEl: `.swiper-next-${settings.widget_id}`,
						prevEl: `.swiper-prev-${settings.widget_id}`,
					},
					breakpoints: {
						0: {
							slidesPerView: parseInt( settings.slides_to_show_mobile ),
						},
						767: {
							slidesPerView: parseInt( settings.slides_to_show_tablet ),
						},
						1024: {
							slidesPerView: parseInt( slides_to_show ),
						},
					},
				} );
			}
		},

		// Related products
		RelatedProducts: function( $scope ) {
			var settings = $scope.find( '.bascart-related-products' ).data( 'widget_settings' );
			var slider_space_between = parseInt( settings.slider_space_between );

			if ( settings.enable_carousel && settings.enable_carousel === 'yes' ) {
				new Swiper( $scope.find( '.swiper-container' ), {
					slidesPerView: 4,
					spaceBetween: slider_space_between,
					navigation: {
						nextEl: `.swiper-next-${settings.widget_id}`,
						prevEl: `.swiper-prev-${settings.widget_id}`,
					},
					breakpoints: {
						0: {
							slidesPerView: 1,
						},
						767: {
							slidesPerView: 2,
						},
						1024: {
							slidesPerView: 4,
						},
					},
				} );
			}
		},

		// Product Slider
		ProductSlider: function( $scope ) {
			let settings = $scope.find( '.bascart-product-slider' ).data( 'widget_settings' );
			let slider_space_between = parseInt( settings.slider_space_between );
			let slide_autoplay = ( settings.slider_autoplay === 'yes' ) ? true : false;
			let slider_loop = ( settings.slider_loop === 'yes' ) ? true : false;
			let slides_to_show = settings.slides_to_show;

			var config = {
				slidesPerView: parseInt( slides_to_show ),
				spaceBetween: slider_space_between,
				autoplay: slide_autoplay ? { delay: settings.slider_autoplay_delay } : false,
				loop: slider_loop,
				navigation: {
					nextEl: `.swiper-next-${settings.widget_id}`,
					prevEl: `.swiper-prev-${settings.widget_id}`,
				},
				breakpoints: {
					0: {
						slidesPerView: parseInt( settings.slides_to_show_mobile ),
					},
					767: {
						slidesPerView: parseInt( settings.slides_to_show_tablet ),
					},
					1024: {
						slidesPerView: parseInt( slides_to_show ),
					},
				},
			};
			// swiper
			let swiperClass = $scope.find( `.${window.elementorFrontend.config.swiperClass}` );
			Bascart.swiper( swiperClass, config ).then( function( swiperInstance ) {

			} );
		},

		CategorySlider: function( $scope ) {
			var $container = $scope.find( '.bascart-category-slider' );
			if ( $container.length > 0 ) {
				var settings = $container.data( 'widget_settings' );
				var ts_slider_loop = ( settings.ts_slider_loop === 'yes' ) ? true : false;
				var slide_autoplay = ( settings.ts_slider_autoplay === 'yes' ) ? true : false;
				var ts_slider_speed = parseInt( settings.ts_slider_speed );
				var slider_space_between = parseInt( settings.slider_space_between );

				var config = {
					slidesPerView: settings.slider_items,
					loop: ts_slider_loop,
					speed: ts_slider_speed,
					spaceBetween: slider_space_between,
					autoplay: slide_autoplay ? { delay: settings.ts_slider_autoplay_delay } : false,
					navigation: {
						nextEl: `.swiper-next-${settings.widget_id}`,
						prevEl: `.swiper-prev-${settings.widget_id}`,
					},
					breakpoints: {
						0: {
							slidesPerView: 1,
						},
						767: {
							slidesPerView: 3,
						},
						1024: {
							slidesPerView: settings.slider_items,
						},
					},
				};
				// swiper
				let swiperClass = $scope.find( `.${window.elementorFrontend.config.swiperClass}` );
				Bascart.swiper( swiperClass, config ).then( function( swiperInstance ) {

				} );
			}
		},

		BackToTop: function( $scope ) {
			let $el = $scope.find( '.bascart-back-top' );

			if ( $el.length > 0 ) {
				$( window ).on( 'scroll', function() {
					var scrolltop = $( window ).scrollTop(),
						docHeight = $( document ).height() / 2;

					if ( scrolltop > docHeight ) {
						$( $el ).fadeIn( 'slow' );
					} else {
						$( $el ).fadeOut( 'slow' );
					}
				} );
				$( $el ).click( function() {
					$( 'html, body' ).animate( { scrollTop: 0 }, 800 );
				} );
			}
		},

		ProductList: function( $scope ) {
			var el = $scope.find( '.product-list-slider' );
			new Swiper( el, {
				slidesPerView: 3,
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
			} );
		},

		AdvancedSlider: function( $scope ) {
			var el = $scope.find( '.bascart-slider-wrapper' );
			var effect = el.attr( 'data-effect' );
			var settings = $scope.find( '.bascart-advanced-slider' ).data( 'widget_settings' );
			var slide_autoplay = ( settings.ts_slider_autoplay === 'yes' ) ? true : false;
			var ts_slider_loop = ( settings.ts_slider_loop === 'yes' ) ? true : false;
			var ts_slider_speed = parseInt( settings.ts_slider_speed );

			var config = {
				speed: ts_slider_speed,
				slidesPerView: 1,
				spaceBetween: 30,
				effect: effect,
				autoplay: slide_autoplay ? { delay: settings.ts_slider_autoplay_delay } : false,
				paginationClickable: true,
				loop: ts_slider_loop,
				autoHeight: true,
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
					type: 'custom',
					renderCustom: function( swiper, current, total ) {
						var text = "<div class='custom-pagination-container'>";
						for ( let i = 1; i <= total; i++ ) {
							let bullet_class = 'bullet';
							let inner_text = '';
							if ( current === i ) {
								bullet_class = 'bullet active';
								if ( i === 1 || i === total ) {
									// inner_text = i;
									inner_text = String( i ).padStart( 2, '0' );
								}
							} else if ( i === 1 || i === total ) {
								inner_text = String( i ).padStart( 2, '0' );
							} else {
								inner_text = '';
							}
							text += `<div class="${bullet_class}" style="height: calc( 100% / ${total} ); "><span>${inner_text}</span></div>`;
						}
						text += '</div>';
						return text;
					},
				},

				navigation: {
					nextEl: `.swiper-next-${settings.widget_id}`,
					prevEl: `.swiper-prev-${settings.widget_id}`,
				},
			};
			// swiper
			let swiperClass = $scope.find( `.${window.elementorFrontend.config.swiperClass}` );
			Bascart.swiper( swiperClass, config ).then( function( swiperInstance ) {

			} );
		},

		OfferSlider: function( $scope ) {
			var $container = $scope.find( '.bascart-offer-slider' );
			if ( $container.length > 0 ) {
				var settings = $container.data( 'widget_settings' );
				var slide_autoplay = ( settings.slider_autoplay === 'yes' ) ? true : false;
				var config = {
					speed: 1500,
					loop: true,
					spaceBetween: 0,
					paginationClickable: true,
					autoplay: slide_autoplay ? { delay: settings.slider_autoplay_delay } : false,
					slidesPerView: settings.slider_item,
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
					breakpoints: {
						0: {
							slidesPerView: 1,
						},
						767: {
							slidesPerView: 2,
						},
						1024: {
							slidesPerView: settings.slider_item,
						},
					},
				};

				// swiper
				let swiperClass = $scope.find( `.${window.elementorFrontend.config.swiperClass}` );
				Bascart.swiper( swiperClass, config ).then( function( swiperInstance ) {

				} );
			}
		},

		Brands: function( $scope ) {
			var $container = $scope.find( '.bascart-brands' );
			if ( $container.length > 0 ) {
				var settings = $container.data( 'widget_settings' );
				var slide_autoplay = ( settings.slider_autoplay === 'yes' ) ? true : false;
				var config = {
					speed: 1500,
					loop: true,
					spaceBetween: settings.slider_space_between,
					paginationClickable: true,
					autoplay: slide_autoplay,
					slidesPerView: settings.slider_items,
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
					breakpoints: {
						0: {
							slidesPerView: 1,
						},
						767: {
							slidesPerView: 2,
						},
						1024: {
							slidesPerView: settings.slider_items,
						},
					},
				};
				// swiper
				let swiperClass = $scope.find( `.${window.elementorFrontend.config.swiperClass}` );
				Bascart.swiper( swiperClass, config ).then( function( swiperInstance ) {

				} );
			}
		},

		WishlistCounter: function( $scope ) {
			const wishlistCounter = $scope.find( '.bascart-wishlist-counter' );
			if ( wishlistCounter.length > 0 ) {
				if ( jQuery( 'body' ).hasClass( 'logged-in' ) ) {
					const wishlistItem = jQuery( '.shopengine_add_to_list_action' );

					wishlistItem.on( 'click', function() {
						// Select individual item
						const clickedItemValue = jQuery( this ).attr( 'data-pid' );
						const itemWithSameProductId = jQuery( '.shopengine_add_to_list_action[data-pid="' + clickedItemValue + '"]' );
						itemWithSameProductId.toggleClass( 'active' );

						// Update counter value for each items
						const counter = jQuery( document ).find( '.wishlist-count' );
						let currentCounterValue = parseInt( counter.html() );
						if ( itemWithSameProductId.hasClass( 'active' ) ) {
							counter.html( currentCounterValue + 1 );
						} else {
							counter.html( currentCounterValue - 1 );
						}
					} );

					// Remove counter value when items removed from wishlist page.
					const wishListRemoveAction = jQuery( '.shopengine-remove-action' );
					wishListRemoveAction.on( 'click', function() {
						const counter = jQuery( document ).find( '.wishlist-count' );
						let currentCounterValue = parseInt( counter.html() );
						counter.html( --currentCounterValue );
					} );
				}
			}
		},

	};

	$( window ).on( 'elementor/frontend/init', Bascart.init );
}( jQuery, window.elementorFrontend ) );


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/* harmony import */ var _custom_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(197);
/* harmony import */ var _custom_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_custom_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _elementor_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(875);
/* harmony import */ var _elementor_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_elementor_js__WEBPACK_IMPORTED_MODULE_1__);
/**
 * Importing all widgets to compile
 * 1. Dependencies
 * 2. Elementor Scrips
 * 3. Custom theme scripts
 */




})();

/******/ })()
;