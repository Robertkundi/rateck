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

