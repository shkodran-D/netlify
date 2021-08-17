( function( api ) {

	// Extends our custom "salient-news" section.
	api.sectionConstructor['salient-news'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );
	jQuery( "#accordion-panel-salient-news-theme-options" ).addClass( "sudeep-class" );

} )( wp.customize );
