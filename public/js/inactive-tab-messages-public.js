const originalSiteTitle = document.title;
const inactiveSiteTitle = inactiveTabMessages.inactive


document.addEventListener("visibilitychange", function() {
  if ( document.hidden ) {
	  document.title = inactiveSiteTitle
  } else {
	  document.title = originalSiteTitle
  }

});
