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
				'shopengine-product-filters.default': BASCART.Product_Filters,
            };

            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });
        },
		Product_Filters: function( $scope ) {

			var $filterWrapper		= $scope.find( '.shopengine-product-filters-wrapper' ),
				$priceEnabled		= $filterWrapper.data( 'filter-price' ),
				$ratingEnabled		= $filterWrapper.data( 'filter-rating' ),
				$colorEnabled		= $filterWrapper.data( 'filter-color' ),
				$categoryEnabled	= $filterWrapper.data( 'filter-category' ),
				$attributeEnabled	= $filterWrapper.data( 'filter-attribute' ),
				$labelEnabled		= $filterWrapper.data( 'filter-label' ),
				$imageEnabled		= $filterWrapper.data( 'filter-image' ),
				$shippingEnabled	= $filterWrapper.data( 'filter-shipping' ),
				$stockEnabled		= $filterWrapper.data( 'filter-stock' ),
				$onSaleEnabled		= $filterWrapper.data( 'filter-onsale' ),
				$view_mode			= $filterWrapper.data( 'filter-view-mode' );

			var $filterPriceWrapper	= $scope.find( '.shopengine-filter-price' ),
				$filterSlider		= $scope.find( '.shopengine-filter-price-slider' ),
				$filterReset		= $scope.find( '.shopengine-filter-price-reset' ),
				$filterResult		= $scope.find( '.shopengine-filter-price-result' ),

				$filterInputMin = $filterWrapper.find( 'input[name="min_price"]' ),
				$filterInputMax = $filterWrapper.find( 'input[name="max_price"]' ),

				sign = $filterResult.data( 'sign' ),
				defaultValues = $filterPriceWrapper.data( 'default-range' );

			let label_btn		= $scope.find( '.shopengine-filter-rating__labels' );
			let starsState		= new Set();
			let categories		= new Set();
			

			let $toggler	= $scope.find( '.shopengine-filter-group-toggle' ),
				$content	= $scope.find( '.shopengine-filter-group-content-wrapper' ),
				$underlay	= $scope.find( '.shopengine-filter-group-content-underlay' ),
				$closeBtn	= $scope.find( '.shopengine-filter-group-content-close' );

			$toggler.add( $closeBtn ).add( $underlay ).on( 'click', function() {
				$toggler.toggleClass( 'active' );
				$content.toggleClass( 'isactive' );
			} );

			// close filter window when click event trigered outside of it.
			$(document).on( 'click', ev => {
				if( $content.hasClass('isactive') ) {
					const isContentClicked = ev.target.closest( '.shopengine-filter-group-content-wrapper, .shopengine-filter-group-toggle' );
					if( !isContentClicked ) {
						$toggler.toggleClass( 'active' );
						$content.toggleClass( 'isactive' );
					}
				}
			})

			if( 'collapse' === $view_mode ) {
				const collapse_btn = $scope.find( '.shopengine-collapse .shopengine-product-filter-title' );
				collapse_btn.on( 'click', ev => {
					ev.preventDefault();
					ev.stopPropagation();

					const collapse_body = ev.target.closest('.shopengine-filter');
					collapse_body.classList.toggle("open");
					collapse_body.nextElementSibling.classList.toggle("open");
				} )
			}

			/**
			 * 
			 * 
			 *  Filter script start
			 * @function filter_script;
			 * @param form refers to filter form element
			 * @param filterInput refers to individual filter input element
			 * @param formInput refers to input field inside of form element
			 * 
			 * 
			 */
			
			const filter_script = ({form, filterInput, formInput}) => {
				let state	= {};
				
				/* load searched value after reloading page */
				filterInput.map( ( index, inp) => {

					if( !state[inp.name] ) {
						state[inp.name] = new Set();
					}

					const defaultFilterArg = {
						name		: inp.name,				 			// name of input
						classPrefix	: `.${inp.name}-`, 					// suffix class will be the value of the name
						setArray	: state[inp.name], 		// new Set()
					}

					helper.setDefaultFilterData(defaultFilterArg)
				} )

				filterInput.on( 'change', function(ev) {
					const value = ev.target.value;
					const name	= ev.target.name;

					console.log(name, value)

					if( !state[name] ) {
						state[name] = new Set();
					}

					if( state[name].has( value ) ) {
						state[name].delete( value );
					} else {
						state[name].add(value);
					}

					// inset array of star into the input field
					formInput.attr( 'name', name );
					formInput.attr( 'value', Array.from( state[name] ) );


					// trigger form submit
					form.trigger( 'submit' );
				} );
			} // end of Filter script start


			if ( 'yes' === $priceEnabled ) {
				let $priceForm = $scope.find( '.shopengine-filter-price' );
				let rangeValue = false;
				$filterSlider.asRange( 'val', [10, 300] );

				const urlSearchParams = new URLSearchParams(window.location.search);

				let $exchange_rate = $priceForm.data( 'exchange-rate' );
				if( urlSearchParams.has('min_price') && urlSearchParams.has('max_price') ){

					if($exchange_rate !== 0) {
						rangeValue = [
							urlSearchParams.get('min_price') * $exchange_rate,
							urlSearchParams.get('max_price') * $exchange_rate
						]
					} else {
						rangeValue = [
							urlSearchParams.get('min_price'),
							urlSearchParams.get('max_price')
						]
					}

					$filterResult.text( sign + rangeValue[0] + ' - ' + sign + rangeValue[1] ); // Show updated values.
				}


				// Filter Slider
				$filterSlider.asRange( {
					range: true,
					min: 0,
					max: defaultValues[1],
					step: 1,
					tip: false,
					scale: false,
					replaceFirst: 0,
					value: rangeValue || defaultValues,
				} ).on( 'asRange::change', function( ev, el, val ) {
					$filterResult.text( sign + val[0] + ' - ' + sign + val[1] ); // Show updated values.
				} ).on( 'asRange::moveEnd', function() {
					var values = $( this ).data( 'asRange' ).value;
					if($exchange_rate !== 0) {
						var $min = values[0] / $exchange_rate;
						var $max = values[1] / $exchange_rate;
					} else {
						var $min = values[0];
						var $max = values[1];
					}
					$filterInputMin.val( $min ); // set input values.
					$filterInputMax.val( $max ); // set input values.

					$priceForm.trigger( 'submit' ); // Trigger the form submit event.
				} );

				// Reset Filter Price.
				$filterReset.on( 'click', function() {
					$filterSlider.asRange( 'val', defaultValues ); // Reset the slider to default values.
					$priceForm.trigger( 'reset' ).trigger( 'submit' ); // Reset the form and trigger submit button.
				} );
			}

			if ( 'yes' === $ratingEnabled ) {

				/* load searched value after reloading page */
				const defaultFilterArg = {
					name		: 'rating_filter', 					// name of input
					classPrefix	: '.shopengine-rating-name-', 		// suffix class will be the value of the name
					setArray	: starsState, 						// new Set()
					addClass    : 'checked',
				}

				helper.setDefaultFilterData(defaultFilterArg)

				let $ratingForm = $scope.find( '.shopengine-filter.shopengine-filter-rating' );

				label_btn.on( 'click', function( ev ) {
					ev.preventDefault();

					let rating_label = ev.target.closest( '.rating-label-triger' );

					if ( rating_label ) {
						let rating = rating_label.dataset.rating,
							target = rating_label.dataset.target,
							label = $scope.find( rating_label ),
							input = $scope.find( `#${target}` );

						starsState.has( rating ) ? starsState.delete( rating ) : starsState.add( rating ); // eslint-disable-line
						label.hasClass( 'checked' ) ? label.removeClass( 'checked' ) : label.addClass( 'checked' ); // eslint-disable-line

						// inset array of star into the input field
						input.attr( 'value', Array.from( starsState ) );
						// trigger form submit
						$ratingForm.trigger( 'submit' );
					}
				} );
			}

			// enable color filter
			if ( 'yes' === $colorEnabled ) {
				const form			= $scope.find( '#shopengine_color_form' );
				const filterInput	= $scope.find( '.shopengine-filter-colors' );
				const formInput		= $scope.find( '.shopengine-filter-colors-value' );
				filter_script({form, filterInput, formInput})
			}

			if ( 'yes' === $categoryEnabled ) {
				let $categoryForm		= $scope.find( '#shopengine_category_form' ),
					$filterCategories	= $scope.find( '.shopengine-filter-categories' ),
					$categoryInput		= $scope.find( '#shopengine_filter_category' ),
					$collapseToggle		= $scope.find( '.shopengine-filter-category-toggle' );


				/* load searched value after reloading page */
				const defaultFilterArg = {
					name		: 'shopengine_filter_category', 	// name of input
					classPrefix	: '.shopengine-category-name-', 	// suffix class will be the value of the name
					setArray	: categories, 						// new Set()
				}

				helper.setDefaultFilterData(defaultFilterArg)

				$collapseToggle.on( 'click', function() {
					let $target		= $( this ).data( 'target' ),
						$expanded	= $( this ).attr( 'aria-expanded' ),
						$parent		= $( this ).parent().parent();

					// if Expanded the turn off
					if ( $expanded === 'true' ) {
						$parent.removeClass( 'isActive' );
						$( $target ).slideUp();
						$( this ).attr( 'aria-expanded', 'false' );
					} else {
						$parent.addClass( 'isActive' );
						$( $target ).slideDown();
						$( this ).attr( 'aria-expanded', 'true' );
					}
				} );

				/*
					Manage Category select
				*/

				$filterCategories.on( 'click', function(ev) {

					let inputValue = ev.target.value;
					if( categories.has( inputValue ) ) {
						categories.delete( inputValue );
					} else {
						categories.add( inputValue );
					}

					$categoryInput.attr( 'value', Array.from( categories ) );

					let $parent = $( this ).parent(),
						$toggle = $parent.find( '.shopengine-filter-category-toggle' );

					if ( ! $parent.parent().hasClass( 'isActive' ) && ! $( this ).hasClass( 'shopengine-filter-subcategory' ) ) {
						$scope
							.find( '.shopengine-filter-category-has-child.isActive' )
							.find( '.shopengine-filter-category-toggle' )
							.trigger( 'click' );
					}

					if ( $parent.parent().hasClass( 'shopengine-filter-category-has-child' ) && $toggle.attr( 'aria-expanded' ) !== 'true' ) {
						$toggle.trigger( 'click' );
					}

					// trigger form submit
					$categoryForm.trigger( 'submit' );
				} );
			}

			// enable attribute filter
			if( 'yes' === $attributeEnabled ) {
				const form			= $scope.find( '#shopengine_attribute_form' );
				const filterInput	= $scope.find( '.shopengine-filter-attribute' );
				const formInput		= $scope.find( '.shopengine-filter-attribute-value' );
				filter_script({form, filterInput, formInput});
			}

			// enable label filter
			if( 'yes' === $labelEnabled ) {
				const form			= $scope.find( '#shopengine_label_form' );
				const filterInput	= $scope.find( '.shopengine-filter-label' );
				const formInput		= $scope.find( '.shopengine-filter-label-value' );
				filter_script({form, filterInput, formInput});
			}

			// enable image filter
			if( 'yes' === $imageEnabled ) {
				const form			= $scope.find( '#shopengine_image_form' );
				const filterInput	= $scope.find( '.shopengine-filter-image' );
				const formInput		= $scope.find( '.shopengine-filter-image-value' );
				filter_script({form, filterInput, formInput});
			}

			// enable shipping filter
			if( 'yes' === $shippingEnabled ) {
				const form			= $scope.find( '#shopengine_shipping_form' );
				const filterInput	= $scope.find( '.shopengine-filter-shipping' );
				const formInput		= $scope.find( '.shopengine-filter-shipping-value' );
				filter_script({form, filterInput, formInput});
			}

			// enable stock filter
			if( 'yes' === $stockEnabled ) {
				const form			= $scope.find( '#shopengine_stock_form' );
				const filterInput	= $scope.find( '.shopengine-filter-stock' );
				const formInput		= $scope.find( '.shopengine-filter-stock-value' );
				filter_script({form, filterInput, formInput});
			}

			// enable stock filter
			if( 'yes' === $onSaleEnabled ) {
				const form			= $scope.find( '#shopengine_onsale_form' );
				const filterInput	= $scope.find( '.shopengine-filter-onsale' );
				const formInput		= $scope.find( '.shopengine-filter-onsale-value' );
				filter_script({form, filterInput, formInput});
			}			
		}
    };
    $(window).on('elementor/frontend/init', BASCART.init);

	/**
	 * Wrapper Link
	 */

	var $body = $('body');
	
	$body.on('click.bascartLink', '[data-ts-link]', function () {
		var config = $(this).data('ts-link'),
			target = config.is_external ? '_blank' : '_self',
			$el = config.url.charAt(0) === '#' ? $(config.url) : false;
		
		if ( $el.length ) {
			$('html, body').animate({
				scrollTop: $el.offset().top
			}, 500, 'linear');
			
			return;
		}
		
		window.open( config.url, target );
	});
}(jQuery, window.elementorFrontend));