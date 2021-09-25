/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 * Also adds a focus class to parent li's for accessibility.
 */
function logger(args){
	console.log(args);
}
( function() {

	// Wait for DOM to be ready.
	document.addEventListener( 'DOMContentLoaded', function() {

		var container = document.getElementById( 'site-navigation' );
		if ( ! container ) {
			return;
		}

		var button = container.querySelector( 'button' );
		if ( ! button ) {
			return;
		}

		var menu = container.querySelector( 'ul' );
		// Hide menu toggle button if menu is empty and return early.
		if ( ! menu ) {
			button.style.display = 'none';
			return;
		}

		button.setAttribute( 'aria-expanded', 'false' );
		menu.setAttribute( 'aria-expanded', 'false' );
		menu.classList.add( 'nav-menu' );

		button.addEventListener( 'click', function() {
			container.classList.toggle( 'toggled' );
			var expanded = container.classList.contains( 'toggled' ) ? 'true' : 'false';
			button.setAttribute( 'aria-expanded', expanded );
			menu.setAttribute( 'aria-expanded', expanded );
		} );

		// Add dropdown toggle that displays child menu items.
		// var handheld = document.getElementsByClassName( 'handheld-navigation' );
		// logger(handheld);
		[].forEach.call( document.querySelectorAll('#site-header .menu-item > a'), function(anchor){
			logger(console);
			anchor.addEventListener( 'focus', function() {

				// Remove focus class from other sub-menus previously open.
				var elems = document.querySelectorAll( '.focus' );
				[].forEach.call( elems, function( el ) {
					if ( ! el.contains( anchor ) ) {
						el.classList.remove( 'focus' );

						// Remove blocked class, if it exists.
						if ( el.firstChild && el.firstChild.classList ) {
							el.firstChild.classList.remove( 'blocked' );
						}

					}
				});

				// Add focus class.
				var li = anchor.parentNode;

				li.classList.add( 'focus' );

			});
		});









	});
})();